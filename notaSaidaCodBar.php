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



$idMat        = "";
$descMat      = "";
$loteMat      = "";
$marcaMat     = "";
$medidaMat    = "";
$qtdEmEstoque = "";
$vlUnit       = "";


?>

<?php


$codBar          = filter_input(INPUT_GET, "codBar", FILTER_SANITIZE_NUMBER_INT);
$_SESSION["codBar"] = $codBar;

// $id              = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
// $nf              = filter_input(INPUT_GET, "nf", FILTER_SANITIZE_NUMBER_INT);
// $totalItem       = filter_input(INPUT_GET, "nf", FILTER_SANITIZE_NUMBER_INT);





// comando para abrir  a conexão com o  banco

require_once("./conexao/conexao.php");





try { // O que deve ser feito.






  if ($codBar != "") {
    $comandoSQLJur = "SELECT * FROM c_produto WHERE codBarEst = $codBar";
    $resultado = $conexao->query($comandoSQLJur);
    $linhaBar = $resultado->fetch(PDO::FETCH_ASSOC);




    if ($resultado->rowCount() > 0) {
      $bar              = $codBar;
      $idMat            = isset($linhaBar['id_produto']) ? $linhaBar['id_produto'] : "";
      $descMat          = isset($linhaBar['nome_prod']) ? $linhaBar['nome_prod'] : " ";
      $loteMat          = isset($linhaBar['lote_prod']) ? $linhaBar['lote_prod'] : "";
      $marcaMat         = isset($linhaBar['marca_prod']) ? $linhaBar['marca_prod'] : "";
      $medidaMat        = isset($linhaBar['medida_prod']) ? $linhaBar['medida_prod'] : "";
      $qtdEmEstoque     = isset($linhaBar['qtd_estoque_prod']) ? $linhaBar['qtd_estoque_prod'] : "";
      $vlUnit           = isset($linhaBar['vl_preco_med_prod']) ? $linhaBar['vl_preco_med_prod'] : "";
      $dataValid        = isset($linhaBar['data_valid_prod']) ? $linhaBar['data_valid_prod'] : "";
    } else {
      $bar        = $codBar;
      //$descMat = 'teste';
      // $linhaBar['nome_prod'];

      //header("location:./iteEm.php?id=$seqEnt");

    }
  }
}





// retorno de mensagem de erro
catch (PDOException $erro) {
  echo $erro->getMessage();
}

$conexao = null; // comando para fechar a conexão aberta do banco.







?>




