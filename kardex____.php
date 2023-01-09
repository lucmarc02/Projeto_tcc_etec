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




?>



<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MOVIMENTAÇÃO MATERIAL</title>

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
    <div class="text-center text-dark display-3"> MOVIMENTAÇÃO MATERIAL </div>
  </div>

  


  <div class="container p-2 bg-light border rounded mb-4">

    <form class="row align-items-center justify-content-center w-100" role="form" action="" method="GET">

      <div class="col-auto mt-2">
        <label for="codBar" class="col-form-label">Código de Barras:</label>
      </div>
      <div class="col-auto mt-2 w-50">
        <input type="text" class="form-control" id="codBar" name="codBar" maxlength="30">
      </div>
      <div class="col-auto w-auto mt-2">
        <button type="submit" class="btn btn-info btn-block">Consultar</button>
      </div>

    </form>

  </div>

  <div class="container bg-light border rounded mb-4 p-3">

    <form name="form" role="form" action="" method="POST">
             <table class="table table-striped table-sm">          
         

          <thead>
            <tr>
              <th colspan="7">
                <h4>CONSULTA MOVIMENTO MATERIAL</h4>
              </th>
            </tr>
            
          </thead>

          <thead>
            <tr>
              <th scope="col"> LOTE </th>   
              <th scope="col"> MATERIAL </th>   
              <th scope="col"> MEDIDA </th>   
              <th scope="col"> QTD. ENTRADA </th> 
              <th scope="col"> QTD. SAIDA </th> 
              <th scope="col"> PREÇO MEDIO </th> 
              <th scope="col"> VALOR TOTAL </th> 
              <th scope="col"> SALDO QTD. </th> 
              <th scope="col"> SALDO VL. </th>   
              <th scope="col"> DOC. </th>  
              <th scope="col"> MOVIMENTO </th> 
              <th scope="col"> DT. MOVIMENTO. </th>              
            </tr>
          </thead>

          <tbody>
            
            <?php 

          $codBar          = filter_input(INPUT_GET, "codBar", FILTER_SANITIZE_NUMBER_INT);
          


// comando para abrir  a conexão com o  banco

require_once("./conexao/conexao.php");



try { // O que deve ser feito.


  if ($codBar != "") {
    $comandoSQLBar = "SELECT * FROM c_kardex WHERE codBarKard = $codBar";
    $resultado = $conexao->query($comandoSQLBar);
    $linha = $resultado->fetch(PDO::FETCH_ASSOC);

            while ($linha = mysqli_fetch_assoc($comandoSQLBar)) {
              
              echo '<tr>';
              echo '<th scope="row">' . $linha['loteKard'] . '</th>';
              echo '<td>' . $linha['descMatKard'] . '</td>';
              echo '<td>' . $linha['medKard'] . '</td>';
              echo '<td>' . $linha['qtdEntKard'] . '</td>';
              echo '<td>' . $linha['qtdSaiKard'] . '</td>';
              echo '<td>' . $linha['vlPreUnitKard'] . '</td>';
              echo '<td>' . $linha['vlTotalMatKard'] . '</td>';
              echo '<td>' . $linha['saldoQtdKard'] . '</td>';
              echo '<td>' . $linha['saldoVlKard'] . '</td>';
              echo '<td>' . $linha['docKard'] . '</td>';
              echo '<td>' . $linha['tipoMovKard'] . '</td>';
              echo '<td>' . $linha['dtMovKard'] . '</td>';

             
              echo '</form>';
              echo '</td>';              
              echo '</tr>';
            }
            //COntinuar aqui
       }

              } catch  (PDOException $erro) 
{
  echo $erro->getMessage();

}

            ?>

          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
    
     
    </form>
  </div>

  <!--Parte js-->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


 

</body>

</html>