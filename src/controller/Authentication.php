<?php

include_once('../controller/Session.php');
include_once('../model/Usuario.php');

$usuario = new Usuario();

$login = $_POST["usuario"];
$senha = $_POST["senha"];

try {
  $usuario->login($login, $senha);
}
catch (Exception $e) {
  if($e->getCode() == 10) {
    session_destroy();
    header("Location: ../erro10.php");
    exit();
  }
}

$_SESSION['usuario'] = $usuario;
header("Location: ../painel/");
exit();

?>