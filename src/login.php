<?php

include_once('controller/Session.php');
include_once('view/Template.php');

if(isset($_SESSION["usuario"])) {
  header("Location: painel/");
}

$page = new Template();

$page->url_root = "";
$page->modulo = "";
$page->titulo = "login";

$page->render('login.phtml');

?>