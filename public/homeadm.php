<?php
    require_once __DIR__ . '/../bootstrap.php';
    SessionManager::verifyAdmin();
    $userName = SessionManager::getCurrentUserName();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriFlow | Home</title>

    <link rel="stylesheet" href="static/css/homeadm.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <script src="static/js/home.js" type="module" defer></script>
</head>
<body>

    <header class="navbar">

        <div class="logo">
            <i class="fa-solid fa-leaf"></i>
            NutriFlow
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

        <section class="text">

            <div class="text-content">

                <span class="badge">
                    Melhor Administração
                </span>

                <h1>
                    Maior Organização.
                    <span>Mais eficiência.</span>
                </h1>

                <p>
                    Usando o NutriFlow você é capaz de organizar melhor a demanda de alimentos, reduzindo o desperdício e otimizando o planejamento da cantina de forma mais eficiente.
                </p>

            </div>

            <div class="text-image">
                <img src="static/imgs/adm.png" alt="foto de administração">
            </div>

        </section>

        <section class="cards">

            <a href="#" class="card">
                <div class="icon">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>

                <h2>Cardápio da Semana</h2>

                <p>
                    Informe os alunos sobre o cardápio da semana
                </p>

            </a>

            <a href="#" class="card">

                <div class="icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <h2>Dashboard de Alunos</h2>

                <p>
                    veja a demanda de alimentos do dia e quantas refeições serão necessárias
                </p>

            </a>

        </section>


    </main>

</body>
</html>