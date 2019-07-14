<?php

include_once('view/Template.php');

$page = new Template();

$page->title = "login";

$page->render('login.phtml');

?>