<?php
session_start();
if ((!isset($_SESSION["nome"]) == TRUE) and (!isset($_SESSION["nivel"]) == TRUE)) {
  session_unset();
  session_destroy();

  header("location:index.php");
}



?>


<?php
error_reporting(0);





/* FILTER_SANITIZE_STRING COMANDO PARA PROTEGER DO SQL INJETION , TRANSFORMANDO EM TEXTO CADASTRO PESSOA ENTRADA NF*/

$cnpjCons          = filter_input(INPUT_GET, "cnpjCons", FILTER_SANITIZE_NUMBER_INT);
$cpfCons           = filter_input(INPUT_GET, "cpfCons", FILTER_SANITIZE_NUMBER_INT);








// comando para abrir  a conexão com o  banco

require_once("./conexao/conexao.php");



try { // O que deve ser feito.

  


  


  if ($cnpjCons != "") {
    $comandoSQLJur = "SELECT * FROM c_fornecedor WHERE cnpj_forn = $cnpjCons";
    $resultado = $conexao->query($comandoSQLJur);
    $linha = $resultado->fetch(PDO::FETCH_ASSOC);

    if ((strlen($cnpjCons) !== 14) or ($cnpjCons == "00000000000000" || 
        $cnpjCons == "11111111111111" || 
        $cnpjCons == "22222222222222" || 
        $cnpjCons == "33333333333333" || 
        $cnpjCons == "44444444444444" || 
        $cnpjCons == "55555555555555" || 
        $cnpjCons == "66666666666666" || 
        $cnpjCons == "77777777777777" || 
        $cnpjCons == "88888888888888" || 
        $cnpjCons == "99999999999999")){
     
      $_SESSION['msg'] = "CNPJ INVALIDO!";
     //header("location:./em.php");
     $_SESSION['msg'] = "CNPJ INVALIDO!";
     
       

       }


     
        


    if ($resultado->rowCount() > 0) {
      $cnpj     = $cnpjCons;
      $nome     = isset($linha['rz_social_forn']) ? $linha['rz_social_forn'] : "";
      $cep      = isset($linha['cep_forn']) ? $linha['cep_forn'] : "";
      $uf       = isset($linha['uf_forn']) ? $linha['uf_forn'] : "";
      $cidade   = isset($linha['cidade_forn']) ? $linha['cidade_forn'] : "";
      $endereco = isset($linha['endereco_forn']) ? $linha['endereco_forn'] : "";
      $bairro   = isset($linha['bairro_forn']) ? $linha['bairro_forn'] : "";
      $telefone = isset($linha['telefone_forn']) ? $linha['telefone_forn'] : "";
      $email    = isset($linha['email_forn']) ? $linha['email_forn'] : "";

    

    }  else  {

   

      //Garantir que seja lido sem problemas
      //header("Content-Type: text/plain");

      //Criando Comunicação cURL
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "https://www.receitaws.com.br/v1/cnpj/" . $cnpjCons);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //Descomente esta linha apenas se você não usar HTTPS, ou se estiver testando localmente
      $retorno = curl_exec($ch);
      curl_close($ch);

      $retorno = json_decode($retorno); //Ajuda a ser lido mais rapidamente
      //echo json_encode($retorno, JSON_PRETTY_PRINT);


      $cnpj   = $cnpjCons;

      $nome   = $retorno->nome;
        
          
       
      $cep    = $retorno->cep;
      $uf     = $retorno->uf;
      $cidade = $retorno->municipio;
      $endereco = $retorno->logradouro . ', ' . $retorno->numero;
      $bairro   = $retorno->bairro;
      $telefone = $retorno->telefone;


      $email = $retorno->email;
    }


   

   

  }


  

}





// retorno de mensagem de erro
catch (PDOException $erro) {
  echo $erro->getMessage();
}

$conexao = null; // comando para fechar a conexão aberta do banco.




