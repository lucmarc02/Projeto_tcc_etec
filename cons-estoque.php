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
  <title>Estoque</title>

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

  <?php require_once("./app/cons-estoquebd.php");
  foreach ($resultadoItensEstoque as $linha) {
  ?>

    <div class="container" style="max-width: calc(60vw + 200px);">

      <!-- Display -->
      <div class="container p-4 mt-4 bg-light border-0 rounded">
        <div class="text-center text-dark display-3"> Estoque </div>
      </div>

      <div class="container bg-light text-dark border rounded mt-4 mb-4 p-3 text-center d-flex flex-wrap justify-content-center align-items-center" style="gap: 10px;">

        <h5 class="control-label mt-1">Itens no Estoque:</h5>
        <div class="h5 p-2 border rounded w-25" readonly> <?php echo $linha["intensEstoque"]; ?> </div>


        <h5 class="control-label mt-1">Total do Estoque:</h5>
        <div class="h5 p-2 border rounded w-25 overflow-auto" readonly> <?php echo $linha["valorTotalEstoque"]; ?> </div>

        <a href="relEstoque.php" target="_blank"><img src="./img/impressao.png" width="42px"></a>
        <a href="mailto:danilucascoe@gmail.com?subject=Relatorio de Estoque"><img src="./img/gmail.png"  width="42px"></a>
        

      </div>



    <?php } ?>

    <!-- Tabela dos Materiais -->
    <div class="container overflow-auto border-0 rounded mb-3" style="padding: 0;">
      <table class="table table-light table-hover m-0">
        <thead>
          <tr>
            <th scope="col"><font size="3">Lote</font></th>
            <th scope="col"><font size="3">Marca</font></th>
            <th scope="col"><font size="3">Grupo</font></th>
            <th scope="col"><font size="3">Material</font></th>
            <th scope="col"><font size="3">Medida</font></th>
            <th scope="col"><font size="3">Qtd. Estoque</font></th>
            <th scope="col"><font size="3">Pco. Médio</font></th>
            <th scope="col"><font size="3">Vlr. Total</font></th>
            <th scope="col"><font size="3">Data Validade</font></th>
            <th scope="col"><font size="3">Dias a Vencer</font></th>
            <th scope="col"><font size="3">Inventário</font></th>
            <th scope="col"><font size="3">Saída do Material</font></th>
          </tr>
        </thead>
        <tbody>
          <?php
          //buscando o arquivo cons-clientesbd.php
          require_once("./app/cons-estoquebd.php");

          //comando foreach busca os dados da variavel resultado e armazena na variavel  "linha", 
          //jogando a infomação na tabela montada em html alimentado ocm dos dados da variavel linha.
          foreach ($resultado as $linha) {
          ?>
            <tr>
          <!--    <th scope="row"> <font size="2"><b><?php echo $linha["lote_prod"]; ?></b></font> </th> -->
            <!--  <td><font size="2"><b><?php echo $linha["marca_prod"]; ?></b></font></td> -->
            <!--  <td><font size="2"><b><?php echo $linha["grupo_prod"]; ?></b></font></td> -->
           <!--   <td><font size="2"><b><?= strlen($linha["nome_prod"]) > 50 ? substr($linha["nome_prod"], 0,50). "..." : $linha["nome_prod"]; ?></b></font></td> -->
            <!--  <td><font size="2"><b><?php echo $linha["medida_prod"]; ?></b></font></td> -->
             <!-- <td><font size="2"><b><?php echo $linha["qtd_estoque_prod"]; ?></b></font></td> -->
             <!-- <td><font size="2"><b><?php echo $linha["vl_preco_med_prod"]; ?></b></font></td> -->
              <!-- <td><font size="2"><b><?php echo $linha["vl_preco_total_prod"]; ?></b></font></td> -->
              <!-- <td><font size="2"><b><?php echo $linha["data_valid_prod"]; ?></b></font></td> -->

               <!-- lote_prod -->
                <?php
                   if ($linha["quantidade_dias_vencer"] < 90) {

              echo ("<td style='color:#FF0000'>");
              echo $linha['lote_prod'];
              echo ("</td>");

              } else {

              echo ("<td style='color:#000000'>");
              echo $linha['lote_prod'];
              echo ("</td>");
              ?>
               <?php

                  }
              ?>


              <!-- marca_prod -->

                <?php
                   if ($linha["quantidade_dias_vencer"] < 90) {

              echo ("<td style='color:#FF0000'>");
              echo $linha['marca_prod'];
              echo ("</td>");

              } else {

              echo ("<td style='color:#000000'>");
              echo $linha['marca_prod'];
              echo ("</td>");
              ?>
               <?php

                  }
              ?>



                <!-- grupo_prod -->
                  <?php
                   if ($linha["quantidade_dias_vencer"] < 90) {

              echo ("<td style='color:#FF0000'>");
              echo $linha['grupo_prod'];
              echo ("</td>");

              } else {

              echo ("<td style='color:#000000'>");
              echo $linha['grupo_prod'];
              echo ("</td>");
              ?>
               <?php

                  }
              ?>


             
             <!-- nome_prod -->
                 <?php
                   if ($linha["quantidade_dias_vencer"] < 90 ) {

              echo ("<td style='color:#FF0000'>");
                  ?>
              <?= strlen($linha["nome_prod"]) > 50 ? substr($linha["nome_prod"], 0,50). "..." : $linha["nome_prod"]; ?>
              <!--substr($linha["nome_prod"], 0,50). "...";
              //echo $linha['medida_prod']; -->
              <?php
              echo ("</td>");
              
              } else {

              echo ("<td style='color:#000000'>");
              ?>
              <?= strlen($linha["nome_prod"]) > 50 ? substr($linha["nome_prod"], 0,50). "..." : $linha["nome_prod"]; ?>
            <!--  echo $linha['nome_prod']; -->
             <?php
              echo ("</td>");
              ?>
               <?php

                  }
              ?>



              <!-- medida_prod -->
                <?php
                   if ($linha["quantidade_dias_vencer"] < 90) {

              echo ("<td style='color:#FF0000'>");
              echo $linha['medida_prod'];
              echo ("</td>");

              } else {

              echo ("<td style='color:#000000'>");
              echo $linha['medida_prod'];
              echo ("</td>");
              ?>
               <?php

                  }
              ?>


             
             <!-- Qtd estoque -->
              
               <?php
                   if ($linha["quantidade_dias_vencer"] < 90) {

              echo ("<td style='color:#FF0000'>");
              echo $linha['qtd_estoque_prod'];
              echo ("</td>");

              } else {

              echo ("<td style='color:#000000'>");
              echo $linha['qtd_estoque_prod'];
              echo ("</td>");
              ?>
               <?php

                  }
              ?>


             <!-- preço medio -->
              <?php
                   if ($linha["quantidade_dias_vencer"] < 90) {

              echo ("<td style='color:#FF0000'>");
              echo $linha['vl_preco_med_prod'];
              echo ("</td>");

              } else {

              echo ("<td style='color:#000000'>");
              echo $linha['vl_preco_med_prod'];
              echo ("</td>");
              ?>
               <?php

                  }
              ?>

               <!-- vl_preco_total_prod -->
              <?php
                   if ($linha["quantidade_dias_vencer"] < 90) {

              echo ("<td style='color:#FF0000'>");
              echo $linha['vl_preco_total_prod'];
              echo ("</td>");

              } else {

              echo ("<td style='color:#000000'>");
              echo $linha['vl_preco_total_prod'];
              echo ("</td>");
              ?>
               <?php

                  }
              ?>

             <!-- preço medio -->

             <!-- data de validade -->

              <?php
                   if ($linha["quantidade_dias_vencer"] < 90) {

              echo ("<td style='color:#FF0000'>");
              echo $linha['data_valid_prod'];
              echo ("</td>");

              } else {

              echo ("<td style='color:#000000'>");
              echo $linha['data_valid_prod'];
              echo ("</td>");
              ?>
               <?php

                  }
              ?>

             <!-- data de validade -->


             <!-- quantidade_dias_vencer -->

             <?php
                   if ($linha["quantidade_dias_vencer"] < 90) {

              echo ("<td style='color:#FF0000'>");
              echo $linha['quantidade_dias_vencer'];
              echo ("</td>");

              } else {

              echo ("<td style='color:#228B22'>");
              echo $linha['quantidade_dias_vencer'];
              echo ("</td>");
              ?>

             <!--       
               
             echo = <td><font size='2' color='black'><b><?php echo $linha['quantidade_dias_vencer']; ?></b></font></td>
              -->
              <?php

                  }
              ?>
     <!-- quantidade_dias_vencer -->

              <td>
                <a href="iventarioItem.php?id=<?php echo $linha["id_produto"];               ?> ">
                  <img src="./img/inventario.png" style="width: 45%;">
                </a>
              <td>
                <a href="saidaMaterial.php?id=<?php echo $linha["id_produto"]; ?> ">
                  <?php
                  if ($linha["qtd_estoque_prod"] > 0) { ?>
                    <img src="./img/saida_.png" style="width: 45%;">
                  <?php
                  } ?>
                </a>
              </td>
              </td>

            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>