<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriFlow</title>

    <link rel="stylesheet" href="/nutri/public/static/css/index.css">
    <script src="/nutri/public/static/js/index.js" defer></script>
</head>
<body>

    <section id="escolha">
        <div>
            <h1 class="n">NutriFlow</h1>

            <div id="escolha-row">

                <button id="entrar-aluno">
                    <svg width="44" height="44" viewBox="0 0 24 24" fill="none">
                        <path d="M12 3L1 9L12 15L23 9L12 3Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M5 12V16C5 18.761 8.134 21 12 21C15.866 21 19 18.761 19 16V12" stroke="currentColor" stroke-width="2"/>
                    </svg>

                    <p>Entrar como aluno</p>
                </button>

                <button id="entrar-admin">
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

    <section class="login-aluno">
        <div class="log">

            <form action="" id="form-login">

                <h1>Login</h1>

                <input
                    type="email"
                    name="email"
                    placeholder="Insira seu email">

                <input
                    type="password"
                    name="senha"
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

    </section>

    <!-- LOGIN ADMIN -->

    <section class="login-admin">

        <div class="log-adm">

            <form action="" id="form-login">

                <h1>Login</h1>

                <input
                    type="text"
                    name="cnpj"
                    placeholder="Insira o CNPJ da instituição">

                <input
                    type="password"
                    name="senha"
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

    </section>

        <!-- CADASTRO ALUNO -->

    <section class="cadastro-aluno">
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

                <input
                    type="password"
                    name="senha"
                    placeholder="Insira sua senha">

                <button id="submit-login">
                    Cadastrar
                </button>

                <a class="voltar">
                    Voltar
                </a>

            </form>

        </div>

    </section>

    <!-- CADASTRO ADMIN -->

    <section class="cadastro-admin">
        <div class="log-adm">

            <form action="" id="form-login">

                <h1 class="h">Cadastro</h1>

                <input
                    type="text"
                    name="nome"
                    placeholder="Insira o Nome da Instituição">

                <input
                    type="text"
                    name="cnpj"
                    placeholder="Insira o CNPJ da instituição">

                <input
                    type="password"
                    name="senha"
                    placeholder="Insira sua senha">

                <button id="submit-login">
                    Cadastrar
                </button>

                <a class="voltar">
                    Voltar
                </a>

            </form>

        </div>

    </section>

</body>
</html>