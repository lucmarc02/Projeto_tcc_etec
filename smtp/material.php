<?php




require_once("./conexao/conexao.php");

try {
    //Protege a conexao

    $comandoSQL = "SELECT 
					    id_produto,
					    lote_prod, 
					    marca_prod, 
					    grupo_prod, 
					    nome_prod, 
					    medida_prod, 
					    qtd_estoque_prod, 
					    vl_preco_med_prod, 
					    vl_preco_total_prod,
					    data_valid_prod,
					    case 
					    when DATEDIFF ( data_valid_prod, CURRENT_DATE ) between 30 and 90 then 'Material proximo do vencimento' 
					    else DATEDIFF ( data_valid_prod, CURRENT_DATE ) END AS tipo_mat ,
					     case 
					    when DATEDIFF ( data_valid_prod, CURRENT_DATE ) between 30 and 90 then DATEDIFF ( data_valid_prod, CURRENT_DATE )
					    else DATEDIFF ( data_valid_prod, CURRENT_DATE ) END AS quantidade_dias_vencer 
					    
					    FROM c_produto

					    where 
					     DATEDIFF( data_valid_prod, CURRENT_DATE ) > 30 and  DATEDIFF( data_valid_prod, CURRENT_DATE ) <= 90 and
					     qtd_estoque_prod > 0  ";
    
    

    $select = $conexao->query($comandoSQL);
   //comando "fetchAll" limpa as tag do resultado do select e monta tabela
   
    $resultado = $select->fetchAll();

 
 //configuração do email
    
  $nome = $_POST['nome'];
  $email= $_POST['email'];
  $mensagem= $_POST['mensagem'];
  $to = "contato@exemplo.com.br";
  $assunto = "Mensagem de ".$email.com
  mail($to,$assunto,$mensagem);
