<?php
    require_once __DIR__ . '/../bootstrap.php';
    SessionManager::verify();
    $userName = SessionManager::getCurrentUserName();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriFlow | Home</title>

    <link rel="stylesheet" href="static/css/home.css">

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
                    Melhor planejamento
                </span>

                <h1>
                    Menos desperdício.
                    <span>Mais eficiência.</span>
                </h1>

                <p>
                    O NutriFlow é uma plataforma da qual permite que os usuarios informem se irão consumir a refeição do dia, ajudando a reduzir o desperdício e otimizando o planejamento da cantina.
                </p>

            </div>

            <div class="text-image">
                <img src="static/imgs/refeitorio.png" alt="Refeitório escolar">
            </div>

        </section>

        <section class="cards">

            <a href="cardapioalu.php" class="card">
                <div class="icon">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>

                <h2>Cardápio da Semana</h2>

                <p>
                    Consulte as refeições disponíveis para cada dia.
                </p>

            </a>

            <a href="form.php" class="card">

                <div class="icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <h2>Formulário da cantina</h2>

                <p>
                    Informe se irá comer hoje para evitar desperdícios.
                </p>

            </a>

        </section>


    </main>

</body>
</html>