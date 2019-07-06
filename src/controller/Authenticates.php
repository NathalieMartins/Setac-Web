<?php
    session_start();
    
    require_once("Connection.php");
    
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    //Preveni SQL Inject
    if(get_magic_quotes_gpc() == 0){
        $login = $conexao->real_escape_string($login);
        $senha = $conexao->real_escape_string($senha);
    }
    
    //criptografamos a senha
    password_hash($senha, PASSWORD_DEFAULT);
    
    
    //Buscamos o usuário no BD
    $query="SELECT * FROM user WHERE nickname = '$login' AND password = '$senha'";
    $sql = $conexao->query($query) or die("ERRO NO COMANDO SQL");
    
    $row  = $sql->num_rows;
    
    if($row == 0){
        echo "Erro: Usuário ou Senha Inválidos";
        echo "<br>";
        echo "<a href='login.html'>voltar</a>"; #Volta pra página de login
    }else{
    
        $reg = $sql->fetch_array();
        $id = $reg[0];
        $nickName = $reg["nickname"];
        $access = $reg["access"];
    
        $_SESSION['id'] = $id;
        $_SESSION['login'] = $nickName;
        $_SESSION['access'] = $access;

        if($_SESSION['access'] == 0){

            header("Location: Admin.php");

        }elseif ($_SESSION['access'] == 1){

            header("Location: Organizador.php");

        }elseif ($_SESSION['access'] == 2) {
            
            header("Location: Credenciamento.php");

        }elseif ($_SESSION['access'] == 3){

            header("Location: Interno.php");
            
        }else{

            header("Location: Externo.php");
            
        }    
    
    }
    
    $conexao->close();
?>