<?php

include("../model/Usuario.php");

  // session_start();

$usuario = new Usuario();

$login = $_POST["usuario"];
$senha = $_POST["senha"];

$usuario->login($login, $senha);

$resul = $conexao->select(
  "SELECT * FROM usuario where login = :LOGIN AND senha = :SENHA",
  array(
    ":LOGIN" => $usuario,
    ":SENHA" => $senha
  )
);

if (count($resul) == 0) {
  throw new Exception("Login ou Senha Inválidos");
} else {
      // $this->setDados($resul[0]);

  echo $resul[0]["acesso"];
}



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

$conexao = null;
?>