<?php

include_once('../controller/Session.php');
include_once('../model/Usuario.php');
include_once('../view/Template.php');

if(!isset($_SESSION["usuario"])) {
  header("Location: ../login.php");
}

$usuario = unserialize($_SESSION['usuario']);

$page = new Template("../view/templates/");

$page->url_root = "../";
$page->modulo = "painel";
$page->titulo = "painel";
$page->usuario = $usuario;

if($usuario->getAcesso() == 1) {
  $page->render("painel-user.phtml");
}
else if($usuario->getAcesso() == 2) {
  $page->render("painel-adm.phtml");
}
else {
  throw new Exception("Código de acesso inválido.");
}

?>