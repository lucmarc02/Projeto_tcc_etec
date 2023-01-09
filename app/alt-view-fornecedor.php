<?php

   $idForn         = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
   


require_once("./conexao/conexao.php");


try {
    //sql de consulta da busca do id 

    $comandoSQL = "SELECT * FROM c_fornecedor WHERE id_forn=$idForn";
   // echo $comandoSQL;
    $resultado = $conexao->query($comandoSQL);
    $linha = $resultado->fetch(PDO::FETCH_ASSOC);

 


  
    }

    catch(PDOException $e)
 {
    echo $e->getMessage();
  }

$conexao = null;
