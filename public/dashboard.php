<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NutriFlow | Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500&display=swap"
        rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

    <link rel="stylesheet" href="static/css/tokens.css">
    <link rel="stylesheet" href="static/css/dashboard.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="./static/js/dashboard.js" type="module" defer></script>
</head>

<?php

    require_once __DIR__ . '/../bootstrap.php';
    SessionManager::verifyAdmin();
    $userName = SessionManager::getCurrentUserName();

?>

<body>

    <header class="navbar">

        <div class="logo">
            <i class="fa-solid fa-leaf"></i>
            <span>NutriFlow</span>
        </div>

        <nav class="nav-links">
            <a href="dashboard.php" class="active">Dashboard</a>
            <a href="cardapioadm.php">Cardápio</a>
        </nav>

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
                Painel Administrativo
            </span>

            <h1>
                Dashboard Operacional
            </h1>

            <p>
                Acompanhe em tempo real as confirmações, custos previstos e quantidade de refeições necessárias para o
                turno selecionado.
            </p>

        </section>

        <section class="dashboard-top">

            <div class="dashboard-info">

                <div class="info-box">

                    <i class="fa-solid fa-calendar-days"></i>

                    <div>

                        <span>Data</span>

                        <strong>
                            09 de Julho de 2026
                        </strong>

                    </div>

                </div>

                <div class="info-box">

                    <i class="fa-solid fa-clock"></i>

                    <div>

                        <span>Turno</span>

                        <strong>
                            Manhã
                        </strong>

                    </div>

                </div>

            </div>

        </section>

        <section class="dashboard-metrics">

            <article class="metric-card">
                <div class="metric-top">
                    <div class="metric-icon teal">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                    <span class="status-dot ok" id="totalMealsDot"></span>
                </div>

                <span class="metric-label">Refeições necessárias</span>
                <strong id="totalMeals" class="metric-value">152</strong>
                <small class="metric-sub">Quantidade prevista para o turno.</small>
            </article>

            <article class="metric-card">
                <div class="metric-top">
                    <div class="metric-icon ok">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <span class="status-label ok" id="confirmedLabel">
                        <span class="status-dot ok"></span> OK
                    </span>
                </div>

                <span class="metric-label">Confirmados</span>
                <strong id="confirmedMeals" class="metric-value">0</strong>
                <small class="metric-sub">Alunos que confirmaram presença.</small>
            </article>

            <article class="metric-card">
                <div class="metric-top">
                    <div class="metric-icon bad">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </div>
                    <span class="status-label bad" id="cancelledLabel">
                        <span class="status-dot bad"></span> Alto
                    </span>
                </div>

                <span class="metric-label">Cancelados</span>
                <strong id="cancelledMeals" class="metric-value">0</strong>
                <small class="metric-sub">Alunos que cancelaram a refeição.</small>
            </article>

            <article class="metric-card">
                <div class="metric-top">
                    <div class="metric-icon amber">
                        <i class="fa-solid fa-wheat-awn"></i>
                    </div>
                    <span class="status-label attn" id="forecastLabel">
                        <span class="status-dot attn"></span> Atenção
                    </span>
                </div>

                <span class="metric-label">Previsão de alimento</span>
                <strong id="foodForecast" class="metric-value">0 kg</strong>
                <small class="metric-sub">Quantidade estimada de insumos.</small>
            </article>

            <article class="metric-card highlight">
                <div class="metric-top">
                    <div class="metric-icon teal">
                        <i class="fa-solid fa-sack-dollar"></i>
                    </div>
                </div>

                <span class="metric-label">Custo previsto</span>
                <strong id="estimatedCost" class="metric-value">R$ 0,00</strong>
                <small class="metric-sub">Estimativa total do turno.</small>
            </article>

        </section>

                <section class="dashboard-content">

            <div class="chart-card">

                <div class="card-header">

                    <div>

                        <h2>Resumo de presença</h2>

                        <p>
                            Distribuição das confirmações registradas para o turno.
                        </p>

                    </div>

                    <i class="fa-solid fa-chart-pie"></i>

                </div>

                <div class="chart-area">
                    <canvas id="presenceChart"></canvas>
                </div>

            </div>

            <div class="chart-card">

                <div class="card-header">

                    <div>

                        <h2>Demanda de alimentos</h2>

                        <p>
                            Comparação entre refeições previstas e quantidade de insumos.
                        </p>

                    </div>

                    <i class="fa-solid fa-chart-column"></i>

                </div>

                <div class="chart-area">
                    <canvas id="demandChart"></canvas>
                </div>

            </div>

        </section>

        <section class="dashboard-summary">

            <div class="summary-card">

                <div class="summary-header">

                    <h2>Situação da operação</h2>

                    <span>Atualizado em tempo real</span>

                </div>

                <div class="summary-grid">

                    <div class="summary-item">

                        <i class="fa-solid fa-wallet"></i>

                        <div>

                            <span>Receita prevista</span>

                            <strong id="revenueValue">R$ 0,00</strong>

                        </div>

                    </div>

                    <div class="summary-item">

                        <i class="fa-solid fa-users"></i>

                        <div>

                            <span>Taxa de ocupação</span>

                            <strong id="occupancyValue">0%</strong>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>

</body>

</html>