<?php
    class UsuarioAtividade{
        public $usuario_id;
        public $atividade_id;


        public function __construct($usuario_id,$atividade_id){
            $this->usuario_id = $usuario_id;
            $this->atividade_id = $atividade_id;
        }
            
        public function setUsuario_id($usuario_id)
        {
            $this->usuario_id = $usuario_id;
        }

        public function getUsuario_id()
        {
            return $this->usuario_id;
        }

        public function setAtividade_id($atividade_id)
        {
            $this->atividade_id = $atividade_id;
        }

        public function getAtividade_id()
        {
            return $this->atividade_id;
        }

        public function criarRelacionamento(){
            $conexao = new Connection();

            $result = $conexao->select(
                "SELECT * FROM usuario_has_atividade WHERE usuario_id = :USUARIOID AND atividade_id = :ATIVIDADEID",
                array(
                    ':USUARIOID' => $this->getUsuario_id(),
                    ':ATIVIDADEID' => $this->getAtividade_id()
                )
            );

            if (count($result) == 0) {
                $insert = $conexao->query("INSERT INTO usuario_has_atividade (usuario_id, atividade_id) 
                    VALUES (:USUARIOID, :ATIVIDADEID)", array(
                        ':USUARIOID' => $this->getUsuario_id(),
                        ':ATIVIDADEID' => $this->getAtividade_id()
                    ));
            }else{
                echo  "<script>alert('A atividade já existe!');</script>";
            }
        }

        public function excluirRelacionamento(){
            $conexao = new Connection();

            $result = $conexao->select(
                "SELECT * FROM usuario_has_atividade WHERE usuario_id = :USUARIOID AND atividade_id = :ATIVIDADEID",
                array(
                    ':USUARIOID' => $this->getUsuario_id(),
                    ':ATIVIDADEID' => $this->getAtividade_id()
                )
            );

            if (count($result) != 0) {
                $insert = $conexao->query("DELETE FROM usuario_has_atividade 
                    WHERE usuario_id = :USUARIOID AND atividade_id = :ATIVIDADEID", array(
                        ':USUARIOID' => $this->getUsuario_id(),
                        ':ATIVIDADEID' => $this->getAtividade_id()
                    ));
                $this->setAtividade_id(null);
                $this->setUsuario_id(null);

                echo  "<script>alert('Relação excluida com sucesso!');</script>";
            }else{
                echo  "<script>alert('A atividade não existe!');</script>";
            }
        }
    }
?>