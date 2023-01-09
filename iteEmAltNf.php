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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Alteração NFs</title>
</head>

<body style="background: rgb(2,0,36);
background: linear-gradient(0deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 50%, rgba(0,212,255,1) 100%);">

  <?php require_once("menu.php"); ?>

  <div class="container bg-light text-center p-3 mt-4 border rounded">
    <div class="display-3">Consulta Material Vencido</div>
  </div>

  <?php
  require_once("./app/alt-view-itens-nf.php");
  ?>

  <div class="container bg-light text-dark border rounded mt-4 mb-4 p-3 text-center d-flex justify-content-center" style="gap: 10px;">

    <h5 class="control-label mt-1">Valor de Conferência:</h5>
    <div class="h5 p-1 border rounded" readonly> 200 </div>


    <h5 class="control-label mt-1">Valor total dos itens:</h5>
    <div class="h5 p-1 border rounded" readonly> 150 </div>

  </div>

  <!-- Tabela dos Materiais -->
  <div class="container bg-light overflow-auto border rounded mb-3 p-3">
    <form name="form" role="form" action="./app/iteEmbdAlt.php" method="POST">

      <!-- ID -->
      <div class="form-group">
        <label for="seqEnt">ID</label>
        <input type="text" class="form-control" name="seqEnt" id="seqEnt" readonly value="<?= $linha['id_capaem']; ?>">
      </div>

      <!-- Numero da NF -->
      <div class="form-group">
        <label for="nf">Numero da NF:</label>
        <input type="text" class="form-control" name="nf" id="nf" readonly value="<?= $linha['numero_notafisc_capaem']; ?>">
      </div>

      <!-- Almoxarifado -->
      <div class="form-group">
        <label for="idAlmoxLogin">Almoxarifado:</label>
        <input type="text" class="form-control" name="idAlmoxLogin" id="idAlmoxLogin" readonly value="<?= $_SESSION['idAlmoxLogin']; ?>">
      </div>

      <!-- Descrição Material -->
      <div class="form-group">
        <label for="descMaterial">Descrição do Material:</label>
        <input type="text" class="form-control" name="descMaterial" id="descMaterial" placeholder="Informe a descrição do produto" required="required">
      </div>

      <!-- Lote Material -->
      <div class="form-group">
        <label for="loteMaterial">Lote Material:</label>
        <input type="text" class="form-control" name="loteMaterial" id="loteMaterial" placeholder="Informe o lote" required="required">
      </div>

      <!-- Data Fabricação -->
      <div class="form-group">
        <label for="dataFab">Data Fabricação:</label>
        <input type="date" class="form-control" name="dataFab" id="dataFab" placeholder="Informe a data no dia que foi frabricada" required="required">
      </div>

      <!-- Data Validade -->
      <div class="form-group">
        <label for="dataValid">Data Validade:</label>
        <input type="date" class="form-control" name="dataValid" id="dataValid" placeholder="Informe a data de Validade" required="required">
      </div>

      <!-- Marca do Material -->
      <div class="form-group">
        <label for="marcaMaterial">Marca do Material:</label>
        <input type="text" class="form-control" name="marcaMaterial" id="marcaMaterial" placeholder="Informe a marca do material" required="required">
      </div>

      <!-- Grupo do Material -->
      <div class="form-group">
        <label for="gpMaterial">Grupo do Material:</label>
        <select class="form-control" name="gpMaterial" id="gpMaterial">
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
        <label for="medMaterial">Medida do Material:</label>
        <select class="form-control" name="medMaterial" id="medMaterial">
          <option selected>Un</option>
          <option>Cx</option>
          <option>Fa</option>
          <option>Pc</option>
          <option>Kg</option>
          <option>Lt</option>
          <option>Mt</option>
        </select>
      </div>

      <!-- Quantidade do Material -->
      <div class="form-group">
        <label for="qtdMat">Quantidade do Material:</label>
        <input type="text" class="form-control" name="qtdMat" id="qtdMat" required="required">
      </div>

      <!-- Vl. Unitário Material -->
      <div class="form-group">
        <label for="vlUnit">Vl. Unitário Material:</label>
        <input type="text" class="form-control" name="vlUnit" id="vlUnit" required="required">
      </div>

      <!-- Vl. Total Material -->
      <div class="form-group">
        <label for="vlTotalMaterial" contenteditable="true">Vl. Total Material:</label>
        <input type="text" class="form-control" name="vlTotalMaterial" id="vlTotalMaterial" readonly required="required" onfocus="calcular()">
      </div>

      <!-- Botoes -->
      <div class="justify-content-center">
        <div class="btn btn-lg btn-block">
          <button id="btnRegistrar" type="button" class="disabled btn btn-info btn-lg btn-block">Alterar</button>
        </div>
        <div class="btn btn-lg btn-block">
          <button type="button" class="btn btn-danger btn-lg btn-block" onclick="window.history.back();">Voltar</button>
        </div>
      </div>
    </form>
  </div>

  <!--Parte js-->
  <script type="text/javascript">
    function calcular() {
      var qtdMat = parseFloat(document.getElementById('qtdMat').value, 10);
      var vlUnit = parseFloat(document.getElementById('vlUnit').value, 10);
      var valorTotal = qtdMat * vlUnit;

      if (valorTotal > 0) {
        document.getElementById('vlTotalMaterial').value = valorTotal;
      } else if (valorTotal === "NaN") {
        document.getElementById('vlTotalMaterial').setAttribute('placeholder', 'Inserir foi inserido os dados')
      }


    }

    function validacao() {
      if (document.form.descMaterial == "") {
        alert("Por favor, preencha o nome do material!");
        document.form.descMaterial.focus();
        return false;

      }

    }
  </script>

</body>

</html>