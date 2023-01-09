<?php
    
   



   /* FILTER_SANITIZE_STRING COMANDO PARA PROTEGER DO SQL INJETION , TRANSFORMANDO EM TEXTO CADASTRO PESSOA ENTRADA NF*/ 

   $idAlmoxLogin       = filter_input(INPUT_POST, "idAlmoxLogin", FILTER_SANITIZE_STRING); 
   $cnpj              = filter_input(INPUT_POST, "cnpj", FILTER_SANITIZE_STRING);
   $cpf               = filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_STRING); 
   $nomePessoa        = filter_input(INPUT_POST, "nomePessoa", FILTER_SANITIZE_STRING); 
   $cepPessoa         = filter_input(INPUT_POST, "cepPessoa", FILTER_SANITIZE_STRING); 
   $ufpessoa          = filter_input(INPUT_POST, "ufpessoa", FILTER_SANITIZE_STRING); 
   $cidadePessoa      = filter_input(INPUT_POST, "cidadePessoa", FILTER_SANITIZE_STRING); 
   $enderecoPessoa    = filter_input(INPUT_POST, "enderecoPessoa", FILTER_SANITIZE_STRING); 
   $bairroPessoa      = filter_input(INPUT_POST, "bairroPessoa", FILTER_SANITIZE_STRING); 
   $telefonePessoa    = filter_input(INPUT_POST, "telefonePessoa", FILTER_SANITIZE_STRING); 
   $emailPessoa       = filter_input(INPUT_POST, "emailPessoa", FILTER_SANITIZE_EMAIL); 
   

/* FILTER_SANITIZE_STRING COMANDO PARA PROTEGER DO SQL INJETION , TRANSFORMANDO EM TEXTO CADASTRO ENTRADA NF*/ 

    $nf               = filter_input(INPUT_POST, "nf", FILTER_SANITIZE_STRING); 
    $dtEntrada        = filter_input(INPUT_POST, "dtEntrada", FILTER_SANITIZE_STRING); 
    $dtEmissao        = filter_input(INPUT_POST, "dtEmissao", FILTER_SANITIZE_STRING);
    $valorConferencia = filter_input(INPUT_POST, "valorConferencia", FILTER_SANITIZE_STRING );



    require_once("../conexao/conexao.php"); // comando para abrir  a conexão com o  banco


 $cnpj = str_replace (".", "",  $cnpj);
 $cnpj = str_replace ("/", "",  $cnpj);
 $cnpj = str_replace ("-", "",  $cnpj);




try { // O que deve ser feito.



    $comandoSQL = $conexao->prepare("INSERT INTO c_capa_em (cnpj_capaem, cpf_capaem, rz_social_capaem, cep_capaem, uf_capaem, cidade_capaem, endereco_capaem, bairro_capaem, telefone_capaem, email_capaem, numero_notafisc_capaem, dt_entrada, data_notafisc,  vl_conferencia, id_almox_capaem_FK )

        VALUES (:cnpj, :cpf, :nomePessoa, :cepPessoa, :ufpessoa, :cidadePessoa, :enderecoPessoa,  :bairroPessoa, :telefonePessoa, :emailPessoa, :nf, :dtEntrada, :dtEmissao, :valorConferencia, :idAlmoxLogin)");


    $comandoSQL->execute(array(

      ":cnpj"             => $cnpj,
      ":cpf"              => $cpf,
      ":nomePessoa"       => $nomePessoa,
      ":cepPessoa"        => $cepPessoa,
      ":ufpessoa"         => $ufpessoa,
      ":cidadePessoa"     => $cidadePessoa,
      ":enderecoPessoa"   => $enderecoPessoa,
      ":bairroPessoa"     => $bairroPessoa,
      ":telefonePessoa"   => $telefonePessoa,
      ":emailPessoa"      => $emailPessoa,
      ":nf"               => $nf,
      ":dtEntrada"        => $dtEntrada,
      ":dtEmissao"        => $dtEmissao,
      ":valorConferencia" => $valorConferencia,
      ":idAlmoxLogin"     => $idAlmoxLogin
  
     
    ));


    
       if($comandoSQL->rowCount() > 0)
       {
       
        
        echo "Os dados da Etrada da Nota inseridos com sucesso!". "<br><br>Deseja continuar para inserir os itens dessa NF? " ." <a href= '/tcc/cons-nf.php'> Se SIM, clique aqui!!! </a><br><br>".
         "Se NÃO, <a href= '/tcc/em.php'> clique para AQUI para inserir uma nova Nota Fiscal!!! <br><br> </a>";

       }
       else
       {
     
        echo"Erro na inserção dos dados Cadastro da Nota!!!";

       }
    


       // VALIDA DE O FORNCEDOR JA ESTÁ CADASTRADO.

       $comandoValidaFornecSQL = "SELECT coalesce(cnpj_forn,0) FROM c_fornecedor where cnpj_forn = $cnpj ";
    
       $select = $conexao->query($comandoValidaFornecSQL);
       
       //comando "fetchAll" limpa as tag do resultado do select e monta tabela
       $resultado = $select->fetchAll();
       $resultado = $conexao->query($comandoValidaFornecSQL);
       $linha = $resultado->fetch(PDO::FETCH_ASSOC);
   //echo $resultado;
   // exit();

     

      if($linha == '')
      {


  $comandoValidaFornecSQL = $conexao->prepare("INSERT INTO c_fornecedor (cnpj_forn, cpf_forn, rz_social_forn, cep_forn, uf_forn, cidade_forn, endereco_forn, bairro_forn, telefone_forn, email_forn)

  VALUES (:cnpj, :cpf, :nomePessoa, :cepPessoa, :ufpessoa, :cidadePessoa, :enderecoPessoa,  :bairroPessoa, :telefonePessoa, :emailPessoa)");
  
  
  $comandoValidaFornecSQL->execute(array(
  
  ":cnpj"             => $cnpj,
  ":cpf"              => $cpf,
  ":nomePessoa"       => $nomePessoa,
  ":cepPessoa"        => $cepPessoa,
  ":ufpessoa"         => $ufpessoa,
  ":cidadePessoa"     => $cidadePessoa,
  ":enderecoPessoa"   => $enderecoPessoa,
  ":bairroPessoa"     => $bairroPessoa,
  ":telefonePessoa"   => $telefonePessoa,
  ":emailPessoa"      => $emailPessoa 
  
        ));

  
      echo 'Fornecedor inserido com sucesso';
    

     /*   if($comandoSQL->rowCount() > 0)

        {
          

        } */
      }

         else  

          {
            echo 'Fornecedor já cadastrado!!';

/*
            $comandoFornecSQL = $conexao->prepare("INSERT INTO c_fornecedor (cnpj_forn, cpf_forn, rz_social_forn, cep_forn, uf_forn, cidade_forn, endereco_forn, bairro_forn, telefone_forn, email_forn)

            VALUES (:cnpj, :cpf, :nomePessoa, :cepPessoa, :ufpessoa, :cidadePessoa, :enderecoPessoa,  :bairroPessoa, :telefonePessoa, :emailPessoa)");
            
            
            $comandoFornecSQL->execute(array(
            
            ":cnpj"             => $cnpj,
            ":cpf"              => $cpf,
            ":nomePessoa"       => $nomePessoa,
            ":cepPessoa"        => $cepPessoa,
            ":ufpessoa"         => $ufpessoa,
            ":cidadePessoa"     => $cidadePessoa,
            ":enderecoPessoa"   => $enderecoPessoa,
            ":bairroPessoa"     => $bairroPessoa,
            ":telefonePessoa"   => $telefonePessoa,
            ":emailPessoa"      => $emailPessoa 
            
                  ));
                  */
          }

 
  
    } 




// retorno de mensagem de erro
catch (PDOException $erro) 
{
  echo $erro->getMessage();
}

$conexao = null; // comando para fechar a conexão aberta do banco.


