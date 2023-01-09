<?php


/* FILTER_SANITIZE_STRING COMANDO PARA PROTEGER DO SQL INJETION , TRANSFORMANDO EM TEXTO */
$id       = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
$nome     = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
$login    = filter_input(INPUT_POST, "login", FILTER_SANITIZE_STRING);
$senha    = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);
$nivel    = filter_input(INPUT_POST, "nivel", FILTER_SANITIZE_STRING);
$email    = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$status    = filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING);


require_once("../conexao/conexao.php"); // comando para abrir  a conexão com o  banco


try {
    $comandoSQLSelect = ("SELECT coalesce(senhaLogin, '') as senhaLogin FROM c_usuario WHERE idLogin='$id'");
    $resuldo = $conexao->query($comandoSQLSelect);
    $resuldo_senha = $resuldo->fetch(PDO::FETCH_ASSOC);

 //  echo $senha;
//   exit();

    if ($senha != '' ) {
        $comandoSQL = $conexao->prepare(

            "UPDATE c_usuario SET 
        nomeLogin =:nome, usuarioLogin=:login,
        senhaLogin=:senha, nivelLogin=:nivel, emailLogin=:email, statusLogin = :status
        WHERE idLogin=:id"

        );

        $comandoSQL->execute(array(
            ":id"         => $id,
            ":nome"       => $nome,
            ":login"      => $login,

            ":senha"      =>  password_hash($senha, PASSWORD_DEFAULT),
            ":nivel"      => $nivel,
            ":email"      => $email,
            ":status"      => $status


        ));

      header("location:../cons-usuario.php");

   

    } else {


        $comandoSQL2 = $conexao->prepare(

            "UPDATE c_usuario SET 
        nomeLogin =:nome, usuarioLogin=:login,
         nivelLogin=:nivel,  emailLogin=:email, statusLogin = :status
        WHERE idLogin=:id"

        );

        $comandoSQL2->execute(array(

            ":id"       => $id,
            ":nome"     => $nome,
            ":login"    => $login,
            ":nivel"      => $nivel,
            ":email"      => $email,
             ":status"      => $status

        ));

         header("location:../cons-usuario.php");
    };

 /*  
    if ($comandoSQL2->rowCount() > 0) {
        header("location:../cons-usuario.php");
    } else {
        echo "Erro na atualização do usuarioLogin.";
    } */
} catch (PDOException $e) {
    echo "Erro" . $e->getMessage();
}

$conexao = null;
