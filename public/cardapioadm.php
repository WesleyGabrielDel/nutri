<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>NutriFlow | Administração do Cardápio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500&display=swap"
rel="stylesheet">

    <link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <link rel="stylesheet" href="static/css/tokens.css">
    <link rel="stylesheet" href="static/css/cardapioadm.css">

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


<a href="homeadm.php" class="btn-voltar">

<i class="fa-solid fa-arrow-left"></i>

Voltar

</a>


</header>



<main class="container">



<section class="intro">


<span class="badge">

Área do Administrador

</span>


<h1>Gerenciar Cardápio Semanal</h1>


<p>

Cadastre as refeições que serão exibidas para os alunos.

</p>


</section>



<section class="config">


<div>

<label>Semana</label>

<input type="week">

</div>


<div>

<label>Turno</label>

<select>

<option>Manhã</option>

<option>Tarde</option>

</select>

</div>


</section>





<section class="admin-grid">



<article class="menu-editor">


<div class="card-header">


<div class="icon">

<i class="fa-solid fa-bowl-food"></i>

</div>


<h2>Segunda-feira</h2>

<span>07/07/2026</span>


</div>



<div class="imagem">


<i class="fa-solid fa-image"></i>


<button>

Adicionar imagem

</button>


</div>



<label>Prato principal</label>

<textarea placeholder="Descrição do prato"></textarea>






</article>





<article class="menu-editor">


<div class="card-header">


<div class="icon">

<i class="fa-solid fa-utensils"></i>

</div>


<h2>Terça-feira</h2>

<span>08/07/2026</span>


</div>



<div class="imagem">


<i class="fa-solid fa-image"></i>


<button>

Adicionar imagem

</button>


</div>



<label>Prato principal</label>

<textarea placeholder="Descrição do prato"></textarea>






</article>






<article class="menu-editor">


<div class="card-header">


<div class="icon">

<i class="fa-solid fa-drumstick-bite"></i>

</div>


<h2>Quarta-feira</h2>

<span>09/07/2026</span>


</div>



<div class="imagem">


<i class="fa-solid fa-image"></i>


<button>

Adicionar imagem

</button>


</div>



<label>Prato principal</label>

<textarea placeholder="Descrição do prato"></textarea>






</article>





<article class="menu-editor">


<div class="card-header">


<div class="icon">

<i class="fa-solid fa-fire-burner"></i>

</div>


<h2>Quinta-feira</h2>

<span>10/07/2026</span>


</div>



<div class="imagem">


<i class="fa-solid fa-image"></i>


<button>

Adicionar imagem

</button>


</div>



<label>Prato principal</label>

<textarea placeholder="Descrição do prato"></textarea>






</article>

<article class="menu-editor">


<div class="card-header">


<div class="icon">

<i class="fa-solid fa-pizza-slice"></i>

</div>


<h2>Sexta-feira</h2>

<span>11/07/2026</span>


</div>



<div class="imagem">


<i class="fa-solid fa-image"></i>


<button>

Adicionar imagem

</button>


</div>





<label>Prato principal</label>

<textarea placeholder="Descrição do prato"></textarea>






</article>



</section>





<div class="publicar">


<button>

<i class="fa-solid fa-cloud-arrow-up"></i>

Publicar Cardápio

</button>


</div>



</main>


</body>

</html>