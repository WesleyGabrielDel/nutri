<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NutriFlow | Refeição</title>
  <link rel="stylesheet" href="form.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet"
  href="<link rel="stylesheet" href="/public/static/css/form.css">">
</head>

<body>

  <header class="navbar">
    <div class="logo">
      <i class="fa-solid fa-leaf"></i>
      <span>NutriFlow</span>
    </div>
    <nav>
      <a href="#">Cardápio</a>
      <a href="#">Histórico</a>
      <a href="#">Configurações</a>
    </nav>
  </header>

  <main class="main-content">
    <section class="intro">
      <h1>Organize sua alimentação</h1>
      <p>Sua rotina alimentar simples, prática e inteligente.</p>
    </section>

    <div class="layout">
      <div class="side-image left">
        <img src="https://cdn-icons-png.flaticon.com/512/1046/1046784.png" alt="Comida saudável">
      </div>

      <section class="meal-card">
        <div class="date">
          <i class="fa-solid fa-calendar-days"></i>
          Segunda-feira, 08 de Julho
        </div>

        <h2>Você irá comer hoje?</h2>
        <p>Escolha sua opção de refeição abaixo:</p>

        <form>
          <label class="option">
            <input type="radio" name="refeicao" checked>
            <div class="icon green"><i class="fa-solid fa-bowl-food"></i></div>
            <div>
              <strong>Sim, vou comer</strong>
              <span>Reservar minha refeição para hoje.</span>
            </div>
          </label>

          <label class="option">
            <input type="radio" name="refeicao">
            <div class="icon red"><i class="fa-solid fa-ban"></i></div>
            <div>
              <strong>Não vou comer</strong>
              <span>Cancelar minha refeição de hoje.</span>
            </div>
          </label>

          <label class="option">
            <input type="radio" name="refeicao">
            <div class="icon orange"><i class="fa-solid fa-cookie-bite"></i></div>
            <div>
              <strong>Vou trazer lanche</strong>
              <span>Não utilizarei a refeição da cantina.</span>
            </div>
          </label>

          <label class="remember">
            <input type="checkbox"> Repetir essa escolha automaticamente
          </label>

          <button type="submit">
            <i class="fa-solid fa-check"></i> Confirmar escolha
          </button>
        </form>

        <a href="#" class="menu">
          <i class="fa-solid fa-book-open"></i> Ver cardápio do dia
        </a>
      </section>

      <div class="side-image right">
        <img src="https://cdn-icons-png.flaticon.com/512/2921/2921822.png" alt="Frutas frescas">
      </div>
    </div>
  </main>

  <footer class="footer">
    <p>© 2026 NutriFlow - Alimentação inteligente</p>
  </footer>

</body>
</html>
