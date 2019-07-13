<?php

class Estudante extends Usuario
{
    private $registroAcademico;


    public function __construct($registroAcademico = "")
    {
        $this->setRegistroAcademico($registroAcademico);
    }

    public function getRegistroAcademico()
    {
        return $this->registroAcademico;
    }

    public function setRegistroAcademico($registroAcademico)
    {
        $this->$registroAcademico = $registroAcademico;
    }

    public function loadByRegistroAcademico($registroAcademico)
    {

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM aluno WHERE registroAcademico = :REGISTROACADEMICO", array(
            ":REGISTROACADEMICO" => $registroAcademico
        ));

        if (count($results) > 0) {
            $this->setDados($results[0]);
        }
    }

    public static function getList()
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM aluno");
    }

    public static function search($registroAcademico)
    {

        $sql = new Sql();

        return $sql->select(
            "SELECT * FROM aluno :SEARCH",
            array(
                ':SEARCH' => "%" . $registroAcademico . "%"
            )
        );
    }

    public function insert()
    {

        $sql = new Sql();

        $results = $sql->select("CALL sp_estudante_insert(:REGISTROACADEMICO)", array(
            ':REGISTROACADEMICO' => $this->getRegistroAcademico()
        ));

        if (count($results) > 0) {
            $this->setDados($results[0]);
        }
    }

    public function update($registroAcademico)
    {

        $this->setDeslogin($registroAcademico);


        $sql = new Sql();
        $sql->query("UPDATE aluno SET resgitroAcademico = :REGISTROACADEMICO WHERE idusuario = :ID ", array(
            ':REGISTROACADEMICO' => $this->getRegistroAcademico(),

        ));
    }

    public function delete()
    {
        $sql = new Sql();
        $sql->query("DELETE FROM aluno WHERE idusuario = :ID", array(
            ':ID' => $this->getRegistroAcademico()
        ));

        $this->setRegistroAcademico(0);
    }

    public function setDados($dados)
    {
        $this->setAlunos($dados['registroAcademico']);
    }

    public function __toString()
    {
        return json_encode(array(
            "registroAcademico" => $this->getRegistroAcademico(),

        ));
    }
}
}
