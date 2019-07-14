<?php

include_once('view/Template.php');

$page = new Template();

$page->url_root = "";
$page->modulo = "";
$page->titulo = "cadastro";

$page->render('cadastro.phtml');

?>