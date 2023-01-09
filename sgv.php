<?php
session_start();
if ((!isset($_SESSION["nome"]) == TRUE) and (!isset($_SESSION["nivel"]) == TRUE)) {
  session_unset();
  session_destroy();

  header("location:index.php");
   }


   if ($_SESSION["statusLogin"] != "ATIVO") {
  header("location:index.php");
}

?>

<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SGM</title>

  <!-- Booststrap / AOS animation -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./css-js/styleCss.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <!-- Fonte do Google -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>

  <?php require_once("menu.php"); ?>

  <!-- Titulo -->
  <div class="border p-3 mt-5 shadow" style="margin: 0 auto;background-color: rgba(248, 249, 250, 0.7);">
    <div class="text-center mt-2">
      <div class="text-primary display-4" style="margin: 0 auto;">Bem vindo <?= $_SESSION["nome"]; ?> a SGM</div>
    </div>
  </div>

  <!-- Blocos -->
  <div class="container row" data-aos="fade-right" style=" margin: 0 auto; margin-top: 16vh;">

    <!-- Fornecedor -->
    <div class="media text-white" data-aos="fade-left" style="margin-top: 16vh;">
      <div class="media-body mr-2">
        <h2 class="h2 mt-0">Fornecedores</h2>
        <p class="h4">Tenha o acesso rapido pela Página inicial.</p>
        <p class="h4 mb-0">Tenha conhecimento dos nossos principais Fornecedores, parceiros de trabalho...</p>
      </div>
      <a href="cons-fornecedor.php"><img src="./img/fornecedor.gif" width="200px" height="200px" class="align-self-center rounded" alt="..."></a>
    </div>

    <!-- Estoque -->
    <div class="media text-white" data-aos="fade-right" style="margin-top: 16vh;">
      <a href="cons-estoque.php"><img src="./img/estoque.gif" width="200px" height="200px" class="align-self-center mr-3 rounded" alt="..."></a>
      <div class="media-body">
        <h2 class="h2 mt-0">Estoque</h2>
        <p class="h4">Tenha o acesso rapido pela Página inicial.</p>
        <p class="h4 mb-0">Veja todos os Materiais e todas as Informações sobre o Produto que você desejar.</p>
      </div>
    </div>

    <!-- Notas Fiscais -->
    <div class="media text-white" data-aos="fade-left" style="margin-top: 16vh; margin-bottom: 16vh;">
      <div class="media-body mr-2">
        <h2 class="h2 mt-0">Notas Fiscais</h2>
        <p class="h4">Tenha o acesso rapido pela Página inicial.</p>
        <p class="h4 mb-0">Veja aqui todas as notas fiscais prontos para serem alteradas com as devidas informações sobre aNota Fiscal</p>
      </div>
      <a href="cons-nf.php"><img src="./img/notasfiscais.gif" width="200px" height="200px" class="align-self-center rounded" alt="..."></a>
    </div>
  </div>

  <?php require_once("footer.php"); ?>

  <!-- Scripts -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script>
    AOS.init();
  </script>

</body>

</html>