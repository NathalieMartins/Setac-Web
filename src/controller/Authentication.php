<?php

    #VER SE AINDA VAI SER USADA

    session_start();
    
    require_once("Connection.php");


    if($_SESSION['acesso'] == 0){

        header("Location: Admin.php");

    }elseif ($_SESSION['acesso'] == 1){

        header("Location: Organizador.php");

    }elseif ($_SESSION['acesso'] == 2) {
        
        header("Location: Credenciamento.php");

    }elseif ($_SESSION['acesso'] == 3){

        header("Location: Interno.php");
        
    }else{

        header("Location: Externo.php");
        
    }
    
    $conexao->close();
?>