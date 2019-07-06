<?php

    require_once("Connection.php");

    $login = $_POST["login"];
    $senha = $_POST["senha"];
    $email = $_POST["email"];
    $access = $_POST["access"];

    if($senha == $_POST["rsenha"] && $email == $_POST["remail"]){

        #Filtro anti SQL Inject
        if(get_magic_quotes_gpc() == 0){
            $login = $conexao->real_escape_string($login);
            $senha = $conexao->real_escape_string($senha);
            $email = $conexao->real_escape_string($email);
            $access = $conexao->real_escape_string($access);
        }

        #Valida o email
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){

            #Criptografa a senha do usuário
            $senha = password_hash($senha, PASSWORD_DEFAULT);

            #Verifica a redundância de usuário no banco
            $query="SELECT * FROM user WHERE nickname = '$login'";
            $sql = $conexao->query($query) or die("ERRO NO COMANDO SQL");

            $row = $sql->num_rows;

            if($row == 0){
                #Verifica a redundância de email no banco
                $query="SELECT * FROM user WHERE email = '$email'";
                $sql = $conexao->query($query) or die("ERRO NO COMANDO SQL");

                $row = $sql->num_rows;

                if($row == 0){
                    $query = "INSERT INTO `user` (`nickname`,`password`,`email`,`access`) VALUES ('$login', '$senha', '$email', '$access')";
                    $sql = $conexao->query($query) or die("Erro na inserção <br>". mysqli_connect_error());
                    echo "Sucesso na inserção";
                }else{
                    echo "Este email já foi cadastrado";
                }
            }else{
                echo "Este usuário já foi cadastrado";
            }

        }else{
            echo "Email inválido digite novamente";
            header("Location: ..\cadastro.html");
        }
        
    }else{
        echo "As senhas ou o email não são as mesmos";
        header("Location: ..\cadastro.html");
    }

?>