<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NutriFlow | Refeição</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

    <link rel="stylesheet" href="static/css/tokens.css">
    <link rel="stylesheet" href="static/css/form.css">

    <script src="static/js/form.js?v=2" type="module" defer></script>
</head>


<?php

    require_once __DIR__ . '/../bootstrap.php';
    SessionManager::verify();
    $userName = SessionManager::getCurrentUserName();

?>

<body>

    <header class="navbar">

        <div class="logo">
            <i class="fa-solid fa-leaf"></i>
            <span>NutriFlow</span>
        </div>

        <div class="user-menu">
            <button class="user-trigger" type="button" aria-expanded="false">
                <span class="user-name">
                    <?= htmlspecialchars($userName ?? 'Usuário', ENT_QUOTES, 'UTF-8') ?>
                </span>
                <i class="fa-solid fa-user-circle"></i>
            </button>
            <div class="user-dropdown">
                <button id="logout-btn" type="button">Sair</button>
            </div>
        </div>
        
    </header>

    <main class="main-content">

        <section class="intro">

            <span class="badge">
                Alimentação Inteligente
            </span>

            <h1>
                Organize sua alimentação
            </h1>

            <p>
                Informe sua presença na refeição de forma rápida, prática e ajude a reduzir o desperdício de alimentos.
            </p>

        </section>

        <section class="layout">

            <aside class="side-image left">

                <img src="https://cdn-icons-png.flaticon.com/512/1046/1046784.png"
                    alt="Comida saudável">

            </aside>

            <section class="meal-card">

                <div class="date">

                    <i class="fa-solid fa-calendar-days"></i>

                    <span>
                        Segunda-feira, 08 de Julho
                    </span>

                </div>

                <div class="title">

                    <h2>
                        Você irá comer hoje?
                    </h2>

                    <p>
                        Escolha uma das opções abaixo para registrar sua refeição.
                    </p>

                </div>

                <form class="meal-form">

                    <label class="option">

                        <input
                            type="radio"
                            name="refeicao"
                            value="sim"
                            checked>

                        <div class="icon green">
                            <i class="fa-solid fa-bowl-food"></i>
                        </div>

                        <div class="text">

                            <strong>
                                Sim, vou comer
                            </strong>

                            <span>
                                Reservar minha refeição para hoje.
                            </span>

                        </div>

                    </label>

                    <label class="option">

                        <input
                            type="radio"
                            name="refeicao"
                            value="nao">

                        <div class="icon red">
                            <i class="fa-solid fa-ban"></i>
                        </div>

                        <div class="text">

                            <strong>
                                Não vou comer
                            </strong>

                            <span>
                                Cancelar minha refeição de hoje.
                            </span>

                        </div>

                    </label>

                    <label class="option">

                        <input
                            type="radio"
                            name="refeicao"
                            value="lanche">

                        <div class="icon orange">
                            <i class="fa-solid fa-cookie-bite"></i>
                        </div>

                        <div class="text">

                            <strong>
                                Vou trazer lanche
                            </strong>

                            <span>
                                Não utilizarei a refeição da cantina.
                            </span>

                        </div>

                    </label>

                    <button type="submit" class="confirm-btn">

                        <i class="fa-solid fa-check"></i>

                        Confirmar escolha

                    </button>

                </form>

            </section>

            <aside class="side-image right">

                <img src="https://cdn-icons-png.flaticon.com/512/2921/2921822.png"
                    alt="Frutas frescas">

            </aside>

        </section>

        <section class="info-cards">

            <div class="info-card">

                <i class="fa-solid fa-seedling"></i>

                <h3>Sustentabilidade</h3>

                <p>
                    Sua confirmação ajuda a reduzir o desperdício de alimentos e melhora o planejamento da cozinha.
                </p>

            </div>

            <div class="info-card">

                <i class="fa-solid fa-clock"></i>

                <h3>Rapidez</h3>

                <p>
                    Leva menos de um minuto para registrar sua refeição.
                </p>

            </div>

            <div class="info-card">

                <i class="fa-solid fa-chart-line"></i>

                <h3>Organização</h3>

                <p>
                    A administração consegue prever melhor a quantidade de refeições necessárias.
                </p>

            </div>

        </section>

    </main>

    <footer class="footer">

        <div class="footer-content">

            <div class="footer-logo">

                <i class="fa-solid fa-leaf"></i>

                <span>NutriFlow</span>

            </div>

            <p>
                Alimentação inteligente • Reduzindo desperdícios e facilitando a organização das refeições.
            </p>

            <small>
                © 2026 NutriFlow. Todos os direitos reservados.
            </small>

        </div>

    </footer>

</body>

</html>