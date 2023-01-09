<?php
       
        if(!isset($_SESSION))
        {

             session_start();
             
            
        }

       


$id       = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$nf        = filter_input(INPUT_GET, "nf", FILTER_SANITIZE_NUMBER_INT);
$totalItem = filter_input(INPUT_GET, "nf", FILTER_SANITIZE_NUMBER_INT);
$codBar    = filter_input(INPUT_GET, "codBar", FILTER_SANITIZE_NUMBER_INT);

require_once("./conexao/conexao.php");


try {
    //sql de consulta da busca do id 

    $comandoSQL = "SELECT * FROM c_capa_em WHERE id_capaem=$_SESSION['id']";
    $resultado = $conexao->query($comandoSQL);
    $linha = $resultado->fetch(PDO::FETCH_ASSOC);

     $_SESSION["nf"] = $linha["numero_notafisc_capaem"];
   //  $_SESSION["id"] = $linha["id_capaem"];

    $id =$_SESSION["id"];

   /* echo "<pre>";
    print_r($linha);
    echo "</pre>";

*/

$comandoSQLTotalitens = "SELECT SUM(vl_total_ite) as vl_total_ite FROM c_item_em  WHERE id_capaem= $_SESSION['id']";
$resultadoTotalItem = $conexao->query($comandoSQLTotalitens);
$linhaTotalItem = $resultadoTotalItem->fetch(PDO::FETCH_ASSOC);

 
      $comandoSQLJur = "SELECT * FROM c_produto WHERE codBarEst = $codBar";
      $resultado = $conexao->query($comandoSQLJur);
      $linhaBar = $resultado->fetch(PDO::FETCH_ASSOC);


     }

    catch(PDOException $e)
 {
    echo $e->getMessage();
  }

$conexao = null;