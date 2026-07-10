import { request, API_BASE_URL, showToast } from "./lib/lib.js";

function setupUserMenu() {
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
}

const form = document.querySelector('.meal-form');
const botaoConfirmar = document.querySelector('.confirm-btn');

function getSelectedOption() {
    const options = document.querySelectorAll('input[name="refeicao"]');
    return Array.from(options).find((option) => option.checked) || null;
}

setupUserMenu();

if (form && botaoConfirmar) {
    botaoConfirmar.addEventListener('click', async function (event) {
        event.preventDefault();

        const opcaoSelecionada = getSelectedOption();

        if (!opcaoSelecionada) {
            showToast('Por favor, selecione uma das opções de refeição antes de confirmar!', 'warning');
            return;
        }

        const valorRefeicao = opcaoSelecionada.value;
        const willEat = valorRefeicao === 'sim' ? 1 : 0;

        try {
            const response = await request(API_BASE_URL, 'POST', {
                body: JSON.stringify({
                    route: 'send-form',
                    will_eat: willEat
                })
            });

            if (response?.success === false) {
                throw new Error(response?.message || 'Erro ao enviar o formulário.');
            }

            showToast(response?.message || 'Formulário enviado com sucesso!', 'success');
        } catch (error) {
            console.error(error);
            showToast(error.message || 'Não foi possível enviar o formulário.', 'error');
        }
    });
}
