<?php 
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST")
      {
      
          session_start();

          $login = filter_input(INPUT_POST, "login", FILTER_SANITIZE_STRING);
          $senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);



         //faz conexão com banco
          try{
               require_once("../conexao/conexao.php");


          //faz select no banco
               $comandoSQL = $conexao->prepare("SELECT * FROM c_usuario WHERE usuarioLogin = :login");
               $comandoSQL->bindParam(":login", $login);
               $comandoSQL->execute();

          //se encontra faz a verificação do login
                 if($comandoSQL->rowCount() > 0){
                     
                       $linha = $comandoSQL->fetch();
                       $hash = $linha["senhaLogin"];

                       if(password_verify($senha, $hash)){

                         //cria sessão para o usuario faz a valida~ção do usuário
                       	  $_SESSION["nome"] = $linha["usuarioLogin"];
                       	  $_SESSION["nivel"] = $linha["nivelLogin"]==1?"Administrador":"Usuario";
                          $_SESSION["almoxLogin"] = $linha["idAlmoxLogin_FK"]==1?"Almoxarifado Central":"Nehum Almoxarifado";
                          $_SESSION["idAlmoxLogin"] = $linha["idAlmoxLogin_FK"]==1?"1":"0";
                          $_SESSION["statusLogin"] = $linha["statusLogin"]==1?"ATIVO":"INATIVO";

                       	  header("location:../sgv.php");

                         if ( $_SESSION["statusLogin"] != 'ATIVO') {

                             header("location:../index.php");
                             $_SESSION['msg'] = "USUARIO INATIVO!";

                         }

                       } else
                          {

                          //	 session_start();
                          //	 session_unset();
                         //    session_destroy();

                             
                          	 header("location:../index.php");
                             $_SESSION['msg'] = "SENHA INCORRETA!";
                          }

                 } else {

                            //  session_start();
                          	//  session_unset();
                            //  session_destroy();

                           
                             header("location:../index.php");
                             $_SESSION['msg'] = "USUARIO NÃO ENCONTRADO!";

                 }

          }catch(PDOException $erro){

             echo $erro->getMessage();

          }

          $conexao = null; //fechando a minha coexão!!!

      }