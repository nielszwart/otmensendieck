window.onload = function() {
    init();

    let addNewMenuItemButton = document.getElementById('add-new-menu-item');
    if (addNewMenuItemButton) {
        addNewMenuItemButton.onclick = function() {
            let newMenuItem = {};
            newMenuItem.name = document.getElementById('name').value;
            newMenuItem.linkType = document.getElementById('linkType').value;
            newMenuItem.page = (newMenuItem.linkType === 'page' ? document.getElementById('page').value : "");
            newMenuItem.url = (newMenuItem.linkType === 'url' ? document.getElementById('url').value : "");

            addMenuItem(newMenuItem);
        }
    }
};

function addMenuItem(newMenuItem)
{
    let menuItemDiv = document.getElementById('new-menu-item');
    let menuItemsDiv = document.getElementById("menu-items");
    let i = menuItemsDiv.querySelectorAll('.menu-item').length;

    if (menuItemDiv) {
        let newItemClone = menuItemDiv.cloneNode(true);
        newItemClone.removeAttribute('id');

        let fields = newItemClone.querySelectorAll('input, select, label');
        for (let j = 0; j < fields.length; j++) {
            let field = fields[j];
            if (field.tagName === 'LABEL') {
                field.setAttribute('for', field.getAttribute('for').replace('counter', i));
            } else {
                field.setAttribute('name', field.getAttribute('name').replace('counter', i));
                field.setAttribute('id', field.getAttribute('id').replace('counter', i));
            }

            if (field.name === 'menu_items['+i+'][name]') {
                field.value = newMenuItem.name;
            }
            if (field.name === 'menu_items['+i+'][linkType]') {
                field.value = newMenuItem.linkType;
            }
            if (field.name === 'menu_items['+i+'][url]') {
                field.value = newMenuItem.url;
            }
            if (field.name === 'menu_items['+i+'][linkTypeId]') {
                field.value = newMenuItem.page;
            }
            if (field.name === 'menu_items['+i+'][position]') {
                field.value = i + 1;
            }
        }

        if (newMenuItem.linkType === 'page') {
            newItemClone.querySelector('#page-field').classList.remove('hidden')
        }
        if (newMenuItem.linkType === 'url') {
            newItemClone.querySelector('#url-field').classList.remove('hidden')
        }

        newItemClone.classList.remove('hidden');
        menuItemsDiv.appendChild(newItemClone);

        init();
    }
}

function init()
{
    let linkTypeFields = document.getElementsByClassName('link-type-field');
    if (linkTypeFields) {
        for (let i = 0; i < linkTypeFields.length; i++) {
            let field = linkTypeFields[i];
            let select = field.querySelector('select');
            select.onchange = function() {
                let menuItem = field.parentElement;
                if (this.value === 'url') {
                    menuItem.querySelector('#url-field').classList.remove('hidden');
                    menuItem.querySelector('#page-field').classList.add('hidden');
                    menuItem.querySelector('#page-field > select').value = "";
                }
                if (this.value === 'page') {
                    menuItem.querySelector('#url-field').classList.add('hidden');
                    menuItem.querySelector('#url-field > input').value = "";
                    menuItem.querySelector('#page-field').classList.remove('hidden');
                }
            }
        }
    }

    let removeMenuItemButtons = document.getElementsByClassName('remove-menu-item');
    if (removeMenuItemButtons) {
        for (let i = 0; i < removeMenuItemButtons.length; i++) {
            let button = removeMenuItemButtons[i];
            button.onclick = function() {
                let entireDiv = this.closest('.menu-item');
                entireDiv.parentNode.removeChild(entireDiv);

                let menuItemId = this.dataset.id;
                if (menuItemId) {
                    let ajax = new XMLHttpRequest();
                    deleteLink = deleteLink.substring(0, deleteLink.lastIndexOf("/") + 1) + menuItemId;

                    ajax.onreadystatechange = function() {
                        if (ajax.readyState === XMLHttpRequest.DONE) {
                            if (ajax.status !== 200) {
                                console.log('could not remove menu item');
                            }
                        }
                    };
                    ajax.open("POST", deleteLink, true);
                    ajax.send({id: menuItemId});
                }
            }
        }
    }

    let moreButton = document.getElementsByClassName('show-more');
    if (moreButton) {
        for (let i = 0; i < moreButton.length; i++) {
            moreButton[i].onclick = function() {
                let menuItem = this.closest('.menu-item'),
                    moreFields = menuItem.querySelector('.more'),
                    item = $(moreFields),
                    time = 300;

                if (moreFields.classList.contains('show')) {
                    moreFields.classList.remove('show');
                    item.stop().animate({ height: '0' }, time);
                    this.style.borderBottom = "none";
                    this.style.borderTop = "10px solid black";

                } else {
                    moreFields.classList.add('show');
                    let curHeight = item.height(),
                        autoHeight = item.css('height', 'auto').height();
                    item.height(curHeight);
                    item.stop().animate({ height: autoHeight }, time);
                    this.style.borderBottom = "10px solid black";
                    this.style.borderTop = "none";
                }
            }
        }
    }

    let allParentFields = document.getElementsByClassName('parent-field');
    if (allParentFields) {
        setParentOptions(allParentFields);
    }
}

function setParentOptions(allParentFields)
{
    for (let i = 0; i < allParentFields.length; i++) {
        let field = allParentFields[i],
            select = field.querySelector('select'),
            fieldTempId = field.parentElement.parentElement.querySelector('#temp-id').value;

        removeOptions(select);

        let selectableParents = getSelectableParents();
        for (let j = 0; j < selectableParents.length; j++) {
            let selectableParent = selectableParents[j];
            if (selectableParent.tempId === fieldTempId) {
                continue;
            }

            let option = document.createElement('option');
            option.appendChild(document.createTextNode(selectableParent.title));
            option.value = selectableParent.tempId;
            if (selectableParent.menuItemId && parseInt(field.dataset.parent) === parseInt(selectableParent.menuItemId.value)) {
                option.selected = 'selected';
            }
            select.appendChild(option);
        }
    }
}

function removeOptions(select)
{
    for (let i = select.options.length - 1 ; i > 0 ; i--)
    {
        select.remove(i);
    }
}

function getSelectableParents()
{
    let selectableParents = [];
    let menuItems = document.querySelectorAll('.menu-item:not(#new-menu-item):not(.submenu-item)');
    if (menuItems) {
        for (let i = 0; i < menuItems.length; i++) {
            let parent = menuItems[i];
            let parentData = {};
            parentData.menuItemId = parent.querySelector('.menu-item-id');
            parentData.tempId = parent.querySelector('#temp-id').value;
            parentData.title = parent.querySelector('.name-field > input').value;

            selectableParents.push(parentData);
        }
    }

    return selectableParents;
}
