<?php	



	include_once("conexao.php");
	$html = '<table border=1';	
	$html .= '<thead>';
	$html .= '<tr>';
	$html .= '<th>CNPJ</th>';

	$html .= '<th>RAZÃO SOCIAL</th>';
	
	$html .= '<th>CEP</th>';
	$html .= '<th>UF</th>';
	$html .= '<th>CIDADE</th>';
	$html .= '<th>ENDEREÇO</th>';
	$html .= '<th>BAIRRO</th>';
	$html .= '<th>TELEFONE</th>';
	
	$html .= '</tr>';
	$html .= '</thead>';
	$html .= '<tbody>';
	
	$result_transacoes = "SELECT * FROM c_fornecedor";

	$resultado_trasacoes = mysqli_query($conn, $result_transacoes);
	while($row_transacoes = mysqli_fetch_assoc($resultado_trasacoes)){
		

		$html .= '<tr><td>'.$row_transacoes['cnpj_forn'] . "</td>";

		$html .= '<td>'.$row_transacoes['rz_social_forn'] . "</td>";
		
		$html .= '<td>'.$row_transacoes['cep_forn'] . "</td>";
		$html .= '<td>'.$row_transacoes['uf_forn'] . "</td>";
		$html .= '<td>'.$row_transacoes['cidade_forn'] . "</td>";
		$html .= '<td>'.$row_transacoes['endereco_forn'] . "</td>";
		$html .= '<td>'.$row_transacoes['bairro_forn'] . "</td>";
		
		$html .= '<td align="center">'.$row_transacoes['telefone_forn'] . "</td> </tr>";
			
	}
	
	$html .= '</tbody>';
	$html .= '</table';



	  
  

       
       
    
        
    


	//echo "Iniciando pdf ";
	//exit();
	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("dompdf/autoload.inc.php");

  
  

   

  // echo "Chamou arquivo autload pdf ";
   //exit();
	//Criando a Instancia
	$dompdf = new DOMPDF();
	
	// Carrega seu HTML
	$data = strftime("%d/%m/%Y");

	$dompdf->load_html('
			<h1 style="text-align: center;">SGM - Relação de fornecedores</h1>
		    <p> Data de emissão do relatório: '.$data.'

			'. $html .'
		');



  
	

   // echo "Criou instancia e cabeçalho do relatório ";
    //exit();
	//Renderizar o html
	$dompdf->render();


	//Exibibir a página

	$dompdf->stream(
		
		"relatorio_material_vencido.pdf", 
		array(
			"Attachment" => false //Para realizar o download somente alterar para true
		)
	);
