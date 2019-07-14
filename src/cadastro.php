<?php

include_once('view/template.php');

$page = new Template();

$page->modulo = "";
$page->titulo = "cadastro";

$page->render('cadastro.phtml');

?>