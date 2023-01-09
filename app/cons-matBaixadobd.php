<?php

//abri conexao com banco de dados
require_once("./conexao/conexao.php");

try {
    //Protege a conexao

    $comandoSQL = "SELECT 
    hora_inu,
    data_inu, 
    marca_mat_inu, 
    lote_inu, 
    desc_mat_inu, 
    medida_inu, 
    qtd_estoque_inu, 
    preco_medio_item_inu, 
    preco_total_item_inu,
    data_val_inu,
    case 
    when DATEDIFF ( data_val_inu, CURRENT_DATE ) <= 0 then 'MATERIAL BAIXADO' 
    else DATEDIFF ( data_val_inu, CURRENT_DATE ) END AS quantidade_dias_vencer 
    FROM c_inutilizacao ";
    
    

    $select = $conexao->query($comandoSQL);
   //comando "fetchAll" limpa as tag do resultado do select e monta tabela
    $resultado = $select->fetchAll();



    $comandoSQLItensEstoque = "SELECT COUNT(*) as intensEstoque, SUM(preco_total_item_inu) as valorTotalEstoque 
    FROM c_inutilizacao";
    $select = $conexao->query($comandoSQLItensEstoque);
   //comando "fetchAll" limpa as tag do resultado do select e monta tabela
    $resultadoItensEstoque = $select->fetchAll();

  

    

} catch (PDOException $erro) {
    
    echo "Erro na consulta. Mensagem do erro: ".$erro->getMenssage();
}