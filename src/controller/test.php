<?php

    require_once("Connection.php");
    require_once("../model/Usuario.php");

    $user = new Usuario();

    $user->loadById(1);

    #print_r($user);

?>