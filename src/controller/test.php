<?php
#Este arquivo é apenas um teste

require_once("Connection.php");
require_once("../model/Usuario.php");
require_once("../model/Professor.php");
require_once("../model/Estudante.php");

#Se quiser testar inserir um User no banco ative o construtor que receba parametros e passeos aqui
#$user = new Usuario("test", "1234", "test@gmail.com", 1, "teste", "01234567890", "45998118261");
#$user = new Usuario();
#$user->insert();
#$user->loadById(5);
#$user->update("teste2", 0123);
#$user->loadById(1);
#$user->delete();
#print_r($user);

# Teste da classe professor

#$prof = new Professor("test", "1234", "test@hotmail.com", 1,"TESTE", "01234567890", "45998118261", "1844164", "Doutor", "IA");
#$prof->insertProfessor();

#$prof = new Professor("test", "1234", "test@hotmail.com", 1, "TESTE", "01234567890", "4599236092", "1838075", "MESTRE", "COMPUTAÇÃO GRAFICA");
#$prof->insertProfessor();
$prof = new Professor();
$result = $prof->loadBySiape("1");
print_r($result);
#$prof->updateProfessor('1838075','DOUTOR','37');
# print_r($prof);
#$prof->deleteProfessor('1838075');
#$print_r($prof);



# Teste de classe Estudante

#$est = new Estudante("lalalal", "1234", "lalala@hotmail.com", 1, "TESTE", "01234567890", "4599236092", "1808090");
#$est->insertEstudante();
#$est->deleteEstudante();
#print_r($user); 