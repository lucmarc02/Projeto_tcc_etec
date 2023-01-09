<?php

//abri conexao com banco de dados
require_once("./conexao/conexao.php");

try {
    //Protege a conexao

    $comandoSQL = "SELECT 
				     capaNf.id_capaem as id_capaem, 
				     capaNf.numero_notafisc_capaem as numero_notafisc_capaem, 
				     capaNf.cnpj_capaem as cnpj_capaem, 
				     capaNf.rz_social_capaem as rz_social_capaem,
				     capaNf.dt_entrada as dt_entrada , 
				     capaNf.vl_conferencia as vl_conferencia ,
				     coalesce(total_itens_nota,0) as total_itens_nota,
				     coalesce((capaNf.vl_conferencia - total_itens_nota),0) as diferenca
				     
				     FROM c_capa_em capaNf
				     left join ( SELECT sum(itNF.vl_total_ite) as total_itens_nota,  Nf.id_capaem as id_capa
				                                                   FROM c_capa_em NF 
				                                                   inner join c_item_em as itNF on itNF.id_capaem = NF.id_capaem
									                               GROUP BY
									                               NF.id_capaem 
				                ) i on i.id_capa = capaNf.id_capaem
				                
				                where total_itens_nota < capaNf.vl_conferencia or total_itens_nota > capaNf.vl_conferencia or total_itens_nota is null
				         
				     GROUP BY
				             capaNf.id_capaem
      
           
             
            ";
    
    

    $select = $conexao->query($comandoSQL);
    
    //comando "fetchAll" limpa as tag do resultado do select e monta tabela
    $resultado = $select->fetchAll();


   
    

} catch (PDOException $erro) {
    
    echo "Erro na consulta. Mensagem do erro: ".$erro->getMenssage();
}