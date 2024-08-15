// barralateral.js

document.addEventListener('DOMContentLoaded', function() {
    const menuToggles = document.querySelectorAll('.menu-toggle');

    menuToggles.forEach(toggle => {
        toggle.addEventListener('click', function(event) {
            event.preventDefault();

            const targetId = this.getAttribute('data-target');
            const submenu = document.getElementById(targetId);

            // Cierra todos los submenús excepto el actual
            document.querySelectorAll('.submenu').forEach(sm => {
                if (sm !== submenu) {
                    sm.style.display = 'none';
                }
            });

            // Alterna la visibilidad del submenú actual
            if (submenu.style.display === 'block') {
                submenu.style.display = 'none';
            } else {
                submenu.style.display = 'block';
            }
        });
    });
});
