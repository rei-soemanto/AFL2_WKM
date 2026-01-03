document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('mobileMenuToggle');
    const menu = document.getElementById('mobileMenu');
    const mask = document.querySelector('.mobile-menu-mask');

    if (toggle && menu && mask) {
        toggle.addEventListener('click', function() {
            const isOpen = mask.classList.toggle('open');
            
            if (isOpen) {
                const fullHeight = menu.scrollHeight;
                mask.style.height = fullHeight + "px";
                toggle.setAttribute('aria-expanded', 'true');
            } else {
                mask.style.height = "0px";
                toggle.setAttribute('aria-expanded', 'false');
            }
        });
    }
});