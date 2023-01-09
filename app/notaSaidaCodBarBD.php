<?php
  
  /* FILTER_SANITIZE_STRING COMANDO PARA PROTEGER DO SQL INJETION , TRANSFORMANDO EM TEXTO CADASTRO PESSOA ENTRADA NF*/ 

    
   $dtSaida           = filter_input(INPUT_POST, "dtSaida", FILTER_SANITIZE_STRING);
   $hrSaida           = filter_input(INPUT_POST, "hrSaida", FILTER_SANITIZE_STRING);
   $codBar            = filter_input(INPUT_POST, "codBar", FILTER_SANITIZE_NUMBER_INT);
   $idAlmoxLogin      = filter_input(INPUT_POST, "idAlmoxLogin", FILTER_SANITIZE_NUMBER_INT);
   $nmRequisitante    = filter_input(INPUT_POST, "nmRequisitante", FILTER_SANITIZE_STRING);
   $idMat             = filter_input(INPUT_POST, "idMat", FILTER_SANITIZE_NUMBER_INT);
   $descMaterial      = filter_input(INPUT_POST, "descMaterial", FILTER_SANITIZE_STRING);
   $loteMaterial      = filter_input(INPUT_POST, "loteMaterial", FILTER_SANITIZE_STRING);
   $dataFab           = filter_input(INPUT_POST, "dataFab", FILTER_SANITIZE_STRING);
   $dataValid         = filter_input(INPUT_POST, "dataValid", FILTER_SANITIZE_STRING);
   $marcaMaterial     = filter_input(INPUT_POST, "marcaMaterial", FILTER_SANITIZE_STRING);
   $medMaterial       = filter_input(INPUT_POST, "medMaterial", FILTER_SANITIZE_STRING);
   $qtdEmEstoque      = filter_input(INPUT_POST, "qtdEmEstoque", FILTER_SANITIZE_STRING);
   $qtdSaida          = filter_input(INPUT_POST, "qtdSaida", FILTER_SANITIZE_STRING);
   $vlUnit            = filter_input(INPUT_POST, "vlUnit", FILTER_SANITIZE_STRING);
   $vlTotalMaterial   = filter_input(INPUT_POST, "vlTotalMaterial", FILTER_SANITIZE_STRING);
   



 require_once("../conexao/conexao.php"); // comando para abrir  a conexão com o  banco

//seleciona o id movimentacao


try { // O que deve ser feito.
      

$comandoSQLTotalitens = ("SELECT qtd_estoque_prod as qtd_estoque_prod, vl_preco_med_prod as vl_preco_med_prod  FROM c_produto  WHERE id_produto= $idMat");
$resultadoTotalItem = $conexao->query($comandoSQLTotalitens);
$linhaTotalItem = $resultadoTotalItem->fetch(PDO::FETCH_ASSOC);

 $estoqueAtual = ($linhaTotalItem['qtd_estoque_prod'] - $qtdSaida);
 //$vlEstoqueAtual = ($qtdSaida * $linhaTotalItem['vl_preco_med_prod']);

 

     if ($linhaTotalItem['qtd_estoque_prod'] < $qtdSaida )
      {

     
     
     echo("Saldo do material isuficiente para baixa! <a href= /tcc/notaSaidaCodBar.php?codBar='$codBar'> Voltar<br><br> </a> ");
    
      exit();
   

     } else {


      $comandoSQLItemInventario = $conexao->prepare("INSERT INTO c_saida_material
    
  (
    id_almox_saida_fk,data_saida,hora_saida,lote_mat_saida,
    id_mat_saida,desc_mat_saida, medida_mat_saida,qtd_saida_mat,preco_medio_saida,
    vl_total_item_saida,requisitante, codBarSaida
  
  )

     VALUES 
     (
     :idAlmoxLogin, :dtSaida, :hrSaida,  :loteMaterial, :idMat, 
     :descMaterial,  :medMaterial, :qtdSaida,:vlUnit,
     :vlTotalMaterial, :nmRequisitante, :codBar)"
     
     );


 $comandoSQLItemInventario->execute(array(

   ":idAlmoxLogin"      => $idAlmoxLogin,
   ":dtSaida"           => $dtSaida,
   ":hrSaida"           => $hrSaida,
   ":loteMaterial"      => $loteMaterial,
   ":idMat"             => $idMat,
   ":descMaterial"      => $descMaterial,
   ":medMaterial"       => $medMaterial,
   ":qtdSaida"          => $qtdSaida,
   ":vlUnit"            => $vlUnit,
   ":vlTotalMaterial"   => $vlTotalMaterial,
   ":nmRequisitante"    => $nmRequisitante,
   ":codBar"            => $codBar
   
   
  
  
     ));

//ATUALIZA O ESTOQUE


$comandoSQLAtualizaEstoque = $conexao->prepare(

       " UPDATE c_produto 
                SET
                 qtd_estoque_prod = $estoqueAtual,
                 vl_preco_total_prod = $estoqueAtual * $vlUnit
                 WHERE id_produto  = $idMat; "
       
       
          );

     $comandoSQLAtualizaEstoque->execute(array( )); 






        
             
        }
         
         

      

    
     
     

     // echo $linhaTotalItem['qtd_estoque_prod'] . " - " .$qtdSaida;
   //   echo $estoqueAtual .  $idMat;
    // exit();

   
     header("location:../notaSaidaCodBar.php"); 
   //  header("location:../iteEm.php?id=$seqEnt");
     // echo "Lote já cadastrado, estoque atualizado do material! ".$precoMed["vl_unit_ite"];
    
  
  
     
      } catch  (PDOException $erro) 
{
  echo $erro->getMessage();

}

$conexao = null; // comando para fechar a conexão aberta do banco.












  

