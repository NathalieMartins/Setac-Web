<?php

class Professor extends Usuario
{
    private $siape;
    private $qualificacao;
    private $area;

    public function __construct()
    { }

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



    
    public function setDados($dados)
    {

        $this->setSiape($dados['siape']);
        $this->setQualificacao(($dados['qualificacao']);
        $this->setArea($dados['area']);
       
    }

    public function __toString()
    {
        return json_encode(array(
            "siape" => $this->getSiape(),
            "qualificacao" => $this->getQualificacao(),
            "area" => $this->getArea(),
    
        ));
    }
}
?>