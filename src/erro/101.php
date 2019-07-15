<?php

include_once('../view/Template.php');

$page = new Template("../view/templates/");

$page->url_root = "../";
$page->modulo = "";
$page->titulo = "erro";
$page->codigo = "101";
$page->mensagem = "Usuario ou senha inválidos";

$page->render('erro.phtml');

?>