import { request, API_BASE_URL } from "./lib/lib.js";

document.addEventListener('DOMContentLoaded', () => {
    const userMenu = document.querySelector('.user-menu');
    const userTrigger = document.querySelector('.user-trigger');
    const logoutBtn = document.getElementById('logout-btn');

    if (!userMenu || !userTrigger || !logoutBtn) {
        return;
    }

    userTrigger.addEventListener('click', (event) => {
        event.stopPropagation();
        userMenu.classList.toggle('open');
    });

    document.addEventListener('click', (event) => {
        if (!userMenu.contains(event.target)) {
            userMenu.classList.remove('open');
        }
    });

    logoutBtn.addEventListener('click', async () => {
        await request(API_BASE_URL, 'POST', {
            body: JSON.stringify({ route: 'logout' })
        });

        window.location.reload();
    });
});
