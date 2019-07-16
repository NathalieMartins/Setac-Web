
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
        parent::__construct($login, $senha, $email, $acesso, $nome, $cpf, $telefone);
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

        $results = $conexao->select("SELECT * FROM professor WHERE siape = :SIAPE"
        , array(
            ":SIAPE" => $siape
        ));

        $result2 = $conexao->select(
            "SELECT * FROM professor inner join usuario 
            on :IDUSUARIO = usuario.id AND siape = :SIAPE",
            array(
                ":IDUSUARIO" => $results[0]["usuario_id"],
                ":SIAPE" => $siape
            )
        );

        if (count($result2) > 0) {
            $this->setDadosProfessor($result2[0]);
            return $this;
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

            /*Antes de cadastrar um professor tem que cadastrar o usuário */
            $this->insert(); //Insere o usuário relacionado ao professor

            $insertProf = $conexao->select(
                "CALL insere_professor(:SIAPE, :QUALIFICACAO, :AREA, :USERID)",
                array(
                    ':SIAPE' => $this->getSiape(),
                    ':QUALIFICACAO' => $this->getQualificacao(),
                    ':AREA' => $this->getAcesso(),
                    ':USERID' => $this->getId()
                )
            );

            if (count($insertProf) > 0) {
                echo  "<script>alert('Professor cadastrado com sucesso!');</script>";
                $this->setDadosProfessor($insertProf[0]);

                return $this;
            }
        } else {

            throw new Exception("Este professor já possui cadastro!");
        }
    }

    public function updateProfessor($siape, $qualificacao, $area)
    {

        $conexao = new Connection();

        $resul = $conexao->select(
            "SELECT * FROM professor where siape = :SIAPE AND qualificacao = :QUALIFICACAO AND area :AREA",
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
                WHERE id = :ID",
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

    public function setDadosProfessor($dados)
    {
        $this->setId($dados['id']);
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
            "id" => $this->getId(),
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
