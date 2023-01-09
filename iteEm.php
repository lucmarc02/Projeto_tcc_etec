<?php
session_start();
if ((!isset($_SESSION["nome"]) == TRUE) and (!isset($_SESSION["nivel"]) == TRUE)) {
  session_unset();
  session_destroy();

  header("location:index.php");
}

//Inicializando as variaveis com valor vazio.

$descMat = "";
$loteMat = "";
$marcaMat = "";
$grupoMat = "";

$id =  filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if ($id != "") {
  $_SESSION["id"] =  filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
}

$nf =  filter_input(INPUT_GET, "nf", FILTER_SANITIZE_NUMBER_INT);

if ($nf != "") {
  $_SESSION["nf"] =  filter_input(INPUT_GET, "nf", FILTER_SANITIZE_NUMBER_INT);
}

$vlConf =  filter_input(INPUT_GET, "vlConf", FILTER_SANITIZE_STRING);

if ($vlConf != "") {
  $_SESSION["vlConf"] =  filter_input(INPUT_GET, "vlConf", FILTER_SANITIZE_STRING);
}

$vlTotal =  filter_input(INPUT_GET, "vlTotal", FILTER_SANITIZE_STRING);

/*     require_once("./conexao/conexao.php"); 

     $precoTotalItens = "SELECT sum(c.vl_total_ite) as total_itens_nf FROM c_item_em c WHERE c.id_capaem = ".$id."";


      $select = $conexao->query($precoTotalItens);
      //$resultado = $select->fetchAll();
      $resultado = $conexao->query($precoTotalItens);
      $precoTotalItensNf = $resultado->fetch(PDO::FETCH_ASSOC);
     */

if ($vlTotal != "") {
  $_SESSION["vlTotal"] = filter_input(INPUT_GET, "vlTotal", FILTER_SANITIZE_STRING);
  //$vlTotalItem = $_SESSION["vlTotal"] + filter_input(INPUT_GET, "vlTotal", FILTER_SANITIZE_STRING);

}



?>


<?php




