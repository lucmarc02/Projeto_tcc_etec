<?php

/*Preparando conexao do banco   
  variaveis de conexão: Driver, usuario e senha*/

    $_dns = "mysql:host=localhost;dbname=sgv";
    $_usuario = "root";
    $_senha = "";

  
  /* try ==> tentar abrir uma conexao banco / catch ==> mensagem de erro da conexao do  banco */
    try

   {
     /* variavel conexão instanciando a classe PDO do php    */
      $conexao = new PDO ($_dns, $_usuario, $_senha);


    /*Montando a mensagem de erro do banco         */
    }

    catch(PDOException $erro)

    {

      echo "Erro: ". $erro->getCode(). " Mensagem do erro". $erro->getMessage();

    }


