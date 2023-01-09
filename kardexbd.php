<?php




/* FILTER_SANITIZE_STRING COMANDO PARA PROTEGER DO SQL INJETION , TRANSFORMANDO EM TEXTO CADASTRO PESSOA ENTRADA NF*/



$codBar          = filter_input(INPUT_POST, "codBar", FILTER_SANITIZE_NUMBER_INT);


// comando para abrir  a conexão com o  banco

require_once("./conexao/conexao.php");


try { // O que deve ser feito.



  if ($codBar != "") {

   
    $comandoSQLJur = "SELECT * FROM c_kardex WHERE codBarKard = $codBar order by idKardex asc";
    $resultado = $conexao->query($comandoSQLJur);
   // $linhaBar = $resultado->fetch(PDO::FETCH_ASSOC);
    $linhaBar = $resultado->fetchAll();
    $total = $resultado->rowCount();

    echo $total;
   }
}

// retorno de mensagem de erro
catch (PDOException $erro) {
  echo $erro->getMessage();
}

$conexao = null; // comando para fechar a conexão aberta do banco.
