document.addEventListener('DOMContentLoaded', () => {
    const content = document.getElementById('content');

    document.getElementById('manage-users').addEventListener('click', () => {
        loadContent('php/manage_users.php');
    });

    document.getElementById('manage-menu').addEventListener('click', () => {
        loadContent('php/manage_menu.php');
    });

    document.getElementById('view-reservations').addEventListener('click', () => {
        loadContent('php/view_reservations.php');
    });

    document.getElementById('view-preorders').addEventListener('click', () => {
        loadContent('php/view_preorders.php');
    });

    function loadContent(url) {
        fetch(url)
            .then(response => response.text())
            .then(html => {
                content.innerHTML = html;
            })
            .catch(error => {
                console.error('Error loading content:', error);
            });
    }
});
