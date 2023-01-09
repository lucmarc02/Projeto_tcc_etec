<?php

// cria uma sessão

    session_start();

    // limpa todas variaveis ambiente
    session_unset();

    // destroi a sessão criada
    session_destroy();

// redireciona para pagina index.php
    header("location:index.php");