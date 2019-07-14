<?php

include_once('view/Template.php');

$page = new Template();

$page->url_root = "";
$page->modulo = "";
$page->titulo = "erro";
$page->codigo = "10";
$page->mensagem = "Usuario ou senha inválidos";

$page->render('erro.phtml');

?>