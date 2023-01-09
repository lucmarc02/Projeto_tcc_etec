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
  <title>Fornecedor</title>

  <!-- Booststrap / AOS animation -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./css-js/styleCss.css">

  <!-- Fonte do Google -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>
<?php require_once("menu.php"); ?>

<!-- Display -->
  <div class="container p-4 mt-4 bg-light border rounded">
    <div class="text-center text-dark display-3"> Fornecedores </div>
  </div>

  <div class="container bg-light text-dark border rounded mt-4 mb-4 p-3 text-center d-flex justify-content-center align-items-center" style="gap: 10px;">

    <?php
    require_once("./app/cons-fornecbd.php");
    foreach ($resultadoFornecedor as $linha) {
    ?>

    <h5 class="control-label mt-1">Total de Forncedores:</h5>
    <div class="h5 p-2 border rounded w-25" readonly> <?php echo $linha["total_cadastro"]; ?> </div>

    <a href="relFornecedores.php" target="_blank"><img src="./img/impressao.png" width="42px"></a>
    <a href="mailto:danilucascoe@gmail.com?subject=Relatorio de Estoque"><img src="./img/gmail.png" alt="" width="42px"></a>

    <?php
    }
    ?>

  </div>

  <div class=" container bg-light overflow-auto border rounded mb-3">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">CNPJ</th>
          <th scope="col">Razão Social</th>
          <th scope="col">CEP</th>
          <th scope="col">UF</th>
          <th scope="col">Cidade</th>
          <th scope="col">Endereço</th>
          <th scope="col">Bairro</th>
          <th scope="col">Telefone</th>
          <th scope="col">Email</th>
          <th scope="col">Alterar</th>
        </tr>
      </thead>
      <tbody>
        <?php
          //buscando o arquivo cons-clientesbd.php
          require_once("./app/cons-fornecbd.php");

          //comando foreach busca os dados da variavel resultado e armazena na variavel  "linha", 
          //jogando a infomação na tabela montada em html alimentado ocm dos dados da variavel linha.
          foreach ($resultado as $linha) {
          ?>
        <tr>
          <th scope="row"> <?php echo $linha["id_forn"]; ?> </th>
          <td><?php echo $linha["cnpj_forn"]; ?></td>
          <td><?php echo $linha["rz_social_forn"]; ?></td>
          <td><?php echo $linha["cep_forn"]; ?></td>
          <td><?php echo $linha["uf_forn"]; ?></td>
          <td><?php echo $linha["cidade_forn"]; ?></td>
          <td><?php echo $linha["endereco_forn"]; ?></td>
          <td><?php echo $linha["bairro_forn"]; ?></td>
          <td><?php echo $linha["telefone_forn"]; ?></td>
          <td><?php echo $linha["email_forn"]; ?></td>
          <td>
            <a href="alt-fornecedor.php?id=<?php echo $linha["id_forn"]; ?> ">
              <img src="./img/troca.png" style="width: 90%;">
            </a>
          <td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Scripts -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>