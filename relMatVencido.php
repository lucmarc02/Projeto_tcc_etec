<?php	



	include_once("conexao.php");
	$html = '<table border=1';	
	$html .= '<thead>';
	$html .= '<tr>';
	$html .= '<th>LOTE</th>';
	$html .= '<th>MARCA</th>';
	$html .= '<th>GRUPO</th>';
	$html .= '<th>MATERIAL</th>';
	$html .= '<th>MEDIDA</th>';
	$html .= '<th>QTD. ESTOQUE</th>';
	$html .= '<th>PREÇO MÉDIO</th>';
	$html .= '<th>VL. TOTAL ITEM</th>';
	
	$html .= '<th>DIAS PARA VENCIMENTO</th>';
	$html .= '</tr>';
	$html .= '</thead>';
	$html .= '<tbody>';
	
	$result_transacoes = "SELECT 
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
							    when DATEDIFF ( data_valid_prod, CURRENT_DATE ) <= 0 then 'Material Vencido' 
							    else DATEDIFF ( data_valid_prod, CURRENT_DATE ) END AS quantidade_dias_vencer 
							    FROM c_produto
							    where 
							     DATEDIFF( data_valid_prod, CURRENT_DATE ) <= 0 and
							     qtd_estoque_prod > 0";

	$resultado_trasacoes = mysqli_query($conn, $result_transacoes);
	while($row_transacoes = mysqli_fetch_assoc($resultado_trasacoes)){
		$html .= '<tr><td>'.$row_transacoes['lote_prod'] . "</td>";
		$html .= '<td>'.$row_transacoes['marca_prod'] . "</td>";
		$html .= '<td>'.$row_transacoes['grupo_prod'] . "</td>";
		$html .= '<td>'.$row_transacoes['nome_prod'] . "</td>";
		$html .= '<td>'.$row_transacoes['medida_prod'] . "</td>";
		$html .= '<td>'.$row_transacoes['qtd_estoque_prod'] . "</td>";
		$html .= '<td>'.$row_transacoes['vl_preco_med_prod'] . "</td>";
		$html .= '<td>'.$row_transacoes['vl_preco_total_prod'] . "</td>";
		
		$html .= '<td align="center">'.$row_transacoes['quantidade_dias_vencer'] . "</td> </tr>";	
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
			<h1 style="text-align: center;">SGM - Relação de Materiais Vencidos</h1>
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
