<?php

class Professor extends Usuario
{
    private $siape;
    private $qualificacao;
    private $area;

    public function __construct($siape,$qualificacao,$area)
    {
        $this->setSiape($siape);
        $this->setQualificacao($qualificacao);
        $this->setArea($area);
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

    public function loadByProfessor($siape,$qualificacao,$area)
    {
        $conexao = new Connection();

        $results = $conexao->select("SELECT * FROM professor WHERE siape = :SIAPE, qualificacao = :QUALIFICACAO, area = :AREA", array(
            ":SIAPE" => $siape,
            ":QUALIFICACAO" => $qualificacao,
            ":AREA" => $area
        ));

        if (count($results) > 0) {
            $this->setDados($results[0]);
            return $this;
        }
    }

    public function insert()
    {
        $conexao = new Connection();

        $resul = $conexao->select(
            "SELECT * FROM professor where siape = :SIAPE, qualificacao = :QUALIFICACAO,
             area = :AREA",
            array(
                ':SIAPE' => $this->getSiape(),
                ':QUALIFICACAO' => $this->getQualificacao(),
                ':AREA' => $this->getAcesso()
            )
        );


        if (count($resul) == 0) {

            $insert = $conexao->select(
                " CALL insere_usuario(:SIAPE, :QUALIFICACAO, :AREA)",
                array(
                    ':SIAPE' => $this->getSiape(),
                    ':QUALIFICACAO' => $this->getQualificacao(),
                    ':AREA' => $this->getAcesso()
                )
            );

            if (count($insert) > 0) {

                $this->setDados($insert[0]);
                echo "Professor(a) cadastrado com sucesso";

                return $this;
            }
        } else {

            throw new Exception("Este professor já possui cadastro!");
        }
    }

    public function update($siape, $qualificacao, $area)
    {

        $conexao = new Connection();

        $resul = $conexao->select(
            "SELECT * FROM professor where siape = :SIAPE, :QUALIFICACAO,:AREA = :SENHA",
            array(
                ":SIAPE" => $siape,
                ":QUALIFICACAO" => $qualificacao,
                ":AREA" => $this->$area
            )
        );

        if (count($resul) == 0) {

            $this->setSiape($siape);
            $this->setQualificacao($qualificacao);
            $this->setArea($area);

            $conexao->query(
                "UPDATE professor SET 
                qualificacao = :QUALIFICACAO , area = :AREA,
                WHERE siape = :SIAPE",
                array(
                    ":QUALIFICACAO" => $this->getQualificacao(),
                    ":AREA" => $this->getArea(),
                    ":SIAPE" => $this->getSiape()
                )
            );

            echo "Atualizado com sucesso";
        } else {

            throw new Exception("Professor e seus dados atualizados");
        }
    }

    public function delete()
    {
        $conexao = new Connection();

        $conexao->query("DELETE FROM professor WHERE siape = :SIAPE", array(
            ':SIAPE' => $this->getSiape()
        ));
    }

    public function setDados($dados)
    {

        $this->setSiape($dados['siape']),
        $this->setQualificacao(($dados['qualificacao']),
        $this->setArea($dados['area'])
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
