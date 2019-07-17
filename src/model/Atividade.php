<?php
class Atividade
{
    public $id;
    public $titulo;
    public $descricao;
    public $limiteInscricao;
    public $lugar;
    public $status;
    public $cargaHoraria;
    public $ministrador;
    public $email;

    public function __construct($titulo = "", $descricao = "", $limiteInscricao = "", $lugar = "", $status = "", $cargaHoraria = "", $ministrador = "", $email = "")
    {
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->limiteInscricao = $limiteInscricao;
        $this->lugar = $lugar;
        $this->status = $status;
        $this->cargaHoraria = $cargaHoraria;
        $this->ministrador = $ministrador;
        $this->email = $email;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setlimiteInscricao($limiteInscricao)
    {
        $this->limiteInscricao = $limiteInscricao;
    }

    public function getlimiteInsricao()
    {
        return $this->limiteInscricao;
    }

    public function setLugar($lugar)
    {
        $this->lugar = $lugar;
    }

    public function getLugar()
    {
        return $this->lugar;
    }

    public function setStatus($status)
    {
        this->status = $status;
    }

    public function getStatus()
    {
        return this->status;
    }

    public function setCargaHoraria($cargaHoraria)
    {
        this->cargaHoraria = $cargaHoraria;
    }

    public function getCargaHoraria()
    {
        return this->cargaHoraria;
    }

    public function loadByAtividade($id, $titulo, $descricao, $limiteInscricao, $lugar, $status, $cargaHoraria)
    {
        $conexao = new Connection();

        $results = $conexao->select("SELECT * FROM professor WHERE
         id = :ID, titulo = :TITULO, descricao = :DESCRICAO, limiteInscricao = :LIMITEINSCRICAO, lugar = :LUGAR, `status` = `:STATUS`, cargaHoraria = :CARGAHORARIA", array(
            ':ID' => $id,
            ':TITULO' => $titulo,
            ':DESCRICAO' => $descricao,
            ':LIMITEINSCRICAO' => $limiteInscricao,
            ':LUGAR' => $this->$lugar,
            ':STATUS' => $this->$status,
            ':CARGAHORARIA' => $this->$cargaHoraria
        ));

        if (count($results) > 0) {
            $this->setDados($results[0]);
            return $this;
        }
    }

    public function insertAtividade()
    {
        $conexao = new Connection();

        $resul = $conexao->select(
            "SELECT * FROM atividade where id = :ID",
            array(
                ':ID' => $this->getId()
            )
        );

        if (count($resul) == 0) {

            $this->insert();

            $insertAtividade = $conexao->select(

                "CALL sp_atividades_insert(:ID, :TITULO, :DESCRICAO, :LIMITEINSCRICAO, :LUGAR, :STATUS, :CARGAHORARIA)",
            array(
                ':ID' => $this->getId(),
                ':TITULO' => $this->getTitulo(),
                ':DESCRICAO' => $this->getTitulo(),
                ':LIMITEINSCRICAO' => $this->getTitulo(),
                ':LUGAR' => $this->getTitulo(),
                ':STATUS' => $this->getTitulo(),
                ':CARGAHORARIA' => $this->getTitulo()
            ));

            if (count($insertAtividade) > 0) {
                echo  "<script>alert('Atividade cadastrada com sucesso!');</script>";
                $this->setDadosAtividade($insertAtividade[0]);

                return $this;
            }
        } else {

            throw new Exception("Esta atividade já possui cadastro!");
        }
    }


    public function updateAtividade($titulo, $descricao,$limiteInscricao,$lugar,$status,$cargaHoraria)
    {
        $this->setTitulo($titulo);
        $this->setDescricao($descricao);
        $this->setLugar($lugar);
        $this->setlimiteInscricao($limiteInscricao);
        $this->setStatus($status);
        $this->setCargaHoraria($cargaHoraria);

        $conexao = new Connection();

        $conexao->query("UPDATE atividade SET titulo = :TITULO, descricao = :DESCRICAO, limieteInscricao = :LIMITEINSCRICAO, lugar = :LUGAR, `status` = :`STATUS ` WHERE idusuario = :ID", array(
            ':ID' => $this->getId(),
            ':TITULO' => $this->getTitulo(),
            ':DESCRICAO' => $this->getTitulo(),
            ':LIMITEINSCRICAO' => $this->getTitulo(),
            ':LUGAR' => $this->getTitulo(),
            ':STATUS' => $this->getTitulo(),
            ':CARGAHORARIA' => $this->getTitulo()
        ));
    }

    public function deleteAtividade()
    {
        $conexao = new Connection();

        $conexao->query("DELETE FROM atividade WHERE id = :ID", array(
            ':ID' => $this->getId()
        ));

        $this->setId(0);
    }


    public function setDadosAtividade($dados)
    {
        $this->setId($dados['id']);
        $this->setTitulo(($dados['titulo']);
        $this->setDescricao($dados['descricao']);
        $this->setlimiteInscricao($dados['limiteInscricao']);
        $this->setLugar($dados['lugar']);
        $this->setStatus($dados['status']);
        $this->setCargaHoraria($dados['cargaHoraria']);
    }

    public function __toString()
    {
        return json_encode(array(
            "id" => $this->getId(),
            "titulo" => $this->getTitulo(),
            "descricao" => $this->getDescricao(),
            "limiteInscricao" => $this->getlimiteInsricao(),
            "lugar" => $this->getLugar(),
            "status" => $this->getStatus(),
            "cargaHoraria" => $this->getCargaHoraria(),

        ));
    }
}