<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nota de Saída</title>

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
    <div class="text-center text-dark display-3"> Nota de Saída </div>
  </div>

  <!-- Form -->
  <div class="container p-2 bg-light border rounded mb-4 mt-4">

    <form class="row align-items-center justify-content-center w-100 h4" role="form" action="" method="GET">

      <div class="col-auto mt-2">
        <label for="codBar" class="col-form-label">Código de Barras:</label>
      </div>
      <div class="col-auto mt-2 w-50">
        <input type="text" class="form-control" id="codBar" name="codBar" maxlength="30" autofocus>
      </div>
      <div class="col-auto w-auto mt-2">
        <button type="submit" class="btn btn-info btn-block">Consultar</button>
      </div>

    </form>

    <?php
      if (!empty($_GET['codBar'])){  ?>

      <div class="py-2 mt-2 bg-primary">
        <p class="text-center display-4 text-capitalize m-0 text-white">COD. BARRAS: <?= $_GET['codBar'] ?></p>
      </div>
    <?php      }     ?>

  </div>

  <!-- Forms -->
  <div class="container bg-light border rounded p-3 mb-3">

  <form name="form" role="form" action="./app/notaSaidaCodBarBD.php" method="POST">

    <div class="d-flex" style="gap: 12px;">
      <div class="form-group w-50">
        <label for="dtSaida">Data de Saída:</label>
        <input type="date" class="form-control" name="dtSaida" id="dtSaida" required>
      </div>

      <div class="form-group w-50">
        <label for="hrSaida">Hora da Saída:</label>
        <input type="time" class="form-control" name="hrSaida" id="hrSaida" required>
      </div>
    </div>

    <div class="form-group">
      <label for="codBar">COD. Barras:</label>
      <input type="text" class="form-control" name="codBar" id="codBar" readonly value="<?= $codBar; ?>">
    </div>

    <div class="d-flex" style="gap: 12px;">
      <div class="form-group w-25">
        <label for="idAlmoxLogin">Almoxarifado:</label>
        <input type="text" class="form-control" name="idAlmoxLogin" id="idAlmoxLogin" readonly value="<?= $_SESSION["idAlmoxLogin"]; ?>">
      </div>

      <div class="form-group w-75">
        <label for="nmRequisitante">Requisitante:</label>
        <input type="text" class="form-control" name="nmRequisitante" id="nmRequisitante" required>
      </div>
    </div>

    <div class="form-group">
      <label for="descMaterial">Descrição do Material:</label>
      <input type="text" class="form-control" name="descMaterial" id="descMaterial" readonly value="<?= $descMat; ?>">
    </div>

    <div class="d-flex" style="gap: 12px;">
      <div class="form-group w-25">
        <label for="idMat">ID. Material:</label>
        <input type="text" class="form-control" name="idMat" id="idMat" readonly value="<?= $idMat; ?>">
      </div>

      <div class="form-group w-25">
        <label for="loteMaterial">Lote Material:</label>
        <input type="text" class="form-control" name="loteMaterial" id="loteMaterial" readonly value="<?= $loteMat; ?>">
      </div>

      <div class="form-group w-50">
        <label for="dataValid">Data Validade:</label>
        <input type="date" class="form-control" name="dataValid" id="dataValid" readonly value="<?= $dataValid; ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="marcaMaterial">Marca do Material:</label>
      <input type="text" class="form-control" name="marcaMaterial" id="marcaMaterial" readonly value="<?= $marcaMat; ?>">
    </div>

    <div class="form-group">
      <label for="medMaterial">Medida:</label>
      <input type="text" class="form-control" name="medMaterial" id="medMaterial" readonly value="<?= $medidaMat; ?>">
    </div>

    <div class="d-flex" style="gap: 12px;">
      <div class="form-group w-50">
        <label for="qtdEmEstoque">Qtd. em Estoque:</label>
        <input type="text" class="form-control" name="qtdEmEstoque" id="qtdEmEstoque" readonly value="<?= $qtdEmEstoque; ?>" onfocus="calcular()">
      </div>

      <div class="form-group w-50">
        <label for="qtdSaida">Qtd. Saida:</label>
        <input type="text" class="form-control" name="qtdSaida" id="qtdSaida" required onfocus="calcular()">
      </div>
    </div>

    <div class="d-flex" style="gap: 12px;">
      <div class="form-group w-50">
        <label for="vlUnit">Vl. Preço Médio:</label>
        <input type="text" class="form-control" name="vlUnit" id="vlUnit" readonly value="<?= $vlUnit; ?>" onblur="calcular()">
      </div>

      <div class="form-group w-50">
        <label for="vlTotalMaterial">Vl. Total Material:</label>
        <input type="text" class="form-control" name="vlTotalMaterial" id="vlTotalMaterial" required onkeypress="calcular()">
      </div>
    </div>

    <!--Botao do cadastro-->
    <div class="justify-content-center">
        <div class="btn btn-lg btn-block">
          <button id="btnRegistrar" type="submit" class="btn btn-info btn-lg btn-block ">Saida</button>
        </div>
        <div class="btn btn-lg btn-block">
          <button type="button" class="btn btn-danger btn-lg btn-block" onclick="window.history.back();">Voltar</button>
        </div>
      </div>

    </div>
    </div>
    </div>

  </form>

  <!-- Scripts -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <script type="text/javascript">
    function calcular() {
      var qtdMat = parseFloat(document.getElementById('qtdSaida').value, 10);
      var vlUnit = parseFloat(document.getElementById('vlUnit').value, 10);
      document.getElementById('vlTotalMaterial').value = qtdMat * vlUnit;


    }



    function validacao() {

      var descMaterial = document.getElementById("descMaterial");


      if (descMaterial.value == "") {

        alert("Formulário Não Enviado, verificar os campos vazios!");
        event.preventDefault();
        return false;





      } else {

        alert("Formulário enviado!");

        // envia o formulário
        //formulario.submit();]

      }


    }
  </script>

</body>

</html>