<?php
  
  /* FILTER_SANITIZE_STRING COMANDO PARA PROTEGER DO SQL INJETION , TRANSFORMANDO EM TEXTO CADASTRO PESSOA ENTRADA NF*/ 

   $hrInventario      = filter_input(INPUT_POST, "hrInventario", FILTER_SANITIZE_STRING);  
   $dtInventario      = filter_input(INPUT_POST, "dtInventario", FILTER_SANITIZE_STRING);
   $movAcerto         = filter_input(INPUT_POST, "movAcerto", FILTER_SANITIZE_STRING);
   $idAlmoxLogin      = filter_input(INPUT_POST, "idAlmoxLogin", FILTER_SANITIZE_NUMBER_INT);
   $idMat             = filter_input(INPUT_POST, "idMat", FILTER_SANITIZE_NUMBER_INT);
   $descMaterial      = filter_input(INPUT_POST, "descMaterial", FILTER_SANITIZE_STRING);
   $loteMaterial      = filter_input(INPUT_POST, "loteMaterial", FILTER_SANITIZE_STRING);
   $dataFab           = filter_input(INPUT_POST, "dataFab", FILTER_SANITIZE_STRING);
   $dataValid         = filter_input(INPUT_POST, "dataValid", FILTER_SANITIZE_STRING);
   $marcaMaterial     = filter_input(INPUT_POST, "marcaMaterial", FILTER_SANITIZE_STRING);
   $medMaterial       = filter_input(INPUT_POST, "medMaterial", FILTER_SANITIZE_STRING);
   $qtdEmEstoque      = filter_input(INPUT_POST, "qtdEmEstoque", FILTER_SANITIZE_STRING);
   $qtdNovoEstoque    = filter_input(INPUT_POST, "qtdNovoEstoque", FILTER_SANITIZE_STRING);
   $vlUnit            = filter_input(INPUT_POST, "vlUnit", FILTER_SANITIZE_STRING);
   $vlTotalMaterial   = filter_input(INPUT_POST, "vlTotalMaterial", FILTER_SANITIZE_STRING);
   



 require_once("../conexao/conexao.php"); // comando para abrir  a conexão com o  banco

//seleciona o id movimentacao


try { // O que deve ser feito.

  $comandoSQLBaixaMat = $conexao->prepare("INSERT INTO c_inutilizacao
    
  (
    hora_inu  , data_inu  , id_almox_inu_fk , motivo_inu , lote_inu,
    id_mat_inu, desc_mat_inu , medida_inu , qtd_estoque_inu ,
    preco_medio_item_inu ,  preco_total_item_inu  , marca_mat_inu,
    data_fab_inu, 	data_val_inu  
  
  )

     VALUES 
     (
     :hrInventario,  :dtInventario, :idAlmoxLogin, :movAcerto, :loteMaterial, :idMat, 
     :descMaterial,  :medMaterial, :qtdEmEstoque, :vlUnit, :vlTotalMaterial, 
     :marcaMaterial,  :dataFab, :dataValid)"
     
     );


 $comandoSQLBaixaMat->execute(array(

   ":hrInventario"      => $hrInventario,
   ":dtInventario"      => $dtInventario,
   ":idAlmoxLogin"      => $idAlmoxLogin,
   ":movAcerto"         => $movAcerto,
   ":loteMaterial"      => $loteMaterial,
   ":idMat"             => $idMat,
   ":descMaterial"      => $descMaterial,
   ":medMaterial"       => $medMaterial,
   ":qtdEmEstoque"      => $qtdEmEstoque,
   
   ":vlUnit"            => $vlUnit,
   ":vlTotalMaterial"   => $vlTotalMaterial,
   ":marcaMaterial"     => $marcaMaterial ,
   ":dataFab"           => $dataFab,
   ":dataValid"         => $dataValid
   
  
  
     ));
     
            

     
     if($comandoSQLBaixaMat->rowCount() > 0)
     {
     
      
      echo "Lote do material baixado com sucesso";

     }
     else
     {
   
      echo"Erro na baixa do lote do material";

     }
        
      
     
      $comandoSQLAtualizaEstoque = $conexao->prepare(

     



       "UPDATE c_produto 
                      SET
                       qtd_estoque_prod = 0,
                       vl_preco_med_prod = 0 ,
                       vl_preco_total_prod = 0                  
                       
                       WHERE  id_produto  = $idMat ;"
       
       
       
       
         
       );

   $comandoSQLAtualizaEstoque->execute(array(  ));
     header("location:../cons-matBaixado.php"); 
   //  header("location:../iteEm.php?id=$seqEnt");
     // echo "Lote já cadastrado, estoque atualizado do material! ".$precoMed["vl_unit_ite"];
    
  
  
     
      } catch  (PDOException $erro) 
{
  echo $erro->getMessage();

}

$conexao = null; // comando para fechar a conexão aberta do banco.












  

