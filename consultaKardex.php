<?php
session_start();
if ((!isset($_SESSION["nome"]) == TRUE) and (!isset($_SESSION["nivel"]) == TRUE)) {
  session_unset();
  session_destroy();

  header("location:index.php");
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Administrador - StarCar</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="../dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">STARCAR</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="sair.php"><b>Logoff</b></a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../index.php">
              <span data-feather="home"></span>
              Início
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file"></span>
              Veículos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="consultar.php">
              <span data-feather="users"></span>
              Usuários
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <b>Logado com: <?php echo $_SESSION['usuario'].' - '. $_SESSION['nome']; ?></b>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Exportar</button>
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">          
          <p class="text-danger">
            <?php
            if(isset($_SESSION['msg'])){
              echo $_SESSION['msg'];
              unset($_SESSION['msg']);
            } 
            ?>
          </p>

          <thead>
            <tr>
              <th colspan="7">
                <h4>CONSULTA MOVIMENTO MATERIAL</h4>
              </th>
            </tr>
            <tr>
              <th>
                <form class="form-signin" method="POST" action="inserir.php"> 
                  <button class="btn btn-success" type="submit" name="inputGeral">Adicionar</button>
                </form>
              </th>
              <th colspan="7"></th>
            </tr>
          </thead>

          <thead>
            <tr>
              <th scope="col"> Lote </th>   
              <th scope="col"> MATERIAL </th>   
              <th scope="col"> MEDIDA </th>   
              <th scope="col" style="text-align: center;"> Bloqueado </th>  
              <th scope="col" style="text-align: center;" colspan="3"> Ação </th>              
            </tr>
          </thead>

          <tbody>
            
            <?php 
            include_once("../conexao/conexao.php");

            $result_usuario = 'SELECT * FROM tbusuario';
            $resultado_usuario = mysqli_query($conn, $result_usuario);

            while ($row = mysqli_fetch_assoc($resultado_usuario)) {
              
              echo '<tr>';
              echo '<th scope="row">' . $row['id'] . '</th>';
              echo '<td>' . $row['nome'] . '</td>';
              echo '<td>' . $row['usuario'] . '</td>';
              echo '<td style="text-align: center;">' . $row['bloqueado'] . '</td>';

              echo '<td style="text-align:right;">';
              echo '<form class="form-signin" method="POST" action="bloquear.php">';
              echo '<button class="btn btn-info btn-sm" type="submit" name="btnBloquear" 
                value="'.$row['id'].'"> Bloquear </button>';
              echo '</form>';
              echo '</td>';

              echo '<td style="text-align:center;">';
              echo '<form class="form-signin" method="POST" action="alterar.php">';
              echo '<button class="btn btn-warning btn-sm" type="submit" name="btnAlterar" 
                value="'.$row['id'].'"> Alterar </button>';
              echo '</form>';
              echo '</td>';

              echo '<td style="text-align:left;">';
              echo '<form class="form-signin" method="POST" action="excluir.php">';
              echo '<button class="btn btn-danger btn-sm" type="submit" name="btnExcluir" 
                value="'.$row['id'].'"> Excluir </button>';
              echo '</form>';
              echo '</td>';              
              echo '</tr>';
            }
            //COntinuar aqui
            ?>

          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
      <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
      <script src="../dashboard.js"></script>
  </body>
</html>

<?php 
}else{
  $_SESSION['msg'] = "Acesso negado!";
  header("Location: ../index.php");
}
?>