<?php
  
  /* FILTER_SANITIZE_STRING COMANDO PARA PROTEGER DO SQL INJETION , TRANSFORMANDO EM TEXTO CADASTRO PESSOA ENTRADA NF*/ 

   $idAlmoxLogin    = filter_input(INPUT_POST, "idAlmoxLogin", FILTER_SANITIZE_STRING);  
   $idMaterial      = filter_input(INPUT_POST, "idMaterial", FILTER_SANITIZE_STRING);
   $codBar          = filter_input(INPUT_POST, "codBar", FILTER_SANITIZE_STRING);
   $descMaterial    = filter_input(INPUT_POST, "descMaterial", FILTER_SANITIZE_STRING);
   $loteMaterial    = filter_input(INPUT_POST, "loteMaterial", FILTER_SANITIZE_STRING);
   $marcaMaterial   = filter_input(INPUT_POST, "marcaMaterial", FILTER_SANITIZE_STRING);
   $gpMaterial      = filter_input(INPUT_POST, "gpMaterial", FILTER_SANITIZE_STRING);
   $medMaterial     = filter_input(INPUT_POST, "medMaterial", FILTER_SANITIZE_STRING);
   $qtdMat          = filter_input(INPUT_POST, "qtdMat", FILTER_SANITIZE_STRING);
   $vlUnit          = filter_input(INPUT_POST, "vlUnit", FILTER_SANITIZE_STRING);
   $vlTotalMaterial = filter_input(INPUT_POST, "vlTotalMaterial", FILTER_SANITIZE_STRING);
   $seqEnt          = filter_input(INPUT_POST, "seqEnt", FILTER_SANITIZE_NUMBER_INT);
   $nf              = filter_input(INPUT_POST, "nf", FILTER_SANITIZE_NUMBER_INT);
   $dataFab         = filter_input(INPUT_POST, "dataFab", FILTER_SANITIZE_STRING);
   $dataValid       = filter_input(INPUT_POST, "dataValid", FILTER_SANITIZE_STRING);
   



 require_once("../conexao/conexao.php"); // comando para abrir  a conexão com o  banco

//seleciona o id movimentacao


try { // O que deve ser feito.

  $comandoSQLItemNota = $conexao->prepare("INSERT INTO c_item_em
    
  (
      nome_ite, marca_ite, grupo_ite, 
      medida_ite, qtd_ite, vl_unit_ite, 
      vl_total_ite, id_capaem, numero_notafisc_capaem, 
      lote_prod_ite_nf, data_fab_prod_ite_nf, data_valid_prod_ite_nf, id_almox_item_em_FK,
      codBarItemNf
  
  )

     VALUES 
     (
     :descMaterial,  :marcaMaterial, 
     :gpMaterial, :medMaterial, :qtdMat, :vlUnit,  
     :vlTotalMaterial, :seqEnt, :nf, :loteMaterial,
     :dataFab, :dataValid, :idAlmoxLogin, :codBar)"
     
     );


 $comandoSQLItemNota->execute(array(

   ":descMaterial"    => $descMaterial,
   ":marcaMaterial"   => $marcaMaterial,
   ":gpMaterial"      => $gpMaterial,
   ":medMaterial"     => $medMaterial,
   ":qtdMat"          => $qtdMat,
   ":vlUnit"          => $vlUnit,
   ":vlTotalMaterial" => $vlTotalMaterial,
   ":seqEnt"          => $seqEnt,
   ":nf"              => $nf,
   ":loteMaterial"    => $loteMaterial,
   ":dataFab"         => $dataFab ,
   ":dataValid"       => $dataValid,
   ":idAlmoxLogin"    => $idAlmoxLogin,
   ":codBar"          => $codBar 
  
  
     ));
     
            
        
       $comandoValidaMaterialSQL02 =("SELECT lote_prod FROM c_produto where lote_prod like '%".$loteMaterial."%' ");
       $select = $conexao->query($comandoValidaMaterialSQL02);
       //$resultado = $select->fetchAll();
       $resultado = $conexao->query($comandoValidaMaterialSQL02);
       $linha = $resultado->fetch(PDO::FETCH_ASSOC);
       


      if($linha == ''  )
      {
       

          $comandoMatSQL = $conexao->prepare(
            "INSERT INTO c_produto 
            
            (	
              nome_prod , grupo_prod, medida_prod,
             qtd_estoque_prod, vl_preco_med_prod, vl_preco_total_prod,
             marca_prod, lote_prod, data_fab_prod, data_valid_prod, id_almox_prod_FK, 
             codBarEst
             )
      
             VALUES 
             (
             :descMaterial,   
             :gpMaterial, :medMaterial, :qtdMat, :vlUnit,  
             :vlTotalMaterial, :marcaMaterial, :loteMaterial,
             :dataFab, :dataValid, :idAlmoxLogin,:codBar
             )" 
             
            );
      
      
        $comandoMatSQL->execute(array(
      
          ":descMaterial"    => $descMaterial,
          ":gpMaterial"      => $gpMaterial,
          ":medMaterial"     => $medMaterial,
          ":qtdMat"          => $qtdMat,
          ":vlUnit"          => $vlUnit,
          ":vlTotalMaterial" => $vlTotalMaterial,
          ":marcaMaterial"   => $marcaMaterial,
          ":loteMaterial"    => $loteMaterial,
          ":dataFab"         => $dataFab,
          ":dataValid"       => $dataValid,
          ":idAlmoxLogin"    => $idAlmoxLogin,
          ":codBar"          => $codBar
            
            
            
          ));  
          header("location:../iteEm.php?id=$seqEnt");

    } else {
    
      //$calculoPrecoMedio = ("SELECT AVG(vl_unit_ite) as vl_unit_ite FROM c_item_em WHERE lote_prod_ite_nf like '%".$loteMaterial."%'") ;

      $calculoPrecoMedio = ("SELECT round(COALESCE((COALESCE(sum(c.vl_total_ite),0) /  ( COALESCE(sum(c.qtd_ite),0)) ),0) , 4) as vl_unit_ite
                             FROM c_item_em c
                             WHERE c.lote_prod_ite_nf like '%".$loteMaterial."%'
                             GROUP BY
                             c.lote_prod_ite_nf") ;


      $select = $conexao->query($calculoPrecoMedio);
      //$resultado = $select->fetchAll();
      $resultado = $conexao->query($calculoPrecoMedio);
      $precoMed = $resultado->fetch(PDO::FETCH_ASSOC);

      $comandoSQLAtualizaEstoque = $conexao->prepare(

     



       "UPDATE c_produto 
                      SET
                       qtd_estoque_prod = (qtd_estoque_prod + :qtdMat),
                       vl_preco_med_prod = $precoMed[vl_unit_ite] ,
                       vl_preco_total_prod = ( $precoMed[vl_unit_ite] * (qtd_estoque_prod )  )                   
                       
                       WHERE lote_prod  like '%".$loteMaterial."%';"
       
       
       
       
         
       );

   $comandoSQLAtualizaEstoque->execute(array(
      
     ":qtdMat"          => $qtdMat 
    
    
       
     ));



     
    
    //echo $precoTotalItensNf['total_itens_nf'];
   // exit();

     //header("location:../iteEm.php?id=$seqEnt");
   header("location:../cons-nf.php");
   
     // echo "Lote já cadastrado, estoque atualizado do material! ".$precoMed["vl_unit_ite"];
    }
  
  
     
      } catch  (PDOException $erro) 
{
  echo $erro->getMessage();

}

$conexao = null; // comando para fechar a conexão aberta do banco.












  

