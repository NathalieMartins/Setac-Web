<?php
require_once("UsuarioAtividade.php");
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



    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
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
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setCargaHoraria($cargaHoraria)
    {
        $this->cargaHoraria = $cargaHoraria;
    }

    public function getCargaHoraria()
    {
        return $this->cargaHoraria;
    }


    public function setMinistrador($ministrador)
    {
        $this->ministrador = $ministrador;
    }

    public function getMinistrador()
    {
        return $this->ministrador;
    }

    public function loadByAtividade($id, $titulo, $descricao, $limiteInscricao, $lugar, $status, $cargaHoraria, $ministrador, $email)
    {
        $conexao = new Connection();

        $results = $conexao->select("SELECT * FROM atividade WHERE
         id = :ID, titulo = :TITULO, descricao = :DESCRICAO, limiteInscricao = :LIMITEINSCRICAO, 
         lugar = :LUGAR, `status` = `:STATUS`, cargaHoraria = :CARGAHORARIA, ministrador = :MINISTRADOR, email = EMAIL", array(
            ':ID' => $id,
            ':TITULO' => $titulo,
            ':DESCRICAO' => $descricao,
            ':LIMITEINSCRICAO' => $limiteInscricao,
            ':LUGAR' => $this->$lugar,
            ':STATUS' => $this->$status,
            ':CARGAHORARIA' => $this->$cargaHoraria,
            ':MINISTRADOR' => $this->$ministrador,
            ':EMAIL' => $this->$email

        ));

        if (count($results) > 0) {
            $this->setDados($results[0]);
            return $this;
        }
    }

    public function insertAtividade($userId)
    {
        $conexao = new Connection();

        $resul = $conexao->select(
            "SELECT * FROM atividade where titulo = :TITULO",
            array(
                ':TITULO' => $this->getTitulo()
            )
        );

        if (count($resul) == 0) {

            $insertAtividade = $conexao->select(
                "CALL insere_atividade(:TITULO, :DESCRICAO, :LIMITEINSCRICAO, :LUGAR, 
                :STATUS, :CARGAHORARIA,:MINISTRADOR, :EMAIL)",
                array(
                    ':TITULO' => $this->getTitulo(),
                    ':DESCRICAO' => $this->getDescricao(),
                    ':LIMITEINSCRICAO' => $this->getlimiteInsricao(),
                    ':LUGAR' => $this->getLugar(),
                    ':STATUS' => $this->getStatus(),
                    ':CARGAHORARIA' => $this->getCargaHoraria(),
                    ':MINISTRADOR' => $this->getministrador(),
                    ':EMAIL' => $this->getEmail()
                )
            );

            if (count($insertAtividade) > 0) {
                echo  "<script>alert('Atividade cadastrada com sucesso!');</script>";
                $this->setDadosAtividade($insertAtividade[0]);

                $relacionamento = new UsuarioAtividade($userId, $this->getId());
                $relacionamento->criarRelacionamento();

                return $this;
            }
        } else {

            throw new Exception("Esta atividade já possui cadastro!");
        }
    }


    public function updateAtividade($descricao, $limiteInscricao, $lugar, $status, $cargaHoraria, $ministrador, $email)
    {
        $this->setDescricao($descricao);
        $this->setLugar($lugar);
        $this->setlimiteInscricao($limiteInscricao);
        $this->setStatus($status);
        $this->setCargaHoraria($cargaHoraria);
        $this->setMinistrador($ministrador);
        $this->setEmail($email);

        $conexao = new Connection();

        $conexao->query("UPDATE atividade SET descricao = :DESCRICAO, limiteInscricao = :LIMITEINSCRICAO,
         lugar = :LUGAR, status = :STATUS , cargaHoraria = :CARGAHORARIA, ministrador = :MINISTRADOR, emailMinistrador = :EMAIL WHERE titulo = :TITULO",
         array(
            ':TITULO' => $this->getTitulo(),
            ':DESCRICAO' => $this->getDescricao(),
            ':LIMITEINSCRICAO' => $this->getlimiteInsricao(),
            ':LUGAR' => $this->getLugar(),
            ':STATUS' => $this->getStatus(),
            ':CARGAHORARIA' => $this->getCargaHoraria(),    
            ':MINISTRADOR' => $this->getministrador(),
            ':EMAIL' => $this->getEmail()

        ));
        
        echo  "<script>alert('Professor atualizado com sucesso!');</script>";
    }

    public function deleteAtividade($atividadeId, $userId)
    {
        $conexao = new Connection();

        $relacionamento = new UsuarioAtividade($userId, $atividadeId);
        $relacionamento->excluirRelacionamento();

        $conexao->query("DELETE FROM atividade WHERE atividade_id = :ID", array(
            ':ID' => $atividadeId
        ));

        $this->setId(0);
        echo  "<script>alert('Atividade excluído com sucesso!');</script>";
    }


    public function setDadosAtividade($dados)
    {
        $this->setId($dados['atividade_id']);
        $this->setTitulo($dados['titulo']);
        $this->setDescricao($dados['descricao']);
        $this->setlimiteInscricao($dados['limiteInscricao']);
        $this->setLugar($dados['lugar']);
        $this->setStatus($dados['status']); 
        $this->setCargaHoraria($dados['cargaHoraria']);
        $this->setMinistrador($dados['ministrador']);
        $this->setEmail($dados['emailMinistrador']);
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
            "minstrador" => $this->getMinistrador(),
            "email" => $this->getEmail()

        ));
    }

    public function listarAtividadePorAlunoRA($registro_academico){
        $conexao = new Connection();

        $resul = $conexao->select(
            "SELECT av.* FROM atividade av
            JOIN usuario_has_atividade ua ON ua.atividade_id = av.atividade_id
            JOIN usuario us ON us.user_id = ua.usuario_id
            JOIN aluno al ON al.usuario_id = us.user_id
            WHERE al.registroAcademico = :REGISTROACADEMICO", array(
                ':REGISTROACADEMICO' => $registro_academico
        ));

        if(count($resul) > 0){
            echo "Retorno <br>###############################<br>";
            print_r($resul);
            echo "Retorno <br>###############################<br>";
        }else{
            echo  "<script>alert('O aluno não possui nenhuma atividade!');</script>";
        }
    }

    public function listarAtividadePorProfessorSiape($siape){
        $conexao = new Connection();

        $resul = $conexao->select(
            "SELECT av.* FROM atividade av
            JOIN usuario_has_atividade ua ON ua.atividade_id = av.atividade_id
            JOIN usuario us ON us.user_id = ua.usuario_id
            JOIN professor ps ON ps.usuario_id = us.user_id
            WHERE ps.siape = :SIAPE", array(
                ':SIAPE' => $siape
        ));

        if(count($resul) > 0){
            echo "Retorno <br>###############################<br>";
            print_r($resul);
            echo "Retorno <br>###############################<br>";
        }else{
            echo  "<script>alert('O professor não possui nenhuma atividade!');</script>";
        }
    }
}
