<nav id="navBar" class="navbar navbar-expand-lg navbar-light bg-light menuBar">
  <a class="navbar-brand" href="sgv.php"><img src="./img/usuarioMenu.jpeg" class="logoImagen" alt="..." style="max-height:52; border: none;"><span class="h6 ml-3 text-muted textMenu">Sistema Gerenciador de Materiais - <?=$_SESSION["nivel"];?></span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end me-5" id="navbarSupportedContent">
    <ul class="navbar-nav fw-bold">

      <!-- Consulta -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Movimento
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="em.php">Entrada Mercadoria</a>
          <a class="dropdown-item" href="cons-estoque.php">Estoque</a>
          <a class="dropdown-item" href="notaSaidaCodBar.php">Nota de Saída</a>
          <a class="dropdown-item" href="cons-matVencido.php">Material Vencido</a>
          <a class="dropdown-item" href="cons-matBaixado.php">Material Baixado</a>
          <a class="dropdown-item" href="cons-nf.php">Itens Notas Fiscais</a>
          <a class="dropdown-item" href="Kardex.php">Consulta Movimentacao Material</a>
        </div>
      </li>

      <!-- Painel -->
      <li class="nav-item">
        <a class="nav-link" href="cons-fornecedor.php">Fornecedor</a>
      </li>

      <!-- Painel -->
      <li class="nav-item">
        <a class="nav-link" href="cons-usuario.php">Atividades</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="usuario.php">Cadastre-se</a>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="logout.php">Sair</a>
      </li>
    </ul>
  </div>
  </div>
</nav>