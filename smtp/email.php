<?php
/*
$to = "coelholucas00@hotmail.com";
$subject = "Teste simples de envio de email via PHP";
$body = "Olá, este é um email de teste enviado por PHP Script";
$headers = "From: sender\'s email";
 
if (mail($to, $subject, $body, $headers)) {
    echo "Email enviado com sucesso para $to_email.";
} else {
	echo($to);
    echo "Falha no envio do email.";
} */

$to      = 'coelholucas00@hotmail.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if
(mail($to, $subject, $message, $headers)) {
   echo "Email enviado com sucesso para $.".$to;
  
}  else {

    echo "Falha no envio do email.";
}

?>