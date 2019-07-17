<?php
#Este arquivo é apenas um teste

require_once("Connection.php");
require_once("../model/Usuario.php");
require_once("../model/Professor.php");
require_once("../model/Estudante.php");
require_once("../model/Atividade.php");


#Se quiser testar inserir um User no banco ative o construtor que receba parametros e passeos aqui
#$user = new Usuario("ijijijij", "1234", "uhuhuhuh@gmail.com", 1, "teste", "01234567890", "45998118261");
#$user->insert();
#$user->loadById(5);
#$user->update("teste2", 0123);
#$user->loadById(1);
#$user->delete();
#print_r($user);

# Teste da classe professor

#$prof = new Professor("test4", "1234", "test4@hotmail.com", 1,"TESTE", "01234567890", "45998118261", "4", "Doutor", "IA");
#$result = $prof->insertProfessor();

#$prof = new Professor();
#$result = $prof->loadBySiape("1");

#$prof->updateProfessor('1838075','Mestre','Robotica');

#$prof->deleteProfessor($result->getSiape());

#print_r($result);



# Teste de classe Estudante

#$est = new Estudante("luan", "1234", "luan@hotmail.com", 1, "teste", "32345467", "4599236092", "12345");
#$result = $est->insertEstudante();

#$est = new Estudante();
#$result = $est->loadByRegistroAcademico('1808067'); #Segundo Aluno

#$est->updateEstudante("1802586");

#$est->deleteEstudante('12345');

#print_r($result);

# Teste de classe Atividade

#$ati = new Atividade('Calculo 3', 'Modelagem 3D', 30, 'L09', 'Disponivel', '4 horas', 'Thiagão naves', 'naves@utfpr.edu.br');
#$result = $ati->insertAtividade(1);

#$ati->updateAtividade('Modelagem 4D',30,'e5','Disponivel','4horas','lula da silva','lula@gmail.com');

#$ati->deleteAtividade(1,1);

#$ati->listarAtividadePorAlunoRA(1838075);
#$ati->listarAtividadePorProfessorSiape(1);

#print_r($result);