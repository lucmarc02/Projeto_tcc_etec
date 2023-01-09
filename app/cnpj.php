<?php
//Garantir que seja lido sem problemas
header("Content-Type: text/plain");

//Capturar CNPJ
$cnpj = $_REQUEST["cnpj"];

//Criando Comunicação cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.receitaws.com.br/v1/cnpj/".$cnpj);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //Descomente esta linha apenas se você não usar HTTPS, ou se estiver testando localmente
$retorno = curl_exec($ch);
curl_close($ch);

$retorno = json_decode($retorno); //Ajuda a ser lido mais rapidamente
echo json_encode($retorno, JSON_PRETTY_PRINT);

echo $retorno->nome;
echo "<br>";
echo "<br>";
echo $retorno->atividade_principal[0]->text;


?>




