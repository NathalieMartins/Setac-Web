<?php

include_once('Usuario.php');

class Estudante extends Usuario
{
    private $registroAcademico;


    public function __construct($login, $senha, $email, $acesso, $nome, $cpf, $telefone,$registroAcademico)
    {
        parent::__construct($login, $senha, $email, $acesso, $nome, $cpf, $telefone);
        $this->setRegistroAcademico($registroAcademico);
    }

    public function getRegistroAcademico()
    {
        return $this->registroAcademico;
    }

    public function setRegistroAcademico($registroAcademico)
    {
        $this->registroAcademico = $registroAcademico;
    }

    public function loadByRegistroAcademico($registroAcademico)
    {

        $conexao = new Connection();

        $results = $conexao->select("SELECT * FROM aluno WHERE registroAcademico = :REGISTROACADEMICO", array(
            ":REGISTROACADEMICO" => $registroAcademico
        ));

        if (count($results) > 0) {
            $this->setDados($results[0]);
        }
    }

    public function insertEstudante()
    {
        $conexao = new Connection();

        $resul = $conexao->select(
            "SELECT * FROM aluno where registroAcademico = :REGISTROACADEMICO",
            array(
                ':REGISTROACADEMICO' => $this->getRegistroAcademico()
            )
        );

        if (count($resul) == 0) {
            
            $this->insert();

            $insertAluno = $conexao->select(
                "CALL insere_aluno(:REGISTROACADEMICO, :USERID)",
                array(
                    ':REGISTROACADEMICO' => $this->getRegistroAcademico(),
                    ':USERID' => $this->getId()
                )
            );

            if (count($insertAluno) > 0) {
                echo  "<script>alert('Aluno Cadastrado com Sucesso!');</script>";
                $this->setDadosEstudante($insertAluno[0]);

                return $this;
            }
        } else {

            throw new Exception("Este Aluno ja possui cadastro!");
        }
    }

    public function updateEstudante($registroAcademico)
    {
        $this->setDeslogin($registroAcademico);

        $conexao = new Connection();
        $conexao->query("UPDATE aluno SET resgitroAcademico = :REGISTROACADEMICO WHERE idusuario = :ID ", array(
            ':REGISTROACADEMICO' => $this->getRegistroAcademico(),

        ));
    }

    public function deleteEstudante()
    {
        $conexao = new Connection();
        $conexao->query("DELETE FROM aluno WHERE registroAcademico = :REGISTROACADEMICO", array(
            ':REGISTROACADEMICO' => $this->getRegistroAcademico()
        ));

        $this->setRegistroAcademico(0);

        echo  "<script>alert('Aluno excluído com sucesso!');</script>";
    }

    public function setDadosEstudante($dados)
    {
        $this->setRegistroAcademico($dados['registroAcademico']);
    }

    public function __toString()
    {
        return json_encode(array(
            "registroAcademico" => $this->getRegistroAcademico(),

        ));
    }
}
