<?php

include_once('../view/Template.php');

$page = new Template("../view/templates/");

$page->url_root = "../";
$page->modulo = "";
$page->titulo = "erro";
$page->codigo = "201";
$page->mensagem = "Acesso ao banco de dados negado. Verifique os dados de conexão.";

$page->render('erro.phtml');

?>