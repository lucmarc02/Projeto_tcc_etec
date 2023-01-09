<!--  (Opcional) Adicionar um input para pegar a data automatica, sem pedir para o usuario colocar no compo do registro -->

<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body style="
  background-position: center; 
  background-size: cover; 
  scroll-behavior: smooth;
  background: rgb(2,0,36);
  background: linear-gradient(0deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 50%, rgba(0,212,255,1) 100%); ">

  <!-- Container -->
  <div class="container justify-content-center bg-white p-3 rounded shadow">
    <div style="margin: 0 auto; text-align: center;">
      <img src="./img/usuario.jpeg" style="width: auto;">
    </div>

    <!-- Começo do formulario -->
    <form name="formulario" class="justify-content-center" action="./app/cadastroUserbd.php" method="POST" role="form" style="font-family: sans-serif;">

      <!-- Nome -->
      <div class="form-group">
        <label for="nomeLogin">Nome</label>
        <input type="text" class="form-control" name="nomeLogin" id="nomeLogin" placeholder="Insira seu nome" required="required">
        <div class="valid-feedback">
          Parece bom!
        </div>
        <div class="invalid-feedback">
          Informe um Nome com mais de 4 caracteres.
        </div>
      </div>

      <!-- Login -->
      <div class="form-group">
        <label for="usuarioLogin">Login</label>
        <input type="text" class="form-control" name="usuarioLogin" id="usuarioLogin" placeholder="Insira o nome do seu almoxarifado" required>
        <div class="valid-feedback">
          Parece bom!
        </div>
        <div class="invalid-feedback">
          Informe um Login com mais de 4 caracteres.
        </div>
      </div>

      <!-- Email -->
      <div class="form-group">
        <label for="emailLogin">Email</label>
        <input type="email" class="form-control" name="emailLogin" id="emailLogin" aria-describedby="emailHelp" placeholder="Insira seu e-mail" required>
        <div class="valid-feedback">
          Parece bom!
        </div>
        <div id="emailVerificar" class="invalid-feedback">
          Informe um email aceitável.
        </div>
      </div>

      <!-- Nivel do Usuario -->
      <div class="" style="gap: 10px;">
        <div class="form-group">
          <label for="nivelLogin">Nivél do Usúario</label>
          <select class="form-control" name="nivelLogin" id="nivelLogin">
            <option selected="">Administrador</option>
            <option>Usúario</option>
          </select>
        </div>

        <!-- Data de Criacao -->
        <div class="form-group d-none">
          <label for="dataLogin" class="form-label">Data de Criação:</label>
          <input type="text" class="form-control" name="dataLogin" id="dataLogin" value="">
        </div>
      </div>

      <!-- Senha -->
      <label class="form-group" for="senhaLogin">Senha</label>
      <div class="input-group mb-2 mr-sm-2">
        <input name="senhaLogin" id="senhaLogin" name="senhaLogin" type="password" class="form-control" placeholder="Informe sua senha" required onkeyup="validarSenha()">
        <div class="input-group-prepend">
          <button id="btnVisu" type="button" class="input-group-text"><img id="icon" src="./img/hidden.png" style="width: 24px;"></button>
        </div>
        <div class="valid-feedback">
          Parece bom!
        </div>
        <div id="senhaInvalida" class="invalid-feedback">
          Informe uma senha válida.
        </div>
      </div>
      <div class="progress mb-1">
        <div id="progessBar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
      </div>

      <!-- Senha 2 -->
      <div class="form-group">
        <label for="senhaVer">Digite a Senha Novamente</label>
        <input name="senhaVer" id="senhaVer" name="senhaVer" type="password" class="form-control" placeholder="Informe sua senha novamente" required>
        <div class="valid-feedback">
          Está correto!
        </div>
        <div id="senhaVer" class="invalid-feedback">
          Digite a mesma senha corretamente.
        </div>
      </div>

      <!-- Almoxarifado -->
      <div class="form-group d-none">
        <label for="almoxLogin" class="form-label">Almoxarifado:</label>
        <input type="text" class="form-control" name="almoxLogin" id="almoxLogin" placeholder="Informe o almoxarifado" required value="1">
        <div class="valid-feedback">
          Parece bom!
        </div>
        <div class="invalid-feedback">
          Informe um Almoxarifado com mais de 3 caracteres.
        </div>
      </div>

      <!-- stats -->
      <div class="form-group d-none">
        <label for="dataLogin" class="form-label"> status </label>
        <input type="text" class="form-control" name="statusLogin" id="statusLogin" value="1">
      </div>

      <!-- Botoes -->
      <div class="justify-content-center">
        <div class="btn btn-lg btn-block">
          <button id="btnRegistrar" type="button" class="disabled btn btn-info btn-lg btn-block">Registrar</button>
        </div>
        <div class="btn btn-lg btn-block">
          <button type="button" class="btn btn-danger btn-lg btn-block" onclick="window.history.back();">Voltar</button>
        </div>
      </div>
    </form>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <!-- Scripts das senhas -->
  <script src="./css-js/preload.js"></script>

</body>

</html>