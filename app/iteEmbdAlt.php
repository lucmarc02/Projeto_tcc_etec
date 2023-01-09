<?php
  
  /* FILTER_SANITIZE_STRING COMANDO PARA PROTEGER DO SQL INJETION , TRANSFORMANDO EM TEXTO CADASTRO PESSOA ENTRADA NF*/ 

   $idAlmoxLogin     = filter_input(INPUT_POST, "idAlmoxLogin", FILTER_SANITIZE_STRING);  
   $seqItemEm      = filter_input(INPUT_POST, "seqItemEm", FILTER_SANITIZE_STRING);
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


     
 
       $calculoPrecoMedio = ("SELECT AVG(vl_unit_ite) as vl_unit_ite 
                                     FROM c_item_em 
                                     WHERE lote_prod_ite_nf like '%".$loteMaterial."%'") ;
       $select = $conexao->query($calculoPrecoMedio);
      //$resultado = $select->fetchAll();
      $resultado = $conexao->query($calculoPrecoMedio);
      $precoMed = $resultado->fetch(PDO::FETCH_ASSOC);     
        
       $comandoValidaMaterialSQL02 =("SELECT * FROM c_item_em where lote_prod_ite_nf like '%".$loteMaterial."%' ");
       $select = $conexao->query($comandoValidaMaterialSQL02);
       //$resultado = $select->fetchAll();
       $resultado = $conexao->query($comandoValidaMaterialSQL02);
       $linha = $resultado->fetch(PDO::FETCH_ASSOC);





       $comandoValidaMaterialSQL03 =("SELECT * FROM c_produto where lote_prod like '%".$loteMaterial."%' ");
       $select = $conexao->query($comandoValidaMaterialSQL03);
       //$resultado = $select->fetchAll();
       $resultado = $conexao->query($comandoValidaMaterialSQL03);
       $linhaEstoque = $resultado->fetch(PDO::FETCH_ASSOC);
       
       



       
       if (  $seqItemEm  > 0) {
       
    //echo $marcaMaterial. "- " .$loteMaterial. "- ".$dataFab;
    //exit(); 
          $comandoMatSQL = $conexao->prepare(
            "UPDATE c_item_em 
                      SET
                         marca_ite = '".$marcaMaterial."',
                         medida_ite = '".$medMaterial."',
                         grupo_ite = '".$gpMaterial."',
                         data_fab_prod_ite_nf = '".$dataFab."',
                         data_valid_prod_ite_nf = '".$dataValid."',
                         qtd_ite = '".$qtdMat."',
                         vl_unit_ite = '".$vlUnit."',
                         vl_total_ite = '".$vlTotalMaterial."'                      
                                    
                       
                       WHERE lote_prod_ite_nf  = '".$loteMaterial."';"

);
      
  }

   $comandoMatSQL->execute(array());



   $comandoMatSQLEstoque = $conexao->prepare(
            "UPDATE c_produto 
                      SET
                          marca_prod = '".$marcaMaterial."',
                          medida_prod = '".$medMaterial."',
                          grupo_prod = '".$gpMaterial."',
                          data_fab_prod = '".$dataFab."',
                          data_valid_prod = '".$dataValid."',
                          qtd_estoque_prod = '".($linhaEstoque['qtd_estoque_prod'] -(-$qtdMat))."',
                           vl_preco_med_prod = '".$linhaEstoque['vl_preco_med_prod']."',
                          vl_preco_total_prod = '".( $linhaEstoque['vl_preco_med_prod'] * ($linhaEstoque['qtd_estoque_prod'] ))."' 
                                              
                                    
                       
                       WHERE  lote_prod  = '".$loteMaterial."';"

);
 
  $comandoMatSQLEstoque->execute(array());
     header("location:../cons-nf.php?id=$seqEnt");
     // echo "Lote já cadastrado, estoque atualizado do material! ".$precoMed["vl_unit_ite"];
    
  
  
  
     
      } catch  (PDOException $erro) 
{
  echo $erro->getMessage();

}

$conexao = null; // comando para fechar a conexão aberta do banco.












  

