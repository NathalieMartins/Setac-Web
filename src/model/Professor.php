
<?php

include_once('Usuario.php');

class Professor extends Usuario
{
    private $siape;
    private $qualificacao;
    private $area;
    private $idUsuario;

    public function __construct($login = "", $senha = "", $email = "", $acesso = "", $nome = "", $cpf = "", $telefone = "", $siape = "", $qualificacao = "", $area = "")
    {
        $this->setLogin($login);
        $this->setSenha($senha);
        $this->setEmail($email);
        $this->setAcesso($acesso);
        $this->setNome($nome);
        $this->setCPF($cpf);
        $this->setTelefone($telefone);
        $this->setSiape($siape);
        $this->setQualificacao($qualificacao);
        $this->setArea($area);
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setSiape($siape)
    {
        $this->siape = $siape;
    }

    public function getSiape()
    {
        return $this->siape;
    }

    public function setQualificacao($qualificacao)
    {
        $this->qualificacao = $qualificacao;
    }

    public function getQualificacao()
    {
        return $this->qualificacao;
    }

    public function setArea($area)
    {
        $this->area = $area;
    }

    public function getArea()
    {
        return $this->area;
    }

    public function loadBySiape($siape)
    {
        $conexao = new Connection();

        $results = $conexao->select(
            "SELECT * FROM professor WHERE siape = :SIAPE",
            array(
                ":SIAPE" => $siape
            )
        );

        $result2 = $conexao->select(
            "SELECT * FROM professor inner join usuario 
            on usuario.user_id = :IDUSUARIO AND siape = :SIAPE",
            array(
                ":IDUSUARIO" => $results[0]["usuario_id"],
                ":SIAPE" => $siape
            )
        );

        if (count($result2) > 0) {
            $this->setDadosProfessorAndUser($result2[0]);
            return $this;
        } else {
            echo  "<script>alert('Professor não encontrado!');</script>";
        }
    }

    public function insertProfessor()
    {
        $conexao = new Connection();

        $resul = $conexao->select(
            "SELECT * FROM professor where siape = :SIAPE",
            array(
                ':SIAPE' => $this->getSiape()
            )
        );

        if (count($resul) == 0) {

            $professor = $this->insert();

            $insertProf = $conexao->select(
                "CALL insere_professor(:SIAPE, :QUALIFICACAO, :AREA, :USERID)",
                array(
                    ':SIAPE' => $this->getSiape(),
                    ':QUALIFICACAO' => $this->getQualificacao(),
                    ':AREA' => $this->getArea(),
                    ':USERID' => $this->getId()
                )
            );

            if (count($insertProf) > 0) {
                echo  "<script>alert('Professor cadastrado com sucesso!');</script>";
                $this->setDadosProfessor($insertProf[0], $professor);

                return $professor;
            }
        } else {

            throw new Exception("Este professor já possui cadastro!");
        }
    }

    public function updateProfessor($siape, $qualificacao, $area)
    {

        $conexao = new Connection();

        $resul = $conexao->select(
            "UPDATE professor SET qualificacao = :QUALIFICACAO, area = :AREA WHERE siape = :SIAPE",
            array(
                ":SIAPE" => $siape,
                ":QUALIFICACAO" => $qualificacao,
                ":AREA" => $area
            )
        );

        if (count($resul) == 0) {

            $this->setSiape($siape);
            $this->setQualificacao($qualificacao);
            $this->setArea($area);

            $conexao->query(
                "UPDATE professor SET 
                siape :SIAPE, qualificacao = :QUALIFICACAO , area = :AREA,
                WHERE professor_id = :ID",
                array(
                    ":SIAPE" => $this->getSiape(),
                    ":QUALIFICACAO" => $this->getQualificacao(),
                    ":AREA" => $this->getArea(),
                    ':ID' => $this->getId()
                )
            );
            echo  "<script>alert('Professor atualizado com sucesso!');</script>";
        } else {

            throw new Exception("Erro ao atualizar professor");
        }
    }

    public function deleteProfessor($siape)
    {
        $conexao = new Connection();

        $conexao->query("DELETE FROM professor WHERE siape = :SIAPE", array(
            ':SIAPE' => $siape
        ));

        echo  "<script>alert('Professor excluído com sucesso!');</script>";
    }

    public function setDadosProfessor($dados, $professor)
    {
        $professor->setSiape($dados['siape']);
        $professor->setQualificacao($dados['qualificacao']);
        $professor->setArea($dados['area']);
        $professor->setIdUsuario($dados['usuario_id']);
    }

    public function setDadosProfessorAndUser($dados)
    {
        $this->setId($dados['user_id']);
        $this->setLogin($dados['login']);
        $this->setSenha($dados['senha']);
        $this->setEmail($dados['email']);
        $this->setAcesso($dados['acesso']);
        $this->setNome($dados['nome']);
        $this->setCPF($dados['cpf']);
        $this->setTelefone($dados['telefone']);

        $this->setSiape($dados['siape']);
        $this->setQualificacao($dados['qualificacao']);
        $this->setArea($dados['area']);
        $this->setIdUsuario($dados['usuario_id']);
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

            "siape" => $this->getSiape(),
            "qualificacao" => $this->getQualificacao(),
            "area" => $this->getArea(),
            "usuario_id" => $this->getIdUsuario()
        ));
    }
}
