<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NutriFlow | Cardápio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500&display=swap"
        rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <link rel="stylesheet" href="static/css/tokens.css">
    <link rel="stylesheet" href="static/css/cardapioalu.css">
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

        <a href="form.php" class="btn-voltar">
            <i class="fa-solid fa-arrow-left"></i>
            Voltar ao Formulário
        </a>

    </header>

    <main class="container">

        <section class="intro">

            <span class="badge">
                Cardápio Semanal
            </span>

            <h1>Confira o que será servido</h1>

            <p>
                Antes de responder ao formulário da cantina, veja as refeições
                programadas para cada dia da semana.
            </p>

        </section>

        <section class="menu-grid">

            <article class="menu-card">

                <div class="card-header">

                    <div class="icon">
                        <i class="fa-solid fa-bowl-food"></i>
                    </div>

                    <div>
                        <h2>Segunda-feira</h2>
                        <span>07/07/2026</span>
                    </div>

                </div>

                <img class="menu-image" src="static/imgs/refeitorio.png" alt="Prato do dia">

                <h3>Descrição</h3>
                <p>
                    Frango assado com batatas, acompanhado de arroz e salada.
                </p>

            </article>

            <article class="menu-card">

                <div class="card-header">

                    <div class="icon">
                        <i class="fa-solid fa-utensils"></i>
                    </div>

                    <div>
                        <h2>Terça-feira</h2>
                        <span>08/07/2026</span>
                    </div>

                </div>

                <img class="menu-image" src="static/imgs/refeitorio.png" alt="Prato do dia">

                <h3>Descrição</h3>
                <p>
                    Frango assado com batatas, acompanhado de arroz e salada.
                </p>

            </article>

            <article class="menu-card">

                <div class="card-header">

                    <div class="icon">
                        <i class="fa-solid fa-drumstick-bite"></i>
                    </div>

                    <div>
                        <h2>Quarta-feira</h2>
                        <span>09/07/2026</span>
                    </div>

                </div>

                <img class="menu-image" src="static/imgs/refeitorio.png" alt="Prato do dia">

                <h3>Descrição</h3>
                <p>
                    Frango assado com batatas, acompanhado de arroz e salada.
                </p>

            </article>

            <article class="menu-card quinta">

                <div class="card-header">

                    <div class="icon">
                        <i class="fa-solid fa-fire-burner"></i>
                    </div>

                    <div>
                        <h2>Quinta-feira</h2>
                        <span>10/07/2026</span>
                    </div>

                </div>

                <img class="menu-image" src="static/imgs/refeitorio.png" alt="Prato do dia">

                <h3>Descrição</h3>
                <p>
                    Frango assado com batatas, acompanhado de arroz e salada.
                </p>

            </article>

            <article class="menu-card sexta">

                <div class="card-header">

                    <div class="icon">
                        <i class="fa-solid fa-pizza-slice"></i>
                    </div>

                    <div>
                        <h2>Sexta-feira</h2>
                        <span>11/07/2026</span>
                    </div>

                </div>

                <img class="menu-image" src="static/imgs/refeitorio.png" alt="Prato do dia">

                <h3>Descrição</h3>
                <p>
                    Frango assado com batatas, acompanhado de arroz e salada.
                </p>

            </article>

        </section>

    </main>

</body>

</html>