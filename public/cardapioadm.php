<?php
require_once __DIR__ . '/../bootstrap.php';
SessionManager::verifyAdmin();
$UserName = SessionManager::getCurrentUserName();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriFlow | Administração do Cardápio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="static/css/tokens.css">
    <link rel="stylesheet" href="static/css/cardapioadm.css">
</head>
<body>
    <header class="navbar">
        <div class="logo">
            <i class="fa-solid fa-leaf"></i>
            <span>NutriFlow</span>
        </div>

        <a href="dashboard.php" class="btn-voltar">
            <i class="fa-solid fa-arrow-left"></i>
            Voltar
        </a>
    </header>

    <main class="container">
        <section class="intro">
            <span class="badge">Área do Administrador</span>
            <h1>Gerenciar Cardápio Semanal</h1>
            <p>Cadastre as refeições que serão exibidas para os alunos.</p>
        </section>

        <section class="admin-grid">
            <article class="menu-editor" data-day="Segunda-feira">
                <div class="card-header">
                    <div class="icon">
                        <i class="fa-solid fa-bowl-food"></i>
                    </div>
                    <h2>Segunda-feira</h2>
                    <span>07/07/2026</span>
                </div>

                <div class="imagem">
                    <label class="upload-label">
                        <i class="fa-solid fa-image"></i>
                        <span class="upload-text">Adicionar imagem</span>
                        <input type="file" accept="image/*" class="image-input">
                    </label>
                </div>

                <label>Título do item</label>
                <input type="text" class="item-title" placeholder="Nome do prato">

                <label>Prato principal</label>
                <textarea class="item-description" placeholder="Descrição do prato"></textarea>
            </article>

            <article class="menu-editor" data-day="Terça-feira">
                <div class="card-header">
                    <div class="icon">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                    <h2>Terça-feira</h2>
                    <span>08/07/2026</span>
                </div>

                <div class="imagem">
                    <label class="upload-label">
                        <i class="fa-solid fa-image"></i>
                        <span class="upload-text">Adicionar imagem</span>
                        <input type="file" accept="image/*" class="image-input">
                    </label>
                </div>

                <label>Título do item</label>
                <input type="text" class="item-title" placeholder="Nome do prato">

                <label>Prato principal</label>
                <textarea class="item-description" placeholder="Descrição do prato"></textarea>
            </article>

            <article class="menu-editor" data-day="Quarta-feira">
                <div class="card-header">
                    <div class="icon">
                        <i class="fa-solid fa-drumstick-bite"></i>
                    </div>
                    <h2>Quarta-feira</h2>
                    <span>09/07/2026</span>
                </div>

                <div class="imagem">
                    <label class="upload-label">
                        <i class="fa-solid fa-image"></i>
                        <span class="upload-text">Adicionar imagem</span>
                        <input type="file" accept="image/*" class="image-input">
                    </label>
                </div>

                <label>Título do item</label>
                <input type="text" class="item-title" placeholder="Nome do prato">

                <label>Prato principal</label>
                <textarea class="item-description" placeholder="Descrição do prato"></textarea>
            </article>

            <article class="menu-editor" data-day="Quinta-feira">
                <div class="card-header">
                    <div class="icon">
                        <i class="fa-solid fa-fire-burner"></i>
                    </div>
                    <h2>Quinta-feira</h2>
                    <span>10/07/2026</span>
                </div>

                <div class="imagem">
                    <label class="upload-label">
                        <i class="fa-solid fa-image"></i>
                        <span class="upload-text">Adicionar imagem</span>
                        <input type="file" accept="image/*" class="image-input">
                    </label>
                </div>

                <label>Título do item</label>
                <input type="text" class="item-title" placeholder="Nome do prato">

                <label>Prato principal</label>
                <textarea class="item-description" placeholder="Descrição do prato"></textarea>
            </article>

            <article class="menu-editor" data-day="Sexta-feira">
                <div class="card-header">
                    <div class="icon">
                        <i class="fa-solid fa-pizza-slice"></i>
                    </div>
                    <h2>Sexta-feira</h2>
                    <span>11/07/2026</span>
                </div>

                <div class="imagem">
                    <label class="upload-label">
                        <i class="fa-solid fa-image"></i>
                        <span class="upload-text">Adicionar imagem</span>
                        <input type="file" accept="image/*" class="image-input">
                    </label>
                </div>

                <label>Título do item</label>
                <input type="text" class="item-title" placeholder="Nome do prato">

                <label>Prato principal</label>
                <textarea class="item-description" placeholder="Descrição do prato"></textarea>
            </article>
        </section>

        <div class="publicar">
            <button type="button" class="publish-menu-btn">
                <i class="fa-solid fa-cloud-arrow-up"></i>
                Publicar Cardápio
            </button>
        </div>
    </main>

    <script src="static/js/cardapioadm.js" defer></script>
</body>
</html>

