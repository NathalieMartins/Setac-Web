<?php
    class Usuario {
        public $id;
        public $login;
        public $senha;
        public $email;
        public $acesso;
        public $nome;
        public $cpf;
        public $telefone;

        /*function __construct($login, $senha, $email, $acesso, $nome, $cpf, $telefone){
            $this->setLogin($login);
            $this->setSenha($senha);
            $this->setEmail($email);
            $this->setAcesso($acesso);
            $this->setNome($nome);
            $this->setCPF($cpf);
            $this->setTelefone($telefone);
        }*/

        function __construct(){

        }

        public function getId(){
        	return $this->$id;
        }

        public function setId($id){
        	$this->$id = $id;
        }

        public function getLogin(){
            return $this->login;
        }

        public function setLogin($login){
            $this->$login = $login;
        }

        public function getSenha(){
        	return $this->senha;
        }

        public function setSenha($senha){
        	$this->$senha = $senha;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setEmail($email){
            $this->$email = $email;
        }

        public function getAcesso(){
        	return $this->$acesso;
        }

        public function setAcesso($acesso){
            $this->$acesso = $acesso;
        }

        public function getNome(){
        	return $this->$nome;
        }

		public function setNome($nome){
			$this->$nome = $nome;
		}
	  
		public function getCPF(){
        	return $this->$cpf;
        }

		public function setCPF($cpf){
			$this->$cpf = $cpf;
		}

		public function getTelefone(){
        	return $this->$telefone;
        }

		public function setTelefone($telefone){
			$this->$cpf = $telefone;
		}

        
        public function loadById($id){

            $conexao = new Connection();
        
            $results = $conexao->select("SELECT * FROM usuario WHERE id = :id", array(
				":id"=>$id
			));
        
            if(count($results) > 0){
				echo "DEU CERTO";
				$this->setDados($results[0]);
				return $this;
            }
        
          }
        
          public static function getListOrderByNome(){
            $conexao = new Connection();
        
            return $conexao->select("SELECT * FROM usuario ORDER BY nome");
          }
        
          public static function search($login){
        
            $conexao = new Connection();
        
            return $conexao->select("SELECT * FROM usuario WHERE login LIKE :SEARCH ORDER BY login",
			array(
			  ':SEARCH'=>"%" . $login . "%"
			));
        
          }
        
          public function login($login, $senha){
        
            $conexao = new Connection();
        
            $results = $conexao->select("SELECT * FROM usuario WHERE login = :LOGIN AND senha = :SENHA", array(
				":LOGIN"=>$login,
				":SENHA"=>$senha
			  ));
        
            if(count($results) > 0){
        
            	$this->setDados($results[0]);
        
            }else{

				throw new Exception("Login ou Senha Inválidos!");

            }
        
          }
        
          public function insert(){
        
            $conexao = new Connection();
        
            $results = $conexao->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
              ':LOGIN'=>$this->getLogin(),
              ':SENHA'=>$this->getSenha()
            ));
        
            if(count($results) > 0){
              $this->setDados($results[0]);
            }
        
          }
        
          public function update($login, $senha){
        
            $this->setDeslogin($login);
            $this->setDessenha($senha);
        
            $conexao = new Connection();
            $conexao->query("UPDATE db_usuarios SET deslogin = :LOGIN, dessenha = :SENHA WHERE idusuario = :ID", array(
              ':ID'=>$this->getIdusuario(),
              ':LOGIN'=>$this->getDeslogin(),
              ':SENHA'=>$this->getDessenha()
            ));
          }
        
          public function delete(){
            $conexao = new Connection();
            $conexao->query("DELETE FROM db_usuarios WHERE idusuario = :ID", array(
              ':ID'=>$this->getIdusuario()
            ));
        
            $this->setIdusuario(0);
            $this->setDeslogin("");
            $this->setDessenha("");
            $this->setDtcadastro(new DateTime());
        
          }
        
          public function setDados($dados){
        
            $this->setId($dados['id']);
            $this->setLogin($dados['login']);
            $this->setSenha($dados['senha']);
            $this->setEmail($dados['email']);
			$this->setAcesso($dados['acesso']);
			$this->setNome($dados['nome']);
			$this->setCPF($dados['cpf']);
			$this->setTelefone($dados['telefone']);
        
          }
        
          public function __toString(){
            return json_encode(array(
                "id"=>$this->getId(),
                "login"=>$this->getLogin(),
                "senha"=>$this->getSenha(),
                "email"=>$this->getEmail(),
				"acesso"=>$this->getAcesso(),
				"nome"=>$this->getNome(),
				"cpf"=>$this->getCPF(),
				"telefone"=>$this->getTelefone()
            ));
          }

    }
?>
