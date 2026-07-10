<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriFlow</title>

    <link rel="stylesheet" href="static/css/index.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
        <script src="./static/js/index.js" type="module" defer></script>
    </head>
    <body>

        <header class="navbar">
            <div class="logo">
                <i class="fa-solid fa-leaf"></i>
                <span>NutriFlow</span>
            </div>
        </header>

        <section id="escolha">
            <div>
                <div class="hero-panel">
                    <h1 class="n">NutriFlow</h1>
                    <p class="subtitle">Selecione seu perfil abaixo e acesse seu painel nutricional com segurança e rapidez.</p>
                </div>

                <div id="escolha-row">

                    <button id="entrar-aluno" class="choice-card">
                        <svg width="44" height="44" viewBox="0 0 24 24" fill="none">
                            <path d="M12 3L1 9L12 15L23 9L12 3Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M5 12V16C5 18.761 8.134 21 12 21C15.866 21 19 18.761 19 16V12" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        <p>Entrar como aluno</p>
                    </button>

                    <button id="entrar-admin" class="choice-card">
                        <svg width="44" height="44" viewBox="0 0 24 24" fill="none">
                            <path d="M12 12C14.2091 12 16 10.2091 16 8C16 5.79086 14.2091 4 12 4C9.79086 4 8 5.79086 8 8C8 10.2091 9.79086 12 12 12Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M4 20C4 16.6863 7.58172 14 12 14C16.4183 14 20 16.6863 20 20" stroke="currentColor" stroke-width="2"/>
                            <path d="M19 14V18" stroke="currentColor" stroke-width="2"/>
                            <path d="M17 16H21" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        <p>Entrar como instituição</p>
                    </button>

                </div>
            </div>
        </section>

    <!-- LOGIN ALUNO -->

    <section id="login-aluno">

        <div class="left-side">
            <div class="img-container">
                <svg class="ycircle" viewBox="0 0 520 520" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <defs>
                        <radialGradient id="g-1" cx="30%" cy="30%">
                            <stop offset="0%" stop-color="#38bdf8" stop-opacity="0.18"/>
                            <stop offset="100%" stop-color="#2563eb" stop-opacity="0.02"/>
                        </radialGradient>
                    </defs>
                    <circle cx="260" cy="260" r="260" fill="url(#g-1)" />
                </svg>

                <svg class="rcircle" viewBox="0 0 620 620" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <defs>
                        <linearGradient id="g-2" x1="0" x2="1">
                            <stop offset="0%" stop-color="#111827" stop-opacity="0.6"/>
                            <stop offset="100%" stop-color="#0b1220" stop-opacity="0.3"/>
                        </linearGradient>
                    </defs>
                    <circle cx="310" cy="310" r="310" fill="url(#g-2)" />
                </svg>

                <!-- plate icon -->
                <svg class="imagem" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <circle cx="60" cy="60" r="50" fill="#0b1220" opacity="0.9" />
                    <circle cx="60" cy="60" r="34" fill="#071029" />
                    <g transform="translate(36,38)" fill="#38bdf8" opacity="0.95">
                        <rect x="2" y="6" width="28" height="6" rx="3" />
                        <rect x="2" y="18" width="20" height="6" rx="3" />
                    </g>
                </svg>
            </div>
        </div>

        <div class="divider"></div>

        <div class="right-side">

            <div class="log">

                <form action="" id="form-login">

                    <h1>Login</h1>

                    <input
                        type="email"
                        name="email"
                        placeholder="Insira seu email">

                    <input
                        type="password"
                        name="password"
                        placeholder="Insira sua senha">

                    <button id="submit-login">
                        Entrar
                    </button>

                    <p>
                        Não tem uma conta?
                        <a class="c" id="aluno-cadastro">
                            Cadastre-se aqui
                        </a>
                    </p>

                    <a class="voltar">
                        Voltar
                    </a>

                </form>

            </div>

        </div>

    </section>

    <!-- LOGIN ADMIN -->

    <section id="login-admin">

        <div class="left-side">
            <div class="img-container">
                <svg class="ycircle" viewBox="0 0 520 520" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <defs>
                        <radialGradient id="g-3" cx="30%" cy="30%">
                            <stop offset="0%" stop-color="#38bdf8" stop-opacity="0.18"/>
                            <stop offset="100%" stop-color="#2563eb" stop-opacity="0.02"/>
                        </radialGradient>
                    </defs>
                    <circle cx="260" cy="260" r="260" fill="url(#g-3)" />
                </svg>

                <svg class="rcircle" viewBox="0 0 620 620" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <defs>
                        <linearGradient id="g-4" x1="0" x2="1">
                            <stop offset="0%" stop-color="#111827" stop-opacity="0.6"/>
                            <stop offset="100%" stop-color="#0b1220" stop-opacity="0.3"/>
                        </linearGradient>
                    </defs>
                    <circle cx="310" cy="310" r="310" fill="url(#g-4)" />
                </svg>

                <!-- user/login icon -->
                <svg class="imagem" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <rect x="0" y="0" width="120" height="120" rx="20" fill="#071029" />
                    <circle cx="60" cy="40" r="18" fill="#38bdf8" />
                    <path d="M28 96c6-12 18-18 32-18s26 6 32 18" fill="#38bdf8" opacity="0.95"/>
                </svg>
            </div>
        </div>

        <div class="divider"></div>

        <div class="right-side">

            <div class="log-adm">

                <form action="" id="form-login">

                    <h1>Login</h1>

                    <input
                        type="email"
                        name="email"
                        placeholder="Insira o email da instituição">

                    <input
                        type="text"
                        name="cpf"
                        placeholder="Insira o CPF/CNPJ da instituição">

                    <input
                        type="password"
                        name="password"
                        placeholder="Insira a senha da instituição">

                    <button id="submit-login">
                        Entrar
                    </button>

                    <p>
                        Não cadastrou sua instituição?
                        <a class="c" id="admin-cadastro">
                            Cadastre aqui
                        </a>
                    </p>

                    <a class="voltar">
                        Voltar
                    </a>

                </form>

            </div>

        </div>

    </section>

        <!-- CADASTRO ALUNO -->

    <section id="cadastro-aluno">

