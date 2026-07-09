let currentState = "escolha";
let oldState = "escolha";

const entrarAluno = document.getElementById("entrar-aluno");
const entrarAdmin = document.getElementById("entrar-admin");
const allSections = document.querySelectorAll("section");
let allBack = document.querySelectorAll(".voltar");
const BaseUrl = "http://localhost/nutri/";
const adminCadastro = document.getElementById("admin-cadastro")
const alunoCadastro = document.getElementById("admin-cadastro")

const luz = document.querySelector(".luz");
const card = document.querySelector("#entrar-aluno", "#entrar-admin");

document.addEventListener("DOMContentLoaded", () => {
    allBack = document.querySelectorAll(".voltar");
    const loginForms = document.querySelectorAll("form");
    setListeners(loginForms);
    SetState(allSections, "escolha");
});

function SetState(allSections, state) {
    allSections.forEach(element => {
        if (element.id === state) {
            element.style.display = "block";
            oldState = currentState;
            currentState = state;
        }

        else {
            element.style.display = "none";
        }
    });
}

function setListeners(loginForms) {
    entrarAluno.addEventListener("click", function () {
        SetState(allSections, "login-aluno");
    });

    entrarAdmin.addEventListener("click", function () {
        SetState(allSections, "login-admin");
    });

    adminCadastro.addEventListener("click", function () {
        SetState(allSections, "cadastro-admin");
    });

    alunoCadastro.addEventListener("click", function () {
        SetState(allSections, "cadastro-aluno")
    })

    allBack.forEach(a => {
        a.addEventListener("click", function () {
            SetState(allSections, oldState);
        })
    });

    loginForms.forEach(form => {
        form.addEventListener("submit", async function (e) {
            e.preventDefault();

            if (currentState === "cadastro-admin") {
                const formData = new FormData(form);
                const email = formData.get("email");
                const nome = formData.get("nome");
                const senha = formData.get("senha");
                const cnpj = formData.get("cnpj");

                let res = null;

                res = await request(BaseUrl + "backend/auth/admin-auth.php", "POST", {
                    body: JSON.stringify({
                        email: email,
                        senha: senha,
                        cnpj: cnpj,
                        nome: nome
                    })
                });

                console.log("Resposta Cadastro Admin:", res);
            }

            else if (currentState === "cadastro-aluno") {
                const formData = new FormData(form);
                const email = formData.get("email");
                const nome = formData.get("nome");
                const senha = formData.get("senha");

                let res = null;
                res = await request(BaseUrl + "backend/user.php", "POST", {
                    body: JSON.stringify({
                        email: email,
                        senha: senha,
                        cnpj: cnpj,
                        nome: nome
                    })
                });

                console.log("Resposta Cadastro Aluno:", res);
            }


        });
    });
}

async function request(url, method = "GET", options = {}) {
    try {
        const headers = {
            "Content-Type": "application/json",
            ...(options.headers || {})
        };
        const response = await fetch(url, {
            method,
            credentials: "include",
            body: options.body,
            ...options,
            headers,
        });

        let data;
        const text = await response.text();
        try {
            data = JSON.parse(text);
        } catch {
            data = `===================================== Erro Interno do Servidor ===================================== ${text}`;
        }

        if (!response.ok) {
            return { success: false, message: data?.message || data || "Erro na requisição" };
        }
        return data;
    } catch (error) {
        return { success: false, message: `Erro de conexão com o servidor.\n${error}` };
    }
}

card.addEventListener("mousemove", (e)=> {
    mouseX = e.mouseX;
    mouseY = e.mouseY;
})