import { request, API_BASE_URL, showToast } from "./lib/lib.js";

let currentState = "escolha";
let stateHistory = ["escolha"];

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

const entrarAluno = document.getElementById("entrar-aluno");
const entrarAdmin = document.getElementById("entrar-admin");
const allSections = document.querySelectorAll("section");
let allBack = document.querySelectorAll(".voltar");
const BaseUrl = "http://localhost/nutri/";
const adminCadastro = document.getElementById("admin-cadastro")
const alunoCadastro = document.getElementById("aluno-cadastro")

document.addEventListener("DOMContentLoaded", () => {
    setupUserMenu();
    allBack = document.querySelectorAll(".voltar");
    const loginForms = document.querySelectorAll("form");
    setListeners(loginForms);
    SetState(allSections, "escolha");
});

function SetState(allSections, state) {
    allSections.forEach(element => {
        if (element.id === state || element.classList.contains(state)) {
            element.style.display = "flex";
            currentState = state;
        } else {
            element.style.display = "none";
        }
    });
}

function redirectAfterAuth(type) {
    const target = type === "student" ? "form.php" : "dashboard.php";
    window.location.href = target;
}

function setListeners(loginForms) {
    entrarAluno.addEventListener("click", function () {
        stateHistory.push("login-aluno");
        SetState(allSections, "login-aluno");
    });

    entrarAdmin.addEventListener("click", function () {
        stateHistory.push("login-admin");
        SetState(allSections, "login-admin");
    });

    adminCadastro.addEventListener("click", function () {
        stateHistory.push("cadastro-admin");
        SetState(allSections, "cadastro-admin");
    });

    alunoCadastro.addEventListener("click", function () {
        stateHistory.push("cadastro-aluno");
        SetState(allSections, "cadastro-aluno");
    })

    allBack.forEach(a => {
        a.addEventListener("click", function () {
            if (stateHistory.length > 1) {
                stateHistory.pop();
                SetState(allSections, stateHistory[stateHistory.length - 1]);
            }
        })
    });

    loginForms.forEach(form => {
        form.addEventListener("submit", async function (e) {
            e.preventDefault();

            const formData = new FormData(form);
            const payload = {
                route: "login",
                type: "student",
                email: formData.get("email"),
                password: formData.get("password")
            };

            if (currentState === "login-admin") {
                payload.route = "login";
                payload.type = "admin";
                payload.cpf = formData.get("cpf");
            }

            if (currentState === "cadastro-admin") {
                payload.route = "signup";
                payload.type = "admin";
                payload.name = formData.get("name");
                payload.cpf = formData.get("cpf");
            }

            if (currentState === "cadastro-aluno") {
                payload.route = "signup";
                payload.type = "student";
                payload.nome = formData.get("nome");
                payload.turn = formData.get("turn");
            }

            const res = await request(API_BASE_URL, "POST", {
                body: JSON.stringify(payload)
            });

            if (res?.status === "success" || res?.success === true) {
                const authType = payload.type === "student" ? "student" : "admin";
                showToast(res?.message || "Autenticação realizada com sucesso!", "success");
                window.setTimeout(() => redirectAfterAuth(authType), 800);
                return;
            }

            showToast(res?.message || "Não foi possível concluir a autenticação.", "error");
        });
    });
}