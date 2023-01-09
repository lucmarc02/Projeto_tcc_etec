<?php

    


//abri conexao com banco de dados
require_once("./conexao/conexao.php");

try {
    //Protege a conexao

    $comandoSQL = " SELECT  
                            *


                             FROM c_fornecedor ";
    
    

    $select = $conexao->query($comandoSQL);
   //comando "fetchAll" limpa as tag do resultado do select e monta tabela
    $resultado = $select->fetchAll();



    $comandoSQLFornec = "SELECT COUNT(*)  as total_cadastro FROM c_fornecedor";
    $select = $conexao->query($comandoSQLFornec);
   //comando "fetchAll" limpa as tag do resultado do select e monta tabela
    $resultadoFornecedor = $select->fetchAll();


} catch (PDOException $erro) {
    
    echo "Erro na consulta. Mensagem do erro: ".$erro->getMenssage();
}