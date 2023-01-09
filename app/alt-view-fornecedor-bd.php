<?php

$idForn         = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
$cnpj           = filter_input(INPUT_POST, "cnpj", FILTER_SANITIZE_STRING);
$razaoSocial    = filter_input(INPUT_POST, "razaoSocial", FILTER_SANITIZE_STRING);
$cep            = filter_input(INPUT_POST, "cep", FILTER_SANITIZE_STRING);
$uf             = filter_input(INPUT_POST, "uf", FILTER_SANITIZE_STRING);
$cidade         = filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_STRING);
$endereco       = filter_input(INPUT_POST, "endereco", FILTER_SANITIZE_STRING);
$bairro         = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_STRING);
$telefone       = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_STRING);
$email          = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);


require_once("../conexao/conexao.php"); // comando para abrir  a conexão com o  banco

try {


  //sql de consulta da busca do id 

  $comandoSQL = "SELECT * FROM c_fornecedor WHERE cnpj_forn= '" . $cnpj . "'";



  $resultado = $conexao->query($comandoSQL);




  $linha = $resultado->fetch(PDO::FETCH_ASSOC);




  $comandoMatSQL = $conexao->prepare(
    "UPDATE c_fornecedor 
                      SET
                         rz_social_forn = '" . $razaoSocial . "',
                         cep_forn = '" . $cep . "',
                         uf_forn = '" . $uf . "',
                         cidade_forn = '" . $cidade . "',
                         endereco_forn = '" . $endereco . "',
                         bairro_forn = '" . $bairro . "',
                         telefone_forn = '" . $telefone . "',
                         email_forn = '" . $email . "'                      
                                    
                       
                       WHERE cnpj_forn  = '" . $cnpj . "';"

  );


  $comandoMatSQL->execute(array());
  header("location:../cons-fornecedor.php");
} catch (PDOException $e) {
  echo $e->getMessage();
}

$conexao = null;
