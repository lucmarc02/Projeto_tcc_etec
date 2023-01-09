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

  $comandoSQLItemInventario = $conexao->prepare("INSERT INTO c_inventario_item
    
  (
    hora_inv , data_inv , 	id_almox_inv_FK , lote_inv ,id_mat_inv ,
    desc_mat_inv , medida_inv , qtd_em_estoque_inv , qtd_novo_estoque_inv ,
    preco_medio_inv ,  preco_total_item  , motivo_inv  
  
  )

     VALUES 
     (
     :hrInventario,  :dtInventario, :idAlmoxLogin, :loteMaterial, :idMat, 
     :descMaterial,  :medMaterial, :qtdEmEstoque, :qtdNovoEstoque,:vlUnit,
     :vlTotalMaterial, :movAcerto)"
     
     );


 $comandoSQLItemInventario->execute(array(

   ":hrInventario"      => $hrInventario,
   ":dtInventario"      => $dtInventario,
   ":idAlmoxLogin"      => $idAlmoxLogin,
   ":loteMaterial"      => $loteMaterial,
   ":idMat"             => $idMat,
   ":descMaterial"      => $descMaterial,
   ":medMaterial"       => $medMaterial,
   ":qtdEmEstoque"      => $qtdEmEstoque,
   ":qtdNovoEstoque"    => $qtdNovoEstoque,
   ":vlUnit"            => $vlUnit,
   ":vlTotalMaterial"   => $vlTotalMaterial,
   ":movAcerto"         => $movAcerto 
   
  
  
     ));
     
            
        
      

      $comandoSQLAtualizaEstoque = $conexao->prepare(

     



       "UPDATE c_produto 
                      SET
                       qtd_estoque_prod = $qtdNovoEstoque,
                       vl_preco_med_prod = $vlUnit ,
                       vl_preco_total_prod = $vlTotalMaterial                  
                       
                       WHERE lote_prod  like '%".$loteMaterial."%';"
       
       
       
       
         
       );

   $comandoSQLAtualizaEstoque->execute(array(
      
    
    
    
    
    
       
     ));
     header("location:../cons-estoque.php"); 
   //  header("location:../iteEm.php?id=$seqEnt");
     // echo "Lote já cadastrado, estoque atualizado do material! ".$precoMed["vl_unit_ite"];
    
  
  
     
      } catch  (PDOException $erro) 
{
  echo $erro->getMessage();

}

$conexao = null; // comando para fechar a conexão aberta do banco.












  

