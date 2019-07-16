#DROP DATABASE setac;

USE setac ;
-- ----------------------------------------------------------------
-- INSERE USUÁRIOS
-- ----------------------------------------------------------------

CALL insere_usuario('Nathalie', '1234', 'nathalie@gmail.com', '1', 'Nathalie Martins', '01234567890', '01234567890');

CALL insere_usuario('Evandro', '1234', 'evandro@gmail.com', '2', 'Evandro Nakajima', '01234567890', '01234567890');

CALL insere_usuario('Natanael', '1234', 'natanael@gmail.com', '1', 'Natanael Dotti', '01234567890', '01234567890');


-- ----------------------------------------------------------------
-- INSERE PROFESSORES
-- ----------------------------------------------------------------

CALL insere_professor(1, 'Doutorado', 'Matematica', 2);

-- ----------------------------------------------------------------
-- INSERE ALUNO
-- ----------------------------------------------------------------

CALL insere_aluno('1838075',1);

CALL insere_aluno('1808067',3);
 
-- ----------------------------------------------------------------
-- INSERE ATIVIDADE
-- ----------------------------------------------------------------

CALL insere_atividade('Maratona de Programação', 'Competição dos alunos', 30, 'L10', 'Disponivel', '6 horas', 'Frank Carlos Benitez', 'frank@utfpr.edu.br');

CALL insere_atividade('Palestra Mineração de dados', 'Ganhar dinheiro', 100, 'Auditorio', 'Disponivel', '4 horas', 'kely', 'kely@utfpr.edu.br');

CALL insere_atividade('Jogos digitais', 'Modelagem 3D', 30, 'L09', 'Disponivel', '4 horas', 'Thiagão do Gueto', 'franca@utfpr.edu.br');

-- ----------------------------------------------------------------
-- INSERE TABELA ASSOCIATIVA
-- ----------------------------------------------------------------

CALL insere_usuaro_has_atividade(1, 1);
CALL insere_usuaro_has_atividade(1, 2);
CALL insere_usuaro_has_atividade(1, 3);

CALL insere_usuaro_has_atividade(3, 1);
CALL insere_usuaro_has_atividade(3, 2);
CALL insere_usuaro_has_atividade(3, 3);

CALL insere_usuaro_has_atividade(2, 2);

select * from atividade;

select * from  usuario;

select * from  aluno;

select * from  professor;

select * from usuario_has_atividade;
