<?php

//abri conexao com banco de dados
require_once("./conexao/conexao.php");

try {
    //Protege a conexao

    $comandoSQL = "SELECT 
                        id_produto,
                        lote_prod, 
                        marca_prod, 
                        grupo_prod, 
                        nome_prod, 
                        medida_prod, 
                        qtd_estoque_prod, 
                        vl_preco_med_prod, 
                        vl_preco_total_prod,
                        data_valid_prod,
                        case 
                        when DATEDIFF ( data_valid_prod, CURRENT_DATE ) <= 0 then 'Material Vencido' 
                        else COALESCE(DATEDIFF ( data_valid_prod, CURRENT_DATE ),0) END AS quantidade_dias_vencer 
                        FROM c_produto 

                        where DATEDIFF ( data_valid_prod, CURRENT_DATE ) > 0 and qtd_estoque_prod > 0  
                        order by COALESCE(DATEDIFF ( data_valid_prod, CURRENT_DATE ),0)  asc";
    
    

    $select = $conexao->query($comandoSQL);
   //comando "fetchAll" limpa as tag do resultado do select e monta tabela
    $resultado = $select->fetchAll();



    $comandoSQLItensEstoque = "SELECT COUNT(*) as intensEstoque, SUM(vl_preco_total_prod) as valorTotalEstoque FROM c_produto WHERE DATEDIFF ( data_valid_prod, CURRENT_DATE ) > 0 and qtd_estoque_prod > 0";
    $select = $conexao->query($comandoSQLItensEstoque);
   //comando "fetchAll" limpa as tag do resultado do select e monta tabela
    $resultadoItensEstoque = $select->fetchAll();

  

    

} catch (PDOException $erro) {
    
    echo "Erro na consulta. Mensagem do erro: ".$erro->getMenssage();
}