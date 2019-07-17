<?php

include_once('Usuario.php');

class Estudante extends Usuario
{
    private $registroAcademico;
    private $idUsuario;

    public function __construct($login = "", $senha = "", $email = "", $acesso = "", $nome = "", $cpf = "", $telefone = "", $registroAcademico = "")
    {
        $this->setLogin($login);
        $this->setSenha($senha);
        $this->setEmail($email);
        $this->setAcesso($acesso);
        $this->setNome($nome);
        $this->setCPF($cpf);
        $this->setTelefone($telefone);
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
            on :IDUSUARIO = usuario.user_id AND registroAcademico = :REGISTROACADEMICO",
            array(
                ":IDUSUARIO" => $results[0]["usuario_id"],
                ":REGISTROACADEMICO" => $registroAcademico
            )
        );

        if (count($result2) > 0) {
            print_r($result2[0]);
            $this->setDadosEstudanteAndUser($result2[0]);
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

           $aluno = $this->insert();

            $insertAluno = $conexao->select(
                "CALL insere_aluno(:REGISTROACADEMICO, :USERID)",
                array(
                    ':REGISTROACADEMICO' => $this->getRegistroAcademico(),
                    ':USERID' => $this->getId()
                )
            );

            if (count($insertAluno) > 0) {
                echo  "<script>alert('Aluno Cadastrado com Sucesso!');</script>";
                $this->setDadosEstudante($insertAluno[0], $aluno);

                return $aluno;
            }
        } else {

            throw new Exception("Este Aluno ja possui cadastro!");
        }
    }

    public function updateEstudante($registroAcademico)
    {
        $this->setRegistroAcademico($registroAcademico);

        $conexao = new Connection();
        $conexao->query("UPDATE aluno SET resgitroAcademico = :REGISTROACADEMICO WHERE  registroAcademico = :ID ", array(
            ':REGISTROACADEMICO' => $registroAcademico,
            ':ID' => $this->getRegistroAcademico()
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

    public function setDadosEstudante($dados, $aluno){
        $aluno->setRegistroAcademico($dados['registroAcademico']);
        $aluno->setIdUsuario($dados['usuario_id']);
    }

    public function setDadosEstudanteAndUser($dados)
    {
        $this->setId($dados['user_id']);
        $this->setLogin($dados['login']);
        $this->setSenha($dados['senha']);
        $this->setEmail($dados['email']);
        $this->setAcesso($dados['acesso']);
        $this->setNome($dados['nome']);
        $this->setCPF($dados['cpf']);
        $this->setTelefone($dados['telefone']);

        $this->setRegistroAcademico($dados['registroAcademico']);
        $this->setRegistroAcademico($dados['usuario_id']);
    }

    public function __toString()
    {
        return json_encode(array(
            "user_id" => $this->getId(),
            "login" => $this->getLogin(),
            "senha" => $this->getSenha(),
            "email" => $this->getEmail(),
            "acesso" => $this->getAcesso(),
            "nome" => $this->getNome(),
            "cpf" => $this->getCPF(),
            "telefone" => $this->getTelefone(),
            
            "aluno_id" => $this->getId(),   
            "registroAcademico" => $this->getRegistroAcademico(),
            "usuario_id" => $this->getIdUsuario()
        ));
    }
}
