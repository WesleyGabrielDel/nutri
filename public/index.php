<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriFlow — Acesso</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

    <link rel="stylesheet" href="static/css/tokens.css">
    <link rel="stylesheet" href="static/css/index.css">
    <script src="./static/js/index.js" type="module" defer></script>
</head>
<body>

    <header class="navbar">
        <div class="logo">
            <i class="fa-solid fa-leaf"></i>
            <span>NutriFlow</span>
        </div>
    </header>

    <!-- ESCOLHA DE PERFIL -->
    <section id="escolha">
        <div>
            <div class="hero-panel">
                <span class="hero-badge">Apoio à cantina escolar</span>
                <h1 class="n">Menos desperdício,<br>mais refeições certas.</h1>
                <p class="subtitle">Selecione seu perfil abaixo e acesse seu painel nutricional com segurança e rapidez.</p>
            </div>

            <div id="escolha-row">

                <button id="entrar-aluno" class="choice-card" type="button">
                    <span class="choice-emoji"><i class="fa-solid fa-graduation-cap"></i></span>
                    <strong>Entrar como aluno</strong>
                    <span class="choice-sub">Confirmar presença nas refeições</span>
                    <i class="arrow fa-solid fa-arrow-right"></i>
                </button>

                <button id="entrar-admin" class="choice-card" type="button">
                    <span class="choice-emoji"><i class="fa-solid fa-utensils"></i></span>
                    <strong>Entrar como instituição</strong>
                    <span class="choice-sub">Planejar cardápio e monitorar demanda</span>
                    <i class="arrow fa-solid fa-arrow-right"></i>
                </button>

            </div>
        </div>
    </section>

    <!-- LOGIN ALUNO -->
    <section id="login-aluno">
        <div class="auth-shell">
            <div class="auth-hero">
                <span class="badge"><i class="fa-solid fa-graduation-cap"></i> Aluno</span>
                <h2>Bem-vindo de volta</h2>
                <p>Acesse sua conta para confirmar a refeição de hoje.</p>
            </div>

            <form action="" id="form-login" class="auth-form">
                <h1>Login</h1>

                <label class="field-label" for="la-email">Email</label>
                <input id="la-email" type="email" name="email" placeholder="nome@escola.edu.br">

                <label class="field-label" for="la-pass">Senha</label>
                <input id="la-pass" type="password" name="password" placeholder="Insira sua senha">

                <button id="submit-login" type="submit">Entrar</button>

                <p class="auth-alt">
                    Não tem uma conta?
                    <a class="c" id="aluno-cadastro">Cadastre-se aqui</a>
                </p>

                <a class="voltar"><i class="fa-solid fa-arrow-left"></i> Voltar</a>
            </form>
        </div>
    </section>

    <!-- LOGIN ADMIN -->
    <section id="login-admin">
        <div class="auth-shell">
            <div class="auth-hero">
                <span class="badge"><i class="fa-solid fa-utensils"></i> Instituição</span>
                <h2>Painel da cantina</h2>
                <p>Acesse o controle operacional de refeições e cardápio.</p>
            </div>

            <form action="" id="form-login" class="auth-form">
                <h1>Login</h1>

                <label class="field-label">Email da instituição</label>
                <input type="email" name="email" placeholder="contato@escola.edu.br">

                <label class="field-label">CPF / CNPJ</label>
                <input type="text" name="cpf" placeholder="Somente números">

                <label class="field-label">Senha</label>
                <input type="password" name="password" placeholder="Insira a senha da instituição">

                <button id="submit-login" type="submit">Entrar</button>

                <p class="auth-alt">
                    Não cadastrou sua instituição?
                    <a class="c" id="admin-cadastro">Cadastre aqui</a>
                </p>

                <a class="voltar"><i class="fa-solid fa-arrow-left"></i> Voltar</a>
            </form>
        </div>
    </section>

    <!-- CADASTRO ALUNO -->
    <section id="cadastro-aluno">
        <div class="auth-shell">
            <div class="auth-hero">
                <span class="badge"><i class="fa-solid fa-graduation-cap"></i> Aluno</span>
                <h2>Crie sua conta</h2>
                <p>Leva menos de um minuto para começar a confirmar suas refeições.</p>
            </div>

            <form action="" id="form-login" class="auth-form">
                <h1>Cadastro</h1>

                <label class="field-label">Nome completo</label>
                <input type="text" name="nome" placeholder="Seu nome">

                <label class="field-label">Email</label>
                <input type="email" name="email" placeholder="nome@escola.edu.br">

                <label class="field-label">Turno</label>
                <select name="turn">
                    <option value="manha">Manhã</option>
                    <option value="tarde">Tarde</option>
                    <option value="noite">Noite</option>
                </select>

                <label class="field-label">Senha</label>
                <input type="password" name="password" placeholder="Crie uma senha">

                <button id="submit-login" type="submit">Cadastrar</button>

                <a class="voltar"><i class="fa-solid fa-arrow-left"></i> Voltar</a>
            </form>
        </div>
    </section>

    <!-- CADASTRO ADMIN -->
    <section id="cadastro-admin">
        <div class="auth-shell">
            <div class="auth-hero">
                <span class="badge"><i class="fa-solid fa-utensils"></i> Instituição</span>
                <h2>Cadastre sua escola</h2>
                <p>Registre a instituição para começar a planejar refeições.</p>
            </div>

            <form action="" id="form-login" class="auth-form">
                <h1>Cadastro</h1>

                <label class="field-label">Nome da instituição</label>
                <input type="text" name="name" placeholder="Escola Municipal ...">

                <label class="field-label">Email</label>
                <input type="email" name="email" placeholder="contato@escola.edu.br">

                <label class="field-label">CPF / CNPJ</label>
                <input type="text" name="cpf" placeholder="Somente números">

                <label class="field-label">Senha</label>
                <input type="password" name="password" placeholder="Crie uma senha">

                <button id="submit-login" type="submit">Cadastrar</button>

                <a class="voltar"><i class="fa-solid fa-arrow-left"></i> Voltar</a>
            </form>
        </div>
    </section>

</body>
</html>
