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

$_SESSION["codBar"] =  filter_input(INPUT_GET, "codBar", FILTER_SANITIZE_NUMBER_INT);

error_reporting(0);
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
  <div class="container p-4 mt-4 mb-4 bg-light border rounded">
    <div class="text-center text-dark display-4"> MOVIMENTAÇÃO MATERIAL </div>

  </div>

  


  <div class="container p-2 bg-light border rounded mb-4">

    <form class="row align-items-center justify-content-center w-100" role="form" action="kardex.php" method="POST">

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
      if (!empty($_POST['codBar'])){  ?>

    <div class="py-2 mt-2 bg-primary">
    <p class="text-center display-4 text-capitalize m-0 text-white">COD. BARRAS: <?= $_POST['codBar'] ?></p>
        

  </div>

  <?php      }     ?>

    

  </div>

 

  <!-- <div class="container bg-light border rounded mb-4 p-3"> -->
     <div class="container bg-light overflow-auto border-0 rounded mb-3 px-3">
        
        <table class="table table-striped table-sm"> 
          <thead>
            <tr>
              <th class="py-3" colspan="7">
                <h5><b>CONSULTA MOVIMENTO MATERIAL</b></h5> 

                <font size="3" color="#FF0000">
                  <b>
                   

                <?php
                
                  echo 'Qtd. movimentações: '; require_once ("./kardexbd.php"); 

                 ?>
               </b>
             </font>
           

              </th>
            </tr>
            
          </thead>

          <thead>
            <tr>
              <th scope="col"><font size="3"><b> LOTE </b></font></th>   
              <th scope="col"><font size="3"><b> MATERIAL</b></font> </th>   
              <th scope="col"><font size="3"><b> MEDIDA</b></font> </th>   
              <th scope="col"><font size="3"><b> QTD. ENTRADA</b></font> </th> 
              <th scope="col"><font size="3"><b> QTD. SAIDA</b> </font></th> 
              <th scope="col"><font size="3"><b> PREÇO MEDIO</b></font> </th> 
              <th scope="col"><font size="3"><b> VALOR TOTAL</b></font> </th> 
              <th scope="col"><font size="3"><b> SALDO QTD.</b></font> </th> 
              <th scope="col"><font size="3"><b> SALDO VL.</b></font> </th>   
              <th scope="col"><font size="3"><b> DOC.</b></font> </th>  
              <th scope="col"><font size="3"><b> MOVIMENTO</b></font> </th> 
              <th scope="col"><font size="3"><b> DT. MOVIMENTO.</b></font> </th>              
            </tr>
          </thead>

          <tbody>

            <?php
            
              foreach($linhaBar as $linha)
              {

            ?>
            <tr>
              <td><font size="2"><b><?= $linha["loteKard"]; ?></b></font></td>
              <td><font size="2"><b><?= $linha["descMatKard"]; ?></b></font></td>
              <td><font size="2"><b><?= $linha["medKard"]; ?></b></font></td>
              <td><font size="2"><b><?= $linha["qtdEntKard"]; ?></b></font></td>
              <td><font size="2"><b><?= $linha["qtdSaiKard"]; ?></b></font></td>
              <td><font size="2"><b><?= $linha["vlPreMedKard"]; ?></b></font></td>
              <td><font size="2"><b><?= $linha["vlTotalMatKard"]; ?></b></font></td>
              <td><font size="2"><b><?= $linha["saldoQtdKard"]; ?></b></font></td>
              <td><font size="2"><b><?= $linha["saldoVlKard"]; ?></b></font></td>
              <td><font size="2"><b><?= $linha["docKard"]; ?></b></font></td>
              <td><font size="2"><b><?= $linha["tipoMovKard"]; ?></b></font></td>
              <td><font size="2"><b><?= $linha["dtMovKard"]; ?></b></font></td>              
            </tr>  
            <?php
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