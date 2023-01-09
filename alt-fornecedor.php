<?php
session_start();
if ((!isset($_SESSION["nome"]) == TRUE) and (!isset($_SESSION["nivel"]) == TRUE)) {
  session_unset();
  session_destroy();

  header("location:index.php");
}

//validando o nivel de permissão da pagina consulta
if ($_SESSION["nivel"] != "Administrador") {
  header("location:index.php");
}

?>


<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alteração de Fornecedor</title>
  
  <!-- Booststrap / AOS animation -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./css-js/styleCss.css">

  <!-- Fonte do Google -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>

<?php require_once("menu.php");
      require_once("./app/alt-view-fornecedor.php"); ?>

<div class="container p-3 mt-4 mb-4 bg-light border rounded">

  <div class="text-center text-dark display-3 mb-4"> Alteração cadastro fornecedor </div>

  <form name="form" role="form" action="./app/alt-view-fornecedor-bd.php" method="POST">

    <div class="d-flex" style="gap: 12px;">
      <div class="form-group w-25">
        <label for="idForn">ID. Fornecedor:</label>
        <input type="text" class="form-control" name="idForn" id="idForn" readonly value="<?= $linha["id_forn"]; ?>">
      </div>

      <div class="form-group w-75">
        <label for="cnpj">CNPJ:</label>
        <input type="text" class="form-control" name="cnpj" id="cnpj" readonly value="<?= $linha["cnpj_forn"]; ?>">
      </div>
    </div>
    

    <div class="form-group">
      <label for="razaoSocial">Razão Social:</label>
      <input type="text" class="form-control" name="razaoSocial" id="razaoSocial" placeholder="Informe a descrição do produto." required value="<?= $linha["rz_social_forn"]; ?>">
    </div>

    <div class="d-flex" style="gap: 12px;">
      <div class="form-group w-50">
        <label for="cep">CEP:</label>
        <input type="text" class="form-control" name="cep" id="cep" placeholder="Ex:12345-67" required value="<?= $linha["cep_forn"]; ?>">
      </div>

      <div class="form-group w-50">
        <label for="uf">UF:</label>
        <input type="text" class="form-control" name="uf" id="uf" placeholder="Estado" required value="<?= $linha["uf_forn"]; ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="cidade">Cidade:</label>
      <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade" required value="<?= $linha["cidade_forn"]; ?>">
    </div>

    <div class="form-group">
      <label for="endereco">Endereço:</label>
      <input type="text" class="form-control" name="endereco" id="endereco" placeholder="Endereço" required value="<?= $linha["cidade_forn"]; ?>">
    </div>

    <div class="form-group">
      <label for="bairro">Bairro:</label>
      <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro" required value="<?= $linha["bairro_forn"]; ?>">
    </div>

    <div class="form-group">
      <label for="telefone">Telefone:</label>
      <input type="text" class="form-control" name="telefone" id="telefone" placeholder="Informe seu número de contato!" required value="<?= $linha["telefone_forn"]; ?>">
    </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" class="form-control" name="email" id="email" placeholder="Informe seu email de contato!" required value="<?= $linha["email_forn"]; ?>">
    </div>

    <div class="justify-content-center">
      <div class="btn btn-lg btn-block">
        <button id="btnRegistrar" type="submit" class="btn btn-info btn-lg btn-block">Alterar</button>
      </div>
      <div class="btn btn-lg btn-block">
        <button type="button" class="btn btn-danger btn-lg btn-block" onclick="window.history.back();">Voltar</button>
      </div>
    </div>
  </form>
</div>

  <!-- Scripts -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>