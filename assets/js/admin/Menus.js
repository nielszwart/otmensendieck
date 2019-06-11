window.onload = function() {


    init();

    let addNewMenuItemButton = document.getElementById('add-new-menu-item');
    if (addNewMenuItemButton) {
        addNewMenuItemButton.onclick = function() {
            addMenuItem();
        }
    }
};



function addMenuItem()
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
                let menuItem = this.closest('.menu-item');
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
                    deleteLink = deleteLink.replace("0", menuItemId);

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
}
