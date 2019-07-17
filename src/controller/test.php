<?php
#Este arquivo é apenas um teste

require_once("Connection.php");
require_once("../model/Usuario.php");
require_once("../model/Professor.php");
require_once("../model/Estudante.php");
require_once("../model/Atividade.php");


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

$prof = new Professor("test4", "1234", "test4@hotmail.com", 1,"TESTE", "01234567890", "45998118261", "4", "Doutor", "IA");
$result = $prof->insertProfessor();

#$prof = new Professor("test", "1234", "test@hotmail.com", 1, "TESTE", "01234567890", "4599236092", "1838075", "MESTRE", "COMPUTAÇÃO GRAFICA");
#$prof->insertProfessor();
#$prof = new Professor();
#$result = $prof->loadBySiape("1");
#echo "<br><br>";
print_r($result);
#$prof->updateProfessor('1838075','DOUTOR','37');
# print_r($prof);
#$prof->deleteProfessor('1838075');
#$print_r($prof);



# Teste de classe Estudante

#$est = new Estudante("luan", "1234", "luan@hotmail.com", 1, "teste", "32345467", "4599236092", "849961");
#$est->insertEstudante();
#$est->delete();
#$est->deleteEstudante();
#$result = $aluno->loadByRegistroAcademico("1808067");
#print_r($result);
#$est->updateEstudante("1802586");



# Teste de classe Atividade

$ati = new Atividade('Calculo 3', 'Modelagem 3D', 30, 'L09', 'Disponivel', '4 horas', 'Thiagão naves', 'naves@utfpr.edu.br');
#$ati->insertAtividade(1);
#$ati->updateAtividade('Modelagem 4D',30,'e5','Disponivel','4horas','lula da silva','lula@gmail.com');
#$ati->deleteAtividade(1,1);
#$ati->listarAtividadePorAlunoRA(1838075);
$ati->listarAtividadePorProfessorSiape(1);