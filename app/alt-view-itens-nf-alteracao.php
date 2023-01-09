<?php

$seqItemEm = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);


require_once("./conexao/conexao.php");


try {
    //sql de consulta da busca do id 

   
    $comandoSQL = "SELECT *
                       FROM c_item_em 
                       WHERE id_item_em = $seqItemEm";
    $resultado = $conexao->query($comandoSQL);
    $linha = $resultado->fetch(PDO::FETCH_ASSOC);
/*
   echo "<pre>";
    print_r($linha);
    echo "</pre>";

  exit();


*/




     }

    catch(PDOException $e)
 {
    echo $e->getMessage();
  }

$conexao = null;