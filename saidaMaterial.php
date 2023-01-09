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
  <title>Saida de Material</title>

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

  <?php require_once("menu.php");
  require_once("./app/alt-view-itens-saida.php"); ?>


<div class="container p-3 mt-4 mb-4 bg-light border rounded">

  <div class="text-center text-dark display-3 mb-4">    Saida do Material 
  </div>

  <form name="form" role="form" action="./app/notaSaidaBD.php" method="POST">

    <div class="d-flex" style="gap: 12px;">
      <div class="form-group w-50">
        <label for="dtSaida">Data da Saída:</label>
        <input type="date" class="form-control" id="dtSaida" name="dtSaida" required="">
      </div>

      <div class="form-group w-50">
        <label for="hrSaida">Hora da Saída:</label>
        <input type="time" class="form-control" id="hrSaida" name="hrSaida" required="">
      </div>
    </div>

    <div class="d-flex" style="gap: 12px;">
      <div class="form-group w-25">
        <label for="loteMaterial">Almoxarifado:</label>
        <input type="text" class="form-control" name="idAlmoxLogin" id="idAlmoxLogin" readonly value="<?= $_SESSION["idAlmoxLogin"]; ?>">
      </div>

      <div class="form-group w-75">
        <label for="dataValid">Data Validade:</label>
        <input type="date" class="form-control" id="dataValid" name="dataValid" value="<?= $linha['data_valid_prod']; ?>" required="">
      </div>
    </div>

    <div class="form-group">
      <label for="nmRequisitante">Requisitante:</label>
      <input type="text" class="form-control" name="nmRequisitante" id="nmRequisitante">
    </div>

    <div class="d-flex" style="gap: 12px;">
      <div class="form-group w-25">
        <label for="idMat">ID. Material:</label>
        <input type="text" class="form-control" name="idMat" id="idMat" readonly value="<?= $linha["id_produto"]; ?>">
      </div>

      <div class="form-group w-25">
        <label for="loteMaterial">Lote Material:</label>
        <input type="text" class="form-control" name="loteMaterial" id="loteMaterial" readonly value="<?= $linha["lote_prod"]; ?>">
      </div>

      

      <div class="form-group w-25">
        <label for="marcaMaterial">Marca do Material:</label>
        <input type="text" class="form-control" name="marcaMaterial" value="<?= $linha['marca_prod']; ?>" readonly id="marcaMaterial">
      </div>

      <div class="form-group w-25">
        <label for="medMaterial">Medida:</label>
        <input type="text" class="form-control" name="medMaterial" value="<?= $linha['medida_prod']; ?>" readonly id="medMaterial">
      </div>
    </div>

    <div class="form-group">
      <label for="qtdEmEstoque">Qtd. em Estoque:</label>
      <input type="text" class="form-control" name="qtdEmEstoque" value="<?= $linha['qtd_estoque_prod']; ?>" readonly id="qtdEmEstoque" onfocus="calcular()">
    </div>

    <div class="form-group">
      <label for="qtdSaida">Qtd. Saida:</label>
      <input type="text" class="form-control" name="qtdSaida" value="" required id="qtdSaida" onkeyup="calcular()">
    </div>

    <div class="d-flex" style="gap: 12px;">
      <div class="form-group w-50">
        <label for="vlUnit">Vl. Preço Médio:</label>
        <input type="text" class="form-control" name="vlUnit" value="<?= $linha['vl_preco_med_prod']; ?>" readonly id="vlUnit" onfocus="calcular()">
      </div>

      <div class="form-group w-50">
        <label for="vlTotalMaterial">Vl. Total Material:</label>
        <input type="text" class="form-control" name="vlTotalMaterial" readonly id="vlTotalMaterial" required="" onfocus="somar()">
      </div>
    </div>

    <div class="form-group">
      <label for="descMaterial">Descrição do Material</label>
      <input type="text" class="form-control" id="descMaterial" placeholder="Informe a descrição do produto." readonly value="<?= $linha['nome_prod'];?>" name="descMaterial" rows="3"></textarea>
  </div>

  <!-- Botoes -->
      <div class="justify-content-center mt-3">
        <div class="btn btn-lg btn-block">
          <button id="btn" type="submit" class="btn btn-lg btn-block btn-info">Saida</button>
        </div>
        <div class="btn btn-lg btn-block">
          <button type="button" class="btn btn-lg btn-block btn-danger" onclick="window.history.back();">Voltar</button>
        </div>
      </div>
</div>

<!--Parte js-->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
      function calcular() {
        var qtdMat = parseFloat(document.getElementById('qtdSaida').value, 10);
        var vlUnit = parseFloat(document.getElementById('vlUnit').value, 10);
        document.getElementById('vlTotalMaterial').value = qtdMat * vlUnit;

        if (document.getElementById('vlTotalMaterial').value === "NaN") {
          document.getElementById('vlTotalMaterial').value = "Número invalido!"
        } else {
          document.getElementById('btn').removeAttribute('disabled', '   ');
        }

        if (document.getElementById('vlTotalMaterial').value == "Número invalido!") {
          document.getElementById('btn').setAttribute('disabled', '   ');
        }
      }



      function validacao() {
        if (document.form.descMaterial == "") {
          alert("Por favor, prrencha o nome do material!");
          document.form.descMaterial.focus();
          return false;

        }
      }


    </script>

</body>

</html>