?>


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Entrada de Mercadorias</title>

  <!-- Booststrap / AOS animation -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./css-js/styleCss.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <!-- Fonte do Google -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

  <script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
  <script type="text/javascript" src="js/jquery.maskedinput.min.js">  </script>
  <script type="text/javascript" src="js/removeCaracteres.js" defer> </script>

 
 
 
</head>



<body>

  <!--Titulo/top-->
  <?php
  require_once("menu.php");
  ?>



  <div class="container bg-light text-center p-3 mt-4 mb-3 border rounded">
    <div class="display-4"> Entrada de Mercadorias</div>
  </div>

  <!--Forms do site-->

          <div class="bg-light p-3 container rounded">
            <form role="form" action="" method="GET">

              <div class="form-group">
                <label class="text-uppercase" for="cnpjCons"><strong>CNPJ:</strong></label>
                <input class="form-control" id="cnpjCons" type="text" size="18" maxlength="18" name="cnpjCons"/>
              </div>


              <p class="text-danger">
                              <?php 
                                 if(isset($_SESSION['msg'])) {
                                  echo $_SESSION['msg'];
                                  unset( $_SESSION['msg']);

                                 }
                              ?>
                        </p><br>

              <div class="justify-content-center">
                <div class="btn btn-lg btn-block">
                  <button id="btnRegistrar" type="submit" class="btn btn-info btn-lg btn-block" > CONSULTAR </button>
                </div>






                <?php
                if (isset($cnpj)) {

                   
                ?>



            </form>
          </div>


          <div class="container bg-light overflow-auto border rounded p-3 mt-4">

            <form action="./app/embd.php" method="POST" role="form">



              <!--Dados do Almoxarifado-->
              <div class="form-group">
                <label class="text-uppercase" for="DadosDaNotaFiscal"><strong>Dados do Almoxarifado:</strong></label>
              </div>



              <div class="form-group">
                <label for="idAlmoxLogin"> Almoxarifado </label>
                <input type="idAlmoxLogin" class="form-control" name="idAlmoxLogin" id="idAlmoxLogin" required="required" readonly value="<?= $_SESSION["idAlmoxLogin"]; ?>" />
              </div>

              <!--Dados da empresa-->
              <div class="form-group">
                <label for="cnpj" onchange="habilitarJuridica()">Dados Da Empresa</label>
                <input type="cnpj" class="form-control" name="cnpj" id="cnpj" required="required" onkeyup="mascara_cnpj()" value="<?= $cnpj ?>">
              </div>

             

              <div class="form-group">
                <label for="nomePessoa">Razão Social/Pessoa</label>
                <input type="nomePessoa" class="form-control" name="nomePessoa" id="nomePessoa" required="required" value="<?= $nome ?>">
              </div>
              <div class="d-flex" style="gap: 12px;">
                <div class="form-group w-50">
                  <label for="cepPessoa">Cep</label>
                  <input type="cepPessoa" class="form-control" name="cepPessoa" id="cepPessoa" required="required" value="<?= $cep ?>">
                </div>
                <div class="form-group w-75">
                  <label for="cidadePessoa">Cidade</label>
                  <input type="cidadePessoa" class="form-control" name="cidadePessoa" id="cidadePessoa" required="required" value="<?= $cidade ?>">
                </div>
                <div class="form-group w-25">
                  <label for="ufpessoa">UF</label>
                  <input type="ufpessoa" class="form-control" name="ufpessoa" id="ufpessoa" required="required" value="<?= $uf ?>">
                </div>
              </div>

              <div class="d-flex" style="gap: 12px;">
                <div class="form-group w-50">
                  <label for="enderecoPessoa">Endereço</label>
                  <input type="enderecoPessoa" class="form-control" name="enderecoPessoa" id="enderecoPessoa" required="required" value="<?= $endereco ?>">
                </div>

                <div class="form-group w-50">
                  <label for="bairroPessoa">Bairro</label>
                  <input type="bairroPessoa" class="form-control" name="bairroPessoa" id="bairroPessoa" required="required" value="<?= $bairro ?>">
                </div>
              </div>

              <div class="d-flex" style="gap: 12px;">
                <div class="form-group w-50">
                  <label for="telefonePessoa">Telefone</label>
                  <input type="telefonePessoa" class="form-control" name="telefonePessoa" id="telefonePessoa" required="required" value="<?= $telefone ?>">
                </div>

                <div class="form-group w-50">
                  <label for="emailPessoa">Email</label>
                  <input type="emailPessoa" class="form-control" name="emailPessoa" id="emailPessoa" required="required" value="<?= $email ?>">
                </div>
              </div>


              <!--Dados da nota fiscal-->

              <div class="form-group">
                <label class="text-uppercase" for="DadosDaNotaFiscal"><b> Dados da Nota Fiscal</b></label>
              </div>

              <div class="form-group">
                <label for="nf">Número da Nota Fiscal</label>
                <input type="nf" class="form-control" name="nf" id="nf" required="required">
              </div>
              
              <div class="d-flex" style="gap: 12px;">
                <div class="form-group w-50">
                  <label for="dtEntrada">Data Entrada Nota Fiscal</label>
                  <input type="date" class="form-control" name="dtEntrada" id="dtEntrada" required="dtEntrada">
                </div>
                <div class="form-group w-50">
                  <label for="dtEmissao">Data da Emissão Da Nota Fiscal</label>
                  <input type="date" class="form-control" name="dtEmissao" id="dtEmissao" required="required">
                </div>
              </div>

              <div class="form-group">
                <label for="valorConferencia">Valor Da Conferência</label>
                <input type="valorConferencia" class="form-control" size="15" maxlength="15" name="valorConferencia" id="valorConferencia" required="valorConferencia">
              </div>

          </div>





          <!--Botao do cadastro-->
          <div class="justify-content-center">
            <div class="btn btn-lg btn-block">
              <button id="btnRegistrar" type="submit" class="btn btn-info btn-lg btn-block">C A D A S T R A R</button>
            </div>
            <div class="btn btn-lg btn-block">
              <button type="button" class="btn btn-danger btn-lg btn-block" onclick="window.history.back();">V O L T A R</button>
            </div>
          </div>
        </div>
        </form>


      <?php
                }
      ?>

      </div>
      </td>
      <tr>
        </table>


        <!-- Sripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <script type="text/javascript">
          function habilitarJuridica() {
            var cnpj = document.getElementById('cnpj');
            var cnpjPessoa = document.getElementById('cnpjPessoa');

            if (cnpjPessoa.checked) {
              cnpj.removeAttribute("disabled");
            } else {
              cnpj.value = ''; //Evita que o usuário defina um texto e desabilite o campo após realiza-lo
              cnpj.setAttribute("disabled", "disabled");
            }
          }

          function habilitarFisica() {
            var cpf = document.getElementById('cpf');
            var cpfPessoa = document.getElementById('cpfPessoa');

            if (cpfPessoa.checked) {
              cpf.removeAttribute("disabled");
            } else {
              cpf.value = ''; //Evita que o usuário defina um texto e desabilite o campo após realiza-lo
              cpf.setAttribute("disabled", "disabled");
            }
          }


          //MASCARAS DOS INPUT (CNPJ/CPF/CEP/TELEFONE)

          function mascara_cnpj() {
            var cnpj = document.getElementById('cnpj')
            if (cnpj.value.length == 2 || cnpj.value.length == 6) {

              cnpj.value += "."
            } else if (cnpj.value.length == 10) {
              cnpj.value += "/"

            } else if (cnpj.value.length == 15) {
              cnpj.value += "-"
            }
          }

          function mascara_cpf() {
            var cpf = document.getElementById('cpf')
            if (cpf.value.length == 3 || cpf.value.length == 7) {

              cpf.value += "."
            } else if (cpf.value.length == 11) {
              cpf.value += "-"

            }
          }
        </script>

</body>