<?php
    #Este arquivo é apenas um teste

    require_once("Connection.php");
    require_once("../model/Usuario.php");
    require_once("../model/Professor.php");
    #require_once("")

    #Se quiser testar inserir um User no banco ative o construtor que receba parametros e passeos aqui
    #$user = new Usuario("test", "1234", "test@gmail.com", 1, "teste", "01234567890", "45998118261");
    #$user = new Usuario();
    #$user->insert();
    #$user->loadById(5);
    #$user->update("teste2", 0123);
    #$user->loadById(1);
    #$user->delete();
    #print_r($user);

    #$prof = new Professor("test", "1234", "test@hotmail.com", 1,"TESTE", "01234567890", "45998118261", "1844164", "Doutor", "IA");
    #$prof->insertProfessor();
    
    $prof = new Professor();
    $prof->loadById(1);
    print_r($prof);
    
    

    

?>