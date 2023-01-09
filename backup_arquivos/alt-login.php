<?php
session_start();
if ((!isset($_SESSION["nome"]) == TRUE) and (!isset($_SESSION["nivel"]) == TRUE)) {
  session_unset();
  session_destroy();

  header("location:index.php");
}
 
?>

<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alteração de Dados</title>
  
  <!-- Booststrap / AOS animation -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./css-js/styleCss.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <!-- Fonte do Google -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

</head>

<body style="background: rgb(2,0,36);
background: linear-gradient(0deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 50%, rgba(0,212,255,1) 100%);">

  <?php require_once("menu.php");
  require_once("./app/alt-view-login.php");
  ?>

  <div class="container bg-light text-center p-3 mt-4 border rounded">
    <div class="display-4">Alteração de Dados do Usuario</div>
  </div>

  <div class="container bg-light overflow-auto border rounded p-3 mt-4">

    <form action="./app/alt-loginbd.php" method="POST" role="form">

      <!-- criar o input do "id" -->
      <input type="hidden" name="id" value="<?= $linha['idLogin']; ?>">

      <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome" placeholder="Insira seu nome" required="required" value="<?= $linha['nomeLogin']; ?>">
        <div class="valid-feedback">
          Parece bom!
        </div>
        <div class="invalid-feedback">
          Informe um Nome com mais de 4 caracteres.
        </div>
      </div>

      <div class="form-group">
        <label for="login">Login</label>
        <input type="text" class="form-control" name="login" id="login" placeholder="Altere seu login" required="required" value="<?= $linha['usuarioLogin']; ?>">
        <div class="valid-feedback">
          Parece bom!
        </div>
        <div class="invalid-feedback">
          Informe um Nome com mais de 4 caracteres.
        </div>
      </div>

      <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Altere seu Email" required="required" value="<?= $linha['emailLogin']; ?>">
        <div class="valid-feedback">
          Parece bom!
        </div>
        <div id="emailVerificar" class="invalid-feedback">
          Informe um e-mail válido.
        </div>
      </div>

      <div class="form-group">
        <label for="status">Status usuário</label>
        <select class="form-control" name="status" id="status">
          <option selected="" value="1">Ativo</option>
          <option value="0">Inativo</option>
         </select  value="<?=$linha['nivelLogin'];?>">
      </div>


      <div class="form-group">
        <label for="nivel">Nível do usuário</label>
        <select class="form-control" name="nivel" id="nivel">
          <option selected="" value="1">Administrador</option>
          <option value="2">Usúario</option>
         </select  value="<?=$linha['nivelLogin'];?>">
      </div>


      <div class="form-group">
        <label for="senha">Alterar Senha</label>
        <input type="password" class="form-control" name="senha" id="senha" placeholder="Alterar a senha."  >
        <div class="valid-feedback">
          Parece bom!
        </div>
        <div class="invalid-feedback">
          Informe uma senha com mais de 4 caracteres.
        </div>
      </div>

      <div class="justify-content-center">
        <div class="btn btn-lg btn-block">
          <button id="btnRegistrar" type="submit" class="btn btn-info btn-lg btn-block">Salvar</button>
        </div>
        <div class="btn btn-lg btn-block">
          <button type="button" class="btn btn-danger btn-lg btn-block" onclick="window.history.back();">Voltar</button>
        </div>
      </div>

      <!-- Scripts -->
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

      <!-- Verificar as Labels -->
      <script src="./css-js/preload.js"></script>

</body>

</html>