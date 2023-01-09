<?php

//abri conexao com banco de dados
require_once("./conexao/conexao.php");

try {
    //Protege a conexao

    $comandoSQL = "
                      SELECT  
                            idLogin, 
                            nomeLogin,
                             usuarioLogin,
                             case 
                                 when nivelLogin = '1' then 'ADMINISTRADOR'
                                 ELSE 'USUARIO' END AS nivelLogin,

                            emailLogin, 
                            senhaLogin,
                            dataLogin,

                            case 
                               when statusLogin = '1' then 'ATIVO'
                               ELSE 'INATIVO' END AS statusLogin


                             FROM c_usuario";
    
    $select = $conexao->query($comandoSQL);
    
    //comando "fetchAll" limpa as tag do resultado do select e monta tabela
    $resultado = $select->fetchAll();
    

} catch (PDOException $erro) {
    
    echo "Erro na consulta. Mensagem do erro: ".$erro->getMenssage();
}