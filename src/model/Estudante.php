<?php

include_once('Usuario.php');

class Estudante extends Usuario
{
    private $registroAcademico;
    private $idUsuario;


    public function __construct($login = "", $senha = "", $email = "", $acesso = "", $nome = "", $cpf = "", $telefone = "",$registroAcademico = "")
    {
        parent::__construct($login, $senha, $email, $acesso, $nome, $cpf, $telefone);
        $this->setRegistroAcademico($registroAcademico);
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
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

        $result2 = $conexao->select(
            "SELECT * FROM aluno inner join usuario
            on :IDUSUARIO = usuario.id AND registroAcademico = :REGISTROACADEMICO",
            array(
                ":IDUSUARIO" => $results[0]["usuario_id"],
                ":REGISTROACADEMICO" => $registroAcademico
            )
        );

        if (count($result2) > 0) {
            print_r($result2[0]);
            $this->setDados($result2[0]);
            return $this;
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
        $this->setId($dados['id']);
        $this->setLogin($dados['login']);
        $this->setSenha($dados['senha']);
        $this->setEmail($dados['email']);
        $this->setAcesso($dados['acesso']);
        $this->setNome($dados['nome']);
        $this->setCPF($dados['cpf']);
        $this->setTelefone($dados['telefone']);

        $this->setRegistroAcademico($dados['registroAcademico']);
        $this->setIdUsuario($dados['usuario_id']);
    }

    public function __toString()
    {
        return json_encode(array(
            "id" => $this->getId(),
            "login" => $this->getLogin(),
            "senha" => $this->getSenha(),
            "email" => $this->getEmail(),
            "acesso" => $this->getAcesso(),
            "nome" => $this->getNome(),
            "cpf" => $this->getCPF(),
            "telefone" => $this->getTelefone(),

            "registroAcademico" => $this->getRegistroAcademico(),
            "usuario_id" => $this->getIdUsuario()
        ));
    }
}
