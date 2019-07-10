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

    public function __construct()
    { }

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



    public function setDados($dados)
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
