<?php

include_once('../controller/Session.php');
include_once('../model/Usuario.php');

if(!isset($_SESSION["usuario"])) {
  header("Location: ../login.php");
}

$usuario = unserialize($_SESSION['usuario']);

session_destroy();

?>