<?php

$idMat      = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);


require_once("./conexao/conexao.php");


try {
    //sql de consulta da busca do id 

    $comandoSQL = "SELECT * FROM c_produto WHERE id_produto=$idMat";
   // echo $comandoSQL;
    $resultado = $conexao->query($comandoSQL);
    $linha = $resultado->fetch(PDO::FETCH_ASSOC);

 /*   echo "<pre>";
    print_r($linha);
    echo "</pre>";

 


$comandoSQLTotalitens = "SELECT SUM(qtd_estoque_inu) as qtdEstoque FROM c_inutilizacao  WHERE id_produto= $idMat";
$resultadoTotalItem = $conexao->query($comandoSQLTotalitens);
$linhaTotalItem = $resultadoTotalItem->fetch(PDO::FETCH_ASSOC);

*/

    }

    catch(PDOException $e)
 {
    echo $e->getMessage();
  }

$conexao = null;
