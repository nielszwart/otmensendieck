var mobileMenu = document.getElementById('mobile-menu');
var mobileMenuItems = document.getElementById('mobile-menu-items');
if (mobileMenu) {
    mobileMenu.onclick = function(e) {
        if (mobileMenuItems.classList.contains('show')) {
            mobileMenuItems.classList.remove('show');
        } else {
            mobileMenuItems.classList.add('show');
        }
    }
}
