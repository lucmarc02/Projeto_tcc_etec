<?php 
	if(!empty($_POST['valor'])){
		header('Content-Type: application/json;charset=utf-8');

		$valor = $_POST['valor'];

		$valor = $valor . ' processado';

		$data['valor'] = $valor;
		$data['msg'] = 'CNPJ valido';

		echo json_encode($data);
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<title>Teste</title>

	<script type="text/javascript">
		$(function(){
			$('#valor').on('change', function(){
				console.log('Oi' + this.value)

				var _valor = this.value;

				$.ajax({
					method: "POST",
					url: "teste.php",
					data: { 
						valor: _valor
					}
				})
				.done(function( data ) {
					var msg = data.msg;
				});

			});
		});
	</script>
</head>
<body>
	<input type="text" id="valor" name="teste">
</body>
</html>