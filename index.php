<?php
session_start();

//limpar todas as sessoes




?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log-in</title>

    <!-- Booststrap / AOS animation -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body {
            background: rgb(2, 0, 36);
            background: linear-gradient(0deg, rgba(2, 0, 36, 1) 0%, rgba(9, 9, 121, 1) 50%, rgba(0, 212, 255, 1) 100%);
        }
    </style>

    <!-- Fonte do Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container" style="max-width: calc(30vw + 200px);">
        <div class="text-center">
            <div class="p-3 border rounded bg-light shadow" style="margin-top: 18vh;">
                <form action="./app/valida-loginbd.php" method="POST" role="form">

                    <div align="center">

                        <div class="card-body">
                            <h5 class="card-title display-4">SGM</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Sistema de Gerenciamento de Material</h6>
                        </div>

                        <p class="h5 text-left mb-2" style="color: #111111;">Usuário:</p>

                        <input type="text" class="form-control mb-3" id="login" placeholder="Informe seu usuário." name="login" size="50" maxlength="50" required></input>

                        <p class="mb-2 h5 text-left">Senha:</p>

                        <input type="password" class="form-control mb-4" id="senha" placeholder="Infome a sua senha." name="senha" size="20" maxlength="20" required></input>
                    </div>

                        <p class="text-danger">
                              <?php 
                                 if(isset($_SESSION['msg'])) {
                                  echo $_SESSION['msg'];
                                  unset( $_SESSION['msg']);

                                 }
                              ?>
                        </p><br>

                    <div class="form-group">
                        <div class="align-items-center">
                            <button type="submit" class="btn btn-info btn-lg btn-block">LOGIN</button>
                        </div>
                        <div class="align-items-center">
                            <a href="usuario.php" style="text-decoration: none;">
                                <button type="button" class="btn btn-info btn-lg btn-block mt-2">REGISTRAR</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>
</html>