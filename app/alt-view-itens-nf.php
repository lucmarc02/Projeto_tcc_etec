<?php

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$nf = filter_input(INPUT_GET, "nf", FILTER_SANITIZE_NUMBER_INT);
$totalItem = filter_input(INPUT_GET, "nf", FILTER_SANITIZE_NUMBER_INT);

require_once("./conexao/conexao.php");


try {
    //sql de consulta da busca do id 

    $comandoSQL = "SELECT * FROM c_capa_em WHERE id_capaem=$id";
    $resultado = $conexao->query($comandoSQL);
    $linha = $resultado->fetch(PDO::FETCH_ASSOC);

   /* echo "<pre>";
    print_r($linha);
    echo "</pre>";

*/

$comandoSQLTotalitens = "SELECT SUM(vl_total_ite) as vl_total_ite FROM c_item_em  WHERE id_capaem= $id";
$resultadoTotalItem = $conexao->query($comandoSQLTotalitens);
$linhaTotalItem = $resultadoTotalItem->fetch(PDO::FETCH_ASSOC);
     }

    catch(PDOException $e)
 {
    echo $e->getMessage();
  }

$conexao = null;