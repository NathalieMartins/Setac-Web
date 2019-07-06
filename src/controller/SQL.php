<?php

// classe de conexao que herda a classe PDO
class Sql extends MySQLi {

  private $conn;

  public function __construct(){

      // abrindo a conexao ao construir o objeto
      $this->conn = new mysqli("mysql:host=localhost;dbname=dbphp7", "root", "");
  }

  private function setParam($statement, $key, $value){
      // bindParam troca $key pelo $value em $rawQuery
      $statement->bindParam($key, $value);
  }

  private function setParams($statement, $parameters = array()){
    // loop para iterar o array de parâmetros
    foreach ($parameters as $key => $value) {
        $this->setParam($statement, $key, $value);
    }
  }

  public function query($rawQuery, $params = array()){
      // a função prepare retorna a interface statement preparada (permite executar instruções SQL)
      // a interface pode ser usada várias vezes alterando apenas os parâmetros
      $stmt = $this->conn->prepare($rawQuery);
      $this->setParams($stmt, $params);
      $stmt->execute();
      return $stmt;
  }
  
  public function select($rawQuery, $params = array()):array{
    $stmt = $this->query($rawQuery, $params);
    // :: permite acesso a constantes de uma classe
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}

 ?>
