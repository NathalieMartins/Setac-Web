<?php

include_once('view/Template.php');

$page = new Template();

$page->url_root = "";
$page->modulo = "";
$page->titulo = "login";

$page->render('login.phtml');

?>