<?php

include_once('../controller/Session.php');
include_once('../model/Usuario.php');

$usuario = new Usuario();

$login = $_POST["usuario"];
$senha = $_POST["senha"];

try {
  $ret = $usuario->login($login, $senha);
}
catch (InvalidArgumentException $e) {
  session_destroy();

  if($e->getCode() == 101) {
    header("Location: ../erro/101.php");
  }
  if($e->getCode() == 102) {
    header("Location: ../erro/102.php");
  }

  exit();
}
catch (PDOException $e) {
  session_destroy();
  header("Location: ../erro/201.php");
  exit();
}


$_SESSION['usuario'] = serialize($usuario);
header("Location: ../painel/");
exit();

?>