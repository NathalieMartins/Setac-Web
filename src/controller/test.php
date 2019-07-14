<?php
    #Este arquivo é apenas um teste

    require_once("Connection.php");
    require_once("../model/Usuario.php");
    require_once("../model/Professor.php");

    #Se quiser testar inserir um User no banco ative o construtor que receba parametros e passeos aqui
    #$user = new Usuario("test", "1234", "test@hotmail.com", 1,"TESTE", "01234567890", "45998118261");
    #$user->insert();

    $prof = new Professor("test", "1234", "test@hotmail.com", 1,"TESTE", "01234567890", "45998118261", "1844164", "Doutor", "IA");

    $prof->insertProfessor();

    
    

    #print_r($user);

?>