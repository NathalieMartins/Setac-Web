<?php

include_once('../model/Usuario.php');
include_once('../view/Template.php');

$usuario = new Usuario();

$login = $_POST["usuario"];
$senha = $_POST["senha"];

try {
  $usuario->login($login, $senha);
}
catch (Exception $e) {
  if($e->getCode() == 10) {
    header("Location: ../erro10.php");
  }
}

switch($usuario->getAcesso()) {
  case 1:
    
}

?>