<?php

include_once('../controller/Connection.php');

class Usuario {

  public $id;
  public $login;
  public $senha;
  public $email;
  public $acesso;
  public $nome;
  public $cpf;
  public $telefone;
  
  public function __construct($login = "", $senha = "", $email = "", $acesso = "", $nome = "", $cpf = "", $telefone = "") {
    $this->setLogin($login);
    $this->setSenha($senha);
    $this->setEmail($email);
    $this->setAcesso($acesso);
    $this->setNome($nome);
    $this->setCPF($cpf);
    $this->setTelefone($telefone);
  }
  
  public function getId() {
    return $this->id;
  }
  
  public function setId($id) {
    $this->id = $id;
  }
  
  public function getLogin() {
    return $this->login;
  }
  
  public function setLogin($login) {
    $this->login = $login;
  }
  
  public function getSenha() {
    return $this->senha;
  }
  
  public function setSenha($senha) {
    $this->senha = $senha;
  }
  
  public function getEmail() {
    return $this->email;
  }
  
  public function setEmail($email) {
    $this->email = $email;
  }
  
  public function getAcesso() {
    return $this->acesso;
  }
  
  public function setAcesso($acesso) {
    $this->acesso = $acesso;
  }
  
  public function getNome() {
    return $this->nome;
  }
  
  public function setNome($nome) {
    $this->nome = $nome;
  }
  
  public function getCPF() {
    return $this->cpf;
  }
  
  public function setCPF($cpf) {
    $this->cpf = $cpf;
  }
  
  public function getTelefone() {
    return $this->telefone;
  }
  
  public function setTelefone($telefone) {
    $this->telefone = $telefone;
  }
  
  public function loadById($id) {
    $conexao = new Connection();
    
    $resultts = $conexao->select("SELECT * FROM usuario WHERE user_id = :ID", array(
      ":ID" => $id
    ));
    
    if(count($resultts) > 0) {
      $this->setDados($resultts[0]);
      return $this;
    }
  }
  
  public static function getListOrderByNome() {
    $conexao = new Connection();
    
    $list = $conexao->select("SELECT * FROM usuario ORDER BY nome");
    
    return $list;
  }
  
  public static function searchByLoginOrdened($login) {
    $conexao = new Connection();
    
    $list = $conexao->select("SELECT * FROM usuario WHERE login LIKE :SEARCH ORDER BY login", array(
      ':SEARCH' => "%" . $login . "%"
    ));
    
    return $list;
  }
  
  public function login($login, $senha) {    
    $conexao = new Connection();
    
    //criptografamos a senha
    #password_hash($senha, PASSWORD_DEFAULT);
    
    $result = $conexao->select("SELECT * FROM usuario where login = :LOGIN AND senha = :SENHA", array(
      ":LOGIN" => $login,
      ":SENHA" => $senha
    ));

    if(count($result) > 0) {
      $this->setDados($result[0]);
      return 1;
    }
    else {
      throw new InvalidArgumentException("Login ou senha inválidos", 101);
      return 0;
    }
  }
  
  public function insert() {
    $conexao = new Connection();

    $result = $conexao->select("SELECT * FROM usuario where login = :LOGIN or email = :EMAIL", array(
      ":LOGIN" => $this->getLogin(),
      ":EMAIL" => $this->getEmail()
    ));

    if(count($result) == 0) {
      $insert = $conexao->select("CALL insere_usuario(:LOGIN, :SENHA, :EMAIL, :ACESSO, :NOME, :CPF, :TELEFONE)", array(
        ':LOGIN' => $this->getLogin(),
        ':SENHA' => $this->getSenha(),
        ':EMAIL' => $this->getEmail(),
        ':ACESSO' => $this->getAcesso(),
        ':NOME' => $this->getNome(),
        ':CPF' => $this->getCPF(),
        ':TELEFONE' => $this->getTelefone()
      ));

      if(count($insert) > 0) {
        $this->setDados($insert[0]);
        echo "Usuário cadastrado com sucesso";
        return $this;
      }
    }
    else {
      throw new InvalidArgumentException("Usuário ou email já cadastrados", 102);
    }
  }

  public function update($login, $senha) {
    $conexao = new Connection();

    $result = $conexao->select("SELECT * FROM usuario where login = :LOGIN AND senha = :SENHA", array(
      ":LOGIN" => $login,
      ":SENHA" => $senha
    ));

    if(count($result) == 0) {
      $this->setLogin($login);
      $this->setSenha($senha);

      $conexao->query("UPDATE usuario SET login = :LOGIN, senha = :SENHA WHERE user_id = :ID", array(
        ':LOGIN' => $this->getLogin(),
        ':SENHA' => $this->getSenha(),
        ':ID' => $this->getId()
      ));

      echo "Atualizado com sucesso";
    } else {
      throw new InvalidArgumentException("Usuário ou email já cadastrados", 102);
    }
  }

  public function delete() {
    $conexao = new Connection();
    $conexao->query("DELETE FROM usuario WHERE user_id = :ID", array(
      ':ID' => $this->getId()
    ));

    echo  "<script>alert('Usuário excluído com sucesso!');</script>";
  }

  public function setDados($dados) {
    $this->setId($dados['user_id']);
    $this->setLogin($dados['login']);
    $this->setSenha($dados['senha']);
    $this->setEmail($dados['email']);
    $this->setAcesso($dados['acesso']);
    $this->setNome($dados['nome']);
    $this->setCPF($dados['cpf']);
    $this->setTelefone($dados['telefone']);
  }

  public function __toString() {
    return json_encode(array(
      "user_id" => $this->getId(),
      "login" => $this->getLogin(),
      "senha" => $this->getSenha(),
      "email" => $this->getEmail(),
      "acesso" => $this->getAcesso(),
      "nome" => $this->getNome(),
      "cpf" => $this->getCPF(),
      "telefone" => $this->getTelefone()));
  }
}

?>