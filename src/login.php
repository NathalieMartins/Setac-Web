<?php

include_once('view/template.php');

$page = new Template();

$page->title = "login";

$page->render('login.phtml');

?>