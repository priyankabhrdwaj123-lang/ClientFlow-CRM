
document.addEventListener('DOMContentLoaded', function () {
    const menuButtons = document.querySelectorAll('.nav-toggle');

    menuButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const submenuId = button.getAttribute('aria-controls');
            const submenu = document.getElementById(submenuId);

            if (!submenu) {
                return;
            }

            const isExpanded =
                button.getAttribute('aria-expanded') === 'true';

            // Close all menus first
            menuButtons.forEach(function (otherButton) {
                const otherSubmenuId =
                    otherButton.getAttribute('aria-controls');

                const otherSubmenu =
                    document.getElementById(otherSubmenuId);

                otherButton.setAttribute('aria-expanded', 'false');

                if (otherSubmenu) {
                    otherSubmenu.hidden = true;
                }
            });

            // Open the clicked menu if it was previously closed
            if (!isExpanded) {
                button.setAttribute('aria-expanded', 'true');
                submenu.hidden = false;
            }
        });
    });
});
