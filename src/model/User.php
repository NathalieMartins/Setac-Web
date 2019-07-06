<?php
    class User {
        private $id
        private $login
        private $password
        private $email
        private $access

        function __construct($login, $password, $email, $access){
            $this->setLogin($login);
            $this->setPassword($password);
            $this->setEmail($email);
            $this->setAccess($access);
        }

        function __construct(){

        }

        public function getId(){
            return $this->$id
        }

        public function setId($id){
            $this->$id = $id
        }

        public function getLogin(){
            return $this->login
        }

        public function setLogin($login){
            $this->$login = $login
        }

        public function getEmail(){
            return $this->email
        }

        public function setEmail($email){
            $this->$email = $email
        }

        public function getPassword(){
            return $this->$password
        }

        public function setPassword($password){
            $this->$password = $password
        }

        public function getAccess(){
            return $this->$access
        }

        public function setAccess($access){
            $this->$access = $access
        }
        
        public function loadById($id){

            $conexao = new Connection();
        
            $results = $conexao->select("SELECT * FROM user WHERE id = :ID", array(
              ":ID"=>$id
            ));
        
            if(count($results) > 0){
              $this->setDados($results[0]);
            }
        
          }
        
          public static function getList(){
            $sql = new Connection();
        
            return $sql->select("SELECT * FROM user ORDER BY deslogin;");
          }
        
          public static function search($login){
        
            $sql = new Sql();
        
            return $sql->select("SELECT * FROM user WHERE deslogin LIKE :SEARCH ORDER BY deslogin",
            array(
              ':SEARCH'=>"%" . $login . "%"
            ));
        
          }
        
          public function login($login, $senha){
        
            $sql = new Sql();
        
            $results = $sql->select("SELECT * FROM user WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(
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
        
            $sql = new Sql();
        
            $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
              ':LOGIN'=>$this->getDeslogin(),
              ':SENHA'=>$this->getDessenha()
            ));
        
            if(count($results) > 0){
              $this->setDados($results[0]);
            }
        
          }
        
          public function update($login, $senha){
        
            $this->setDeslogin($login);
            $this->setDessenha($senha);
        
            $sql = new Sql();
            $sql->query("UPDATE db_usuarios SET deslogin = :LOGIN, dessenha = :SENHA WHERE idusuario = :ID", array(
              ':ID'=>$this->getIdusuario(),
              ':LOGIN'=>$this->getDeslogin(),
              ':SENHA'=>$this->getDessenha()
            ));
          }
        
          public function delete(){
            $sql = new Sql();
            $sql->query("DELETE FROM db_usuarios WHERE idusuario = :ID", array(
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
            $this->setPassword($dados['password']);
            $this->setEmail($dados['email']);
            $this->setAccess($dados['access']);
        
          }
        
          public function __toString(){
            return json_encode(array(
                "id"=>$this->getId(),
                "login"=>$this->getLogin(),
                "password"=>$this->getPassword(),
                "email"=>$this->getEmail(),
                "access"=>$this->getAccess()
            ));
          }

    }
?>
