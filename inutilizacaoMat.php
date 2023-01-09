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
  <title>Inutilização de Materiais</title>
  
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

  <?php
  require_once("menu.php");
  //require_once("./app/alt-view-itens-nf.php");
  require_once("./app/alt-view-itens-inutlizados.php");
  ?>

  <!-- container -->
  <div class="container justify-content-center mt-5 mb-5 bg-white p-3 col-11 rounded shadow w-75">

    <div style="margin: 0 auto; text-align: center;">
      <div class="display-3 mb-4 mt-4">Inutilização de Materiais</div>
    </div>

    <!-- Começo do Forms -->
    <form name="form" class="needs-validation justify-content-center" role="form" action="./app/inutilizacaoMatbd.php" method="POST">

      <!-- Almoxarifado -->
      <div class="form-group">
        <label for="idAlmoxLogin">Almoxarifado:</label>
        <input type="text" class="form-control" id="idAlmoxLogin" name="idAlmoxLogin" readonly value="<?= $_SESSION["idAlmoxLogin"]; ?>">
      </div>

      <!-- Motivo -->
      <div class="form-group">
        <label for="movAcerto">Motivo:</label>
        <select class="form-control" name="movAcerto" id="movAcerto">
          <option selected=>Material Vencido</option>
          <option>Outra Coisa</option>
        </select>
      </div>


      <!-- Hora da Baixa / Data da Baixa / Data Fabricação / Data Validade -->
      <div class="d-flex" style="gap: 16px;">

        <div class="form-group w-25">
          <label for="hrInventario">Hora da Baixa:</label>
          <input type="time" class="form-control" id="hrInventario" name="hrInventario">
        </div>

        <div class="form-group w-25">
          <label for="dtInventario">Data da Baixa:</label>
          <input type="date" class="form-control" id="dtInventario" name="dtInventario">
        </div>

        <div class="form-group w-25">
          <label for="dataFab" class="control-loteMaterial">Data Fabricação:</label>
          <input type="text" class="form-control" id="dataFab" name="dataFab" readonly value="<?= $linha['data_fab_prod']; ?>">
        </div>

        <div class="form-group w-25">
          <label for="dataValid" class="control-loteMaterial">Data Validade:</label>
          <input type="text" class="form-control" id="dataValid" name="dataValid" readonly value="<?= $linha['data_valid_prod']; ?>">
        </div>
      </div>

      <!-- id. material / lote material / desc. material -->
      <div class="d-flex" style="gap: 16px;">
        <div class="form-group w-50">
          <label for="idMat" class="control-descMaterial">Descrição do Material:</label>
          <input type="text" class="form-control" id="descMaterial" name="descMaterial" readonly value="<?= $linha['nome_prod']; ?>">
        </div>
        <div class="form-group w-25">
          <label for="idMat" class="control-label">ID. Material:</label>
          <input type="text" class="form-control" id="idMat" name="idMat" readonly value="<?= $linha['id_produto']; ?>">
        </div>

        <div class="form-group w-25">
          <label for="idMat" class="control-loteMaterial">Lote Material:</label>
          <input type="text" class="form-control" id="loteMaterial" name="loteMaterial" readonly value="<?= $linha['lote_prod']; ?>">
        </div>
      </div>

      <!-- marca do material -->
      <div class="form-group">
        <label for="marcaMaterial" class="control-loteMaterial">Marca do Material:</label>
        <input type="text" class="form-control" id="marcaMaterial" name="marcaMaterial" readonly value="<?= $linha['marca_prod']; ?>">
      </div>

      <!-- medida -->
      <div class="form-group">
        <label for="medMaterial" class="control-loteMaterial">Medida:</label>
        <input type="text" class="form-control" id="medMaterial" name="medMaterial" readonly value="<?= $linha['medida_prod']; ?>">
      </div>

      <!-- vl. preco medio / vl. total material / quant. estoque-->
      <div class="d-flex" style="gap: 16px;">

        <div class="form-group w-25">
          <label for="qtdEmEstoque" class="control-loteMaterial">Quantidade em Estoque:</label>
          <input type="text" class="form-control" id="qtdEmEstoque" name="qtdEmEstoque" readonly value="<?= $linha['qtd_estoque_prod']; ?>" onkeyup="calcular()">
        </div>

        <div class="form-group w-25">
          <label for="vlUnit" class="control-loteMaterial">Vl. Preço Médio:</label>
          <input type="text" class="form-control" id="vlUnit" name="vlUnit" readonly value="<?= $linha['vl_preco_med_prod']; ?>" onkeyup="calcular()">
        </div>

        <div class="form-group w-50">
          <label for="vlTotalMaterial" class="control-loteMaterial">Vl. Total Material:</label>
          <input type="text" class="form-control" id="vlTotalMaterial" name="vlTotalMaterial" readonly="" value="<?= $linha['vl_preco_total_prod']; ?>">
        </div>
      </div>

      <!-- Botoes -->
      <div class="justify-content-center mt-3">
        <div class="btn btn-lg btn-block">
          <button type="submit" class="btn btn-lg btn-block btn-info">Baixar</button>
        </div>
        <div class="btn btn-lg btn-block">
          <button type="button" class="btn btn-lg btn-block btn-danger" onclick="window.history.back();">Voltar</button>
        </div>
      </div>
    </form>
  </div>


  <!--Parte js -->

  <script type="text/javascript">
    function calcular() {
      var qtdMat = parseFloat(document.getElementById('qtdEmEstoque').value);
      var vlUnit = parseFloat(document.getElementById('vlUnit').value);
      document.getElementById('vlTotalMaterial').value = qtdMat * vlUnit;
    }

    function validacao() {
      if (document.form.descMaterial == "") {
        alert("Por favor, prrencha o nome do material!");
        document.form.descMaterial.focus();
        return false;
      }
    }
  </script>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>