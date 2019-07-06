#DROP DATABASE setac;

USE setac ;
-- ----------------------------------------------------------------
-- INSERE USUÁRIOS
-- ----------------------------------------------------------------

INSERT INTO `usuario` ( `login`, `senha`, `email`,`acesso`,`nome`, `cpf`, `telefone` ) VALUES ('Nathalie Martins', '4596', 'nathalie@gmail.com', '1', 'Nathalie Martins', '2626151785', '4399236092');

INSERT INTO `usuario` ( `login`, `senha`, `email`,`acesso`,`nome`, `cpf`, `telefone` ) VALUES ('Evandro Nakajima', '1234', 'evandro@gmail.com', '1', 'Evandro Nakajima', '2626151785', '323232015');

INSERT INTO `usuario` (`login`, `senha`, `email`,`acesso`,`nome`, `cpf`, `telefone` ) VALUES ('Natanael', '1234', 'natanael@gmail.com', '1', 'Natanael Dotti', '856841785', '459232564');


-- ----------------------------------------------------------------
-- INSERE PROFESSORES
-- ----------------------------------------------------------------

INSERT INTO `professor` (`siape`, `qualificacao`, `area`, `Usuario_id`) VALUES (1, 'Doutorado', 'Matematica', 2);

-- ----------------------------------------------------------------
-- INSERE ALUNO
-- ----------------------------------------------------------------

INSERT INTO `aluno` (`registroAcademico`, `Usuario_id`) VALUES ('1838075',1);

INSERT INTO `aluno` (`registroAcademico`, `Usuario_id`) VALUES ('1808067',3);
 
-- ----------------------------------------------------------------
-- INSERE ATIVIDADE
-- ----------------------------------------------------------------

INSERT INTO  `atividade` (`titulo`, `descricao`, `limiteInscricao`, `lugar`, `status`, `cargaHoraria`)
VALUES ('Maratona de Programação', 'Competição dos alunos', '30', 'L10', 'Disponivel', '6 horas');


INSERT INTO  `atividade` (`titulo`, `descricao`, `limiteInscricao`, `lugar`, `status`, `cargaHoraria`)
VALUES ('Palestra Mineração de dados', 'Ganhar dinheiro', '100', 'Auditorio', 'Disponivel', '4 horas');


INSERT INTO  `atividade` (`titulo`, `descricao`, `limiteInscricao`, `lugar`, `status`, `cargaHoraria`)
VALUES ('Jogos digitais', 'Modelagem 3D', '30', 'L09', 'Disponivel', '4 horas');


select * from atividade;

select * from  usuario;

select * from  aluno;

select * from  professor;