/* FILTER_SANITIZE_STRING COMANDO PARA PROTEGER DO SQL INJETION , TRANSFORMANDO EM TEXTO CADASTRO PESSOA ENTRADA NF*/



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
      $bar        = $codBar;
      $descMat     = isset($linhaBar['nome_prod']) ? $linhaBar['nome_prod'] : " ";
      $loteMat     = isset($linhaBar['lote_prod']) ? $linhaBar['lote_prod'] : "";
      $marcaMat    = isset($linhaBar['marca_prod']) ? $linhaBar['marca_prod'] : "";
      $grupoMat    = isset($linhaBar['grupo_prod']) ? $linhaBar['grupo_prod'] : "";
      $medidaMat   = isset($linhaBar['medida_prod']) ? $linhaBar['medida_prod'] : "";
      $dataFab   = isset($linhaBar['data_fab_prod']) ? $linhaBar['data_fab_prod'] : "";
      $dataValid   = isset($linhaBar['data_valid_prod']) ? $linhaBar['data_valid_prod'] : "";
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
  <title>Item da Nota Fiscal</title>

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

  <!-- Display -->
  <div class="container p-4 mt-4 bg-light border rounded">
    <div class="text-center text-dark display-3"> Itens da Nota Fiscal </div>
  </div>

  <div class="container bg-light text-dark border rounded mt-4 mb-4 p-3 text-center d-flex justify-content-center align-items-center" style="gap: 10px;">

    <h5 class="control-label mt-1">Valor de Conferência:</h5>
   <!-- <div class="h5 p-2 border rounded" name="vlConf" id="vlConf" value="<?= $_SESSION["vlConf"]; ?>" readonly></div> -->
    <input name="vlConf" id="vlConf" type="text" class="h5 p-2 border text-center rounded mt-1 w-25" readonly value="<?= $_SESSION["vlConf"]; ?>" style="background-color: #00000000;">

   <h5 class="control-label mt-1">Valor total dos itens:</h5>
    <!--  <div class="h5 p-2 border rounded" value="<?= $_SESSION["vlTotal"]; ?>" readonly></div>  -->
    <input id="vlTotal" name="vlTotal" type="text" class="h5 p-2 border text-center rounded mt-1 w-25" readonly readonly value="<?= $_SESSION["vlTotal"]; ?>" style="background-color: #00000000;">

  </div>


  <div class="container p-2 bg-light border rounded mb-4">

    <form class="row align-items-center justify-content-center w-100" role="form" action="" method="GET">

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

  <div class="container bg-light border rounded mb-4 p-3">

    <form name="form" role="form" action="./app/iteEmbd.php" method="POST">


      <!-- ID / Numero da N.F / Almoxarifado / Lote Material -->
      <div class="d-flex mb-3" style="gap: 12px;">

        
        <div class="form-group w-25">
          <label for="seqEnt">ID:</label>
          <input type="text" class="form-control" name="seqEnt" id="seqEnt" readonly value="<?= $_SESSION["id"]; ?>">
        </div>

        <div class="form-group w-50">
          <label for="nf">Numero da N.F:</label>
          <input type="text" class="form-control" id="nf" name="nf" readonly value="<?= $_SESSION["nf"]; ?>">
        </div>

        <div class="form-group w-25">
          <label for="idAlmoxLogin">Almoxarifado:</label>
          <input type="text" class="form-control" name="idAlmoxLogin" id="idAlmoxLogin" readonly value="<?= $_SESSION["idAlmoxLogin"]; ?>">
        </div>


      </div>

      <div class="form-group mb-3">
        <label for="codBar">Código de Barras:</label>
        <input type="text" class="form-control" name="codBar" id="codBar" required placeholder="Informe o código de barras." value="<?= $_SESSION["codBar"]; ?>">
      </div>

      <!-- Data Fabricação / Data de Validade -->
      <div class="d-flex" style="gap: 12px;">
        <div class="form-group w-50">
          <label for="dataFab">Data Fabricação:</label>
          <input type="date" class="form-control" name="dataFab" id="dataFab" required value="<?= $linhaBar['data_fab_prod']; ?>">
        </div>

        <div class="form-group w-50">
          <label for="dataValid">Data Validade:</label>
          <input type="date" class="form-control" name="dataValid" id="dataValid" required value="<?= $linhaBar['data_fab_prod']; ?>">
        </div>
      </div>

      <div class="d-flex" style="gap: 12px;">
        <div class="form-group w-25">
          <label for="loteMaterial">Lote Material:</label>
          <input type="text" class="form-control" name="loteMaterial" id="loteMaterial" required value="<?= $loteMat; ?>">
        </div>

        <div class="form-group w-75">
          <label for="marcaMaterial">Marca do Material:</label>
          <input type="text" class="form-control" name="marcaMaterial" id="marcaMaterial" required placeholder="Informe a marca do material." value="<?= $marcaMat; ?>">
        </div>

      </div>

      <!-- Medida do Material -->
      <div class="form-group">
        <label for="medMaterial" class="">Medida do Material:</label>
        <select name="medMaterial" id="medMaterial" class="form-control">
          <option selected>Un</option>
          <option>Cx</option>
          <option>Fa</option>
          <option>Pc</option>
          <option>Kg</option>
          <option>Lt</option>
          <option>Mt</option>
        </select>
      </div>

      <!-- Grupo do Material -->
      <div class="form-group">
        <label for="gpMaterial" class="">Grupo do Material:</label>
        <select name="gpMaterial" id="gpMaterial" class="form-control">
          <option selected>Gêneros alimenticios</option>
          <option>Material de Limpeza</option>
          <option>Material de Expediente</option>
          <option>Material de Copa e Cozinha</option>
          <option>Ferramentas</option>
          <option>Material Elétrico</option>
          <option>Material Hidráulico</option>
        </select>
      </div>

      <div class="form-group">
        <label for="descMaterial">Material:</label>
        <input type="text" class="form-control" name="descMaterial" id="descMaterial" required placeholder="Informe o código descrição material." value="<?= $descMat ?>">
      </div>

      <div class="form-group">
        <label for="qtdMat">Quantidade do Material:</label>
        <input type="text" class="form-control" name="qtdMat" id="qtdMat" required onkeyup="calcular()">
      </div>

      <div class="form-group">
        <label for="vlUnit">Vl. Unitário Material:</label>
        <input type="text" class="form-control" name="vlUnit" id="vlUnit" required onkeyup="calcular()">
      </div>

      <div class="form-group">
        <label for="vlTotalMaterial" contenteditable="true">Vl. Total Material:</label>
        <input type="text" class="form-control" name="vlTotalMaterial" id="vlTotalMaterial" required readonly onblur="somar()">
      </div>

      <!-- Botoes -->
      <div class="justify-content-center">
        <div class="btn btn-lg btn-block">
          <button id="btnRegistrar" onclick="validar()" type="submit" class="btn btn-info btn-lg btn-block">Cadastrar</button>
        </div>
        <div class="btn btn-lg btn-block">
          <button type="button" class="btn btn-danger btn-lg btn-block" onclick="window.history.back();">Voltar</button>
        </div>
      </div>
    </form>
  </div>

  <!--Parte js-->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  <script type="text/javascript">
    function calcular() {
      var qtdMat = parseFloat(document.getElementById('qtdMat').value, 10);
      var vlUnit = parseFloat(document.getElementById('vlUnit').value, 10);
      document.getElementById('vlTotalMaterial').value = qtdMat * vlUnit;
    }

    function validar() {
      // pegando o valor do nome pelos names
      var vlConf = document.getElementById("vlConf");
      var vlTotalMaterial = document.getElementById("vlTotalMaterial");
      var vlTotal = document.getElementById("vlTotal");
      var vlTotalGeral = parseFloat(vlTotal.value) + parseFloat(vlTotalMaterial.value);

      var descMaterial = document.getElementById("descMaterial");


      if (descMaterial.value == "") {
        alert("Formulário Não Enviado, verificar os campos vazios!");
        event.preventDefault();
        return false;

      }

      if (vlTotalGeral > vlConf.value) {
        alert("Formulário Não Enviado, somatório Total dos item(s) da nota fiscal MAIOR que o valor da Nota Fiscal!" + vlTotalMaterial.value + " + " + vlTotal.value + " = " + vlTotalGeral + " valor Conf: " + vlConf.value);
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