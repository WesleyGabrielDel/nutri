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

    $mysqli = Database::Connect();

    function detectMenuTable($mysqli) {
        $possibleTables = [
            'cardaoio',
            'cardapio',
            'menu',
            'cardapio_semana',
            'weekly_menu',
            'weekly_cardapio'
        ];

        foreach ($possibleTables as $table) {
            $escapedTable = $mysqli->real_escape_string($table);
            $result = Database::request("SHOW TABLES LIKE '{$escapedTable}'", null, $mysqli);
            if ($result && count($result) > 0) {
                return $table;
            }
        }

        return null;
    }

    function tableHasColumns($table, $mysqli) {
        $required = ['day', 'nome', 'image', 'description'];
        $columns = Database::request("SHOW COLUMNS FROM {$table}", null, $mysqli);
        if ($columns === false) {
            return false;
        }

        $names = array_map(function ($column) {
            return strtolower($column['Field']);
        }, $columns);

        foreach ($required as $field) {
            if (!in_array($field, $names, true)) {
                return false;
            }
        }

        return true;
    }

    function getMenuItems($mysqli) {
        $table = detectMenuTable($mysqli);
        if ($table === null || !tableHasColumns($table, $mysqli)) {
            return [];
        }

        $rows = Database::request("SELECT day, nome, image, description FROM {$table}", null, $mysqli);
        if ($rows === false) {
            return [];
        }

        $items = [];
        foreach ($rows as $row) {
            $items[trim($row['day'])] = $row;
        }

        return $items;
    }

    function detectImageMimeType($data) {
        if (!is_string($data)) {
            return 'image/png';
        }

        if (strncmp($data, "\x89PNG", 4) === 0) {
            return 'image/png';
        }

        if (strncmp($data, "\xFF\xD8\xFF", 3) === 0) {
            return 'image/jpeg';
        }

        if (strncmp($data, 'GIF87a', 6) === 0 || strncmp($data, 'GIF89a', 6) === 0) {
            return 'image/gif';
        }

        if (strncmp($data, 'RIFF', 4) === 0 && substr($data, 8, 4) === 'WEBP') {
            return 'image/webp';
        }

        return 'image/png';
    }

    function getMenuImageSrc($row) {
        if (empty($row['image'])) {
            return 'static/imgs/refeitorio.png';
        }

        $imageData = $row['image'];
        if (is_string($imageData) && preg_match('/^data:\w+\/[-+.\w]+;base64,/', $imageData)) {
            return $imageData;
        }

        $mimeType = detectImageMimeType($imageData);
        return 'data:' . $mimeType . ';base64,' . base64_encode($imageData);
    }

    $menuItems = getMenuItems($mysqli);
    $mysqli->close();

?>

<body>

    <header class="navbar">

        <div class="logo">
            <i class="fa-solid fa-leaf"></i>
            <span>NutriFlow</span>
        </div>

        <a href="home.php" class="btn-voltar">
            <i class="fa-solid fa-arrow-left"></i>
            Voltar
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

            <?php
                $days = [
                    'Segunda-feira',
                    'Terça-feira',
                    'Quarta-feira',
                    'Quinta-feira',
                    'Sexta-feira'
                ];

                $icons = [
                    'Segunda-feira' => 'fa-bowl-food',
                    'Terça-feira' => 'fa-utensils',
                    'Quarta-feira' => 'fa-drumstick-bite',
                    'Quinta-feira' => 'fa-fire-burner',
                    'Sexta-feira' => 'fa-pizza-slice'
                ];

                $dates = [
                    'Segunda-feira' => '07/07/2026',
                    'Terça-feira' => '08/07/2026',
                    'Quarta-feira' => '09/07/2026',
                    'Quinta-feira' => '10/07/2026',
                    'Sexta-feira' => '11/07/2026'
                ];

                foreach ($days as $day) {
                    $item = $menuItems[$day] ?? null;
                    $title = $item['nome'] ?? 'Refeição não definida';
                    $description = $item['description'] ?? 'Descrição não disponível.';
                    $imageSrc = getMenuImageSrc($item);
                    $iconClass = $icons[$day] ?? 'fa-utensils';
                    $extraClass = $day === 'Quinta-feira' ? 'quinta' : ($day === 'Sexta-feira' ? 'sexta' : '');
            ?>
            <article class="menu-card <?php echo $extraClass; ?>">

                <div class="card-header">

                    <div class="icon">
                        <i class="fa-solid <?php echo $iconClass; ?>"></i>
                    </div>

                    <div>
                        <h2><?php echo htmlspecialchars($day, ENT_QUOTES, 'UTF-8'); ?></h2>
                        <span><?php echo htmlspecialchars($dates[$day], ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>

                </div>

                <img class="menu-image" src="<?php echo $imageSrc; ?>" alt="Prato do dia">

                <h3><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h3>
                <p>
                    <?php echo nl2br(htmlspecialchars($description, ENT_QUOTES, 'UTF-8')); ?>
                </p>

            </article>
            <?php } ?>

        </section>

    </main>

</body>

</html>