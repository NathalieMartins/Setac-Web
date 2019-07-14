<?php

include_once('view/template.php');

$page = new Template();

$page->title = "cadastro";

$page->render('cadastro.phtml');

?>