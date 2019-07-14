<?php

include("../model/Usuario.php");

$usuario = new Usuario();

$login = $_POST["usuario"];
$senha = $_POST["senha"];

try {
  $usuario->login($login, $senha);
}
catch (Exception $e) {

  $page = new Template();

  $page->title = "erro 401";

  $page->render('erro.phtml');

}


?>