<div class="left-side">
    <div class="img-container">
        <svg class="ycircle" viewBox="0 0 520 520" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <defs>
                <radialGradient id="g-5" cx="30%" cy="30%">
                    <stop offset="0%" stop-color="#38bdf8" stop-opacity="0.18"/>
                    <stop offset="100%" stop-color="#2563eb" stop-opacity="0.02"/>
                </radialGradient>
            </defs>
            <circle cx="260" cy="260" r="260" fill="url(#g-5)" />
        </svg>

        <svg class="rcircle" viewBox="0 0 620 620" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <defs>
                <linearGradient id="g-6" x1="0" x2="1">
                    <stop offset="0%" stop-color="#111827" stop-opacity="0.6"/>
                    <stop offset="100%" stop-color="#0b1220" stop-opacity="0.3"/>
                </linearGradient>
            </defs>
            <circle cx="310" cy="310" r="310" fill="url(#g-6)" />
        </svg>

        <svg class="imagem" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <circle cx="60" cy="60" r="50" fill="#0b1220" opacity="0.9" />
            <circle cx="60" cy="60" r="34" fill="#071029" />
            <g transform="translate(36,38)" fill="#38bdf8" opacity="0.95">
                <rect x="2" y="6" width="28" height="6" rx="3" />
                <rect x="2" y="18" width="20" height="6" rx="3" />
            </g>
        </svg>
    </div>
</div>

        <div class="divider"></div>

        <div class="right-side">

            <div class="log">

                <form action="" id="form-login">

                    <h1>Cadastro</h1>

                    <input
                        type="text"
                        name="nome"
                        placeholder="Insira seu nome">

                    <input
                        type="email"
                        name="email"
                        placeholder="Insira seu email">


                    <select name="turn">
                        <option value="manha">Manhã</option>
                        <option value="tarde">Tarde</option>
                        <option value="noite">Noite</option>
                    </select>

                    <input
                        type="password"
                        name="password"
                        placeholder="Insira sua senha">

                    <button id="submit-login">
                        Cadastrar
                    </button>

                    <a class="voltar">
                        Voltar
                    </a>

                </form>

            </div>

        </div>

    </section>

    <!-- CADASTRO ADMIN -->

    <section id="cadastro-admin">

        <div class="left-side">
            <div class="img-container">
                <svg class="ycircle" viewBox="0 0 520 520" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <defs>
                        <radialGradient id="g-7" cx="30%" cy="30%">
                            <stop offset="0%" stop-color="#38bdf8" stop-opacity="0.18"/>
                            <stop offset="100%" stop-color="#2563eb" stop-opacity="0.02"/>
                        </radialGradient>
                    </defs>
                    <circle cx="260" cy="260" r="260" fill="url(#g-7)" />
                </svg>

                <svg class="rcircle" viewBox="0 0 620 620" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <defs>
                        <linearGradient id="g-8" x1="0" x2="1">
                            <stop offset="0%" stop-color="#111827" stop-opacity="0.6"/>
                            <stop offset="100%" stop-color="#0b1220" stop-opacity="0.3"/>
                        </linearGradient>
                    </defs>
                    <circle cx="310" cy="310" r="310" fill="url(#g-8)" />
                </svg>

                <svg class="imagem" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <rect x="0" y="0" width="120" height="120" rx="20" fill="#071029" />
                    <circle cx="60" cy="40" r="18" fill="#38bdf8" />
                    <path d="M28 96c6-12 18-18 32-18s26 6 32 18" fill="#38bdf8" opacity="0.95"/>
                </svg>
            </div>
        </div>

        <div class="divider"></div>

        <div class="right-side">

            <div class="log-adm">

                <form action="" id="form-login">

                    <h1 class="h">Cadastro</h1>

                    <input
                        type="text"
                        name="name"
                        placeholder="Insira o Nome da Instituição">

                    <input
                        type="email"
                        name="email"
                        placeholder="Insira o email da instituição">

                    <input
                        type="text"
                        name="cpf"
                        placeholder="Insira o CPF/CNPJ da instituição">

                    <input
                        type="password"
                        name="password"
                        placeholder="Insira sua senha">

                    <button id="submit-login">
                        Cadastrar
                    </button>

                    <a class="voltar">
                        Voltar
                    </a>

                </form>

            </div>

        </div>

    </section>

</body>
</html>