<?php

//abri conexao com banco de dados
require_once("./conexao/conexao.php");

try {
    //Protege a conexao

    $comandoSQL = "SELECT  
				      itNF.id_capaem as id_capaem,
				      itNF.id_item_em as id_item_em,
				      itNF.numero_notafisc_capaem as numero_notafisc_capaem,
				      itNF.id_almox_item_em_FK as id_almox_item_em_FK,
				      itNF.nome_ite as nome_ite,
				      itNF.lote_prod_ite_nf as lote_prod_ite_nf,
				      itNF.data_fab_prod_ite_nf as data_fab_prod_ite_nf,
				      itNF.data_valid_prod_ite_nf as data_valid_prod_ite_nf,
				      itNF.marca_ite as marca_ite,
				      itNF.grupo_ite as grupo_ite,
				      itNF.medida_ite as medida_ite,
				      itNF.qtd_ite as qtd_ite,
				      itNF.vl_unit_ite as vl_unit_ite,
				      itNF.vl_total_ite as vl_total_ite,
				      SUM(itNF.vl_total_ite ) AS total_itens_nf
				      
				      FROM c_item_em itNF
				     LEFT JOIN( SELECT sum(itNF.vl_total_ite) as total_itens_nota,  Nf.id_capaem as id_capa, NF.vl_conferencia
				                                                   FROM c_capa_em NF 
				                                                   inner join c_item_em as itNF on itNF.id_capaem = NF.id_capaem
									                               GROUP BY
									                               NF.id_capaem 
				                ) i on i.id_capa = itNF.id_capaem
				                
				                where total_itens_nota > I.vl_conferencia 

				      
				      group BY
				             itNF.id_capaem
				      ORDER BY
				             itNF.id_capaem

      
           
             
            ";
    
    

    $select = $conexao->query($comandoSQL);
    
    //comando "fetchAll" limpa as tag do resultado do select e monta tabela
    $resultado = $select->fetchAll();


   
    

} catch (PDOException $erro) {
    
    echo "Erro na consulta. Mensagem do erro: ".$erro->getMenssage();
}