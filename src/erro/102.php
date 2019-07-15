<?php

include_once('../view/Template.php');

$page = new Template("../view/templates/");

$page->url_root = "../";
$page->modulo = "";
$page->titulo = "erro";
$page->codigo = "102";
$page->mensagem = "Usuário ou email já cadastrados.";

$page->render('erro.phtml');

?>