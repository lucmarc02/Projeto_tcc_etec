<?php
 session_start();   
   



   /* FILTER_SANITIZE_STRING COMANDO PARA PROTEGER DO SQL INJETION , TRANSFORMANDO EM TEXTO */ 

   $nome        = filter_input(INPUT_POST, "nomeLogin", FILTER_SANITIZE_STRING);
   $login       = filter_input(INPUT_POST, "usuarioLogin", FILTER_SANITIZE_STRING); 
   $nivel       = filter_input(INPUT_POST, "nivelLogin", FILTER_SANITIZE_STRING); 
   $email       = filter_input(INPUT_POST, "emailLogin", FILTER_SANITIZE_STRING); 
   $senha       = filter_input(INPUT_POST, "senhaLogin", FILTER_SANITIZE_STRING); 
   $data        = filter_input(INPUT_POST, "dataLogin", FILTER_SANITIZE_STRING);
   $status      = '0';
   $almoxLogin  =  filter_input(INPUT_POST, "almoxLogin", FILTER_SANITIZE_STRING); 
   


 require_once("../conexao/conexao.php"); // comando para abrir  a conexão com o  banco


try { // O que deve ser feito.

    $comandoSQL = $conexao->prepare("INSERT INTO c_usuario (nomeLogin, usuarioLogin, 
       nivelLogin, emailLogin, senhaLogin, dataLogin, statusLogin, idAlmoxLogin_FK)

        VALUES (:nome, :login, :nivel, :email, :senha, :data, :status, :almoxLogin)");


    $comandoSQL->execute(array(

      ":nome"     => $nome,
      ":login"    => $login,
      //TIPO DE CRIPTOGRAFIA DE SENHAS!!!

    //  ":senha"    => md5($senha),
   //    ":senha"    => sha1($senha),
     //  ":senha"    => hash('sha256',$senha),
    //   ":senha"    => hash('sha512',$senha),
    //  ":senha"    => hash('whirpool',$senha)
      ":nivel"         => $nivel,
      ":email"         => $email,
      ":senha"         => password_hash($senha, PASSWORD_DEFAULT),
      ":data"          => $data,
      ":status"        => $status,
      ":almoxLogin"    => $almoxLogin
     
     
    ));
    

//    if (md5($SenhaDigitadaAgora )== 202cb962ac59075b964b07152d234b70)

 //  if (password_verify($SenhaDigitadaAgora, PASSWORD_DEFAULT ))

       if($comandoSQL->rowCount() > 0)
       {
       
        //echo "usuario criado com sucesso! ". " <a href= '/tcc/index.php'> Voltar </a>";

         header("location:../index.php");
         $_SESSION['msg'] = "Usuario criado com sucesso!<br>Procure administrador do sistema para ativação do seu login";

       }
       else
       {
     
        echo"Erro na inserção dos dados!!!";

       }
    } 

// retorno de mensagem de erro
catch (PDOException $erro) 
{
  echo $erro->getMessage();
}

$conexao = null; // comando para fechar a conexão aberta do banco.








     /* IMPRIMIR EM OUTRA PAGINA, E PODE USAR TAG'S HTML PRA FORMATAR O TEXTO QUE SERÁ IMPRESSO*/

 /*   echo "<h1>" .$_GET["nome"]. "</h1>";
    echo"<br>";
    echo $_GET["endereco"]; */

    
    /*Teste  de visualzar os dados na outra pagina
    echo $email;*/

