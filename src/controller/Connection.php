<?php

class Connection extends PDO {
  private $conexao;

  public function __construct() {
    $host = "mysql:host=localhost;dbname=setac";
    $user = "root";
    $pass = "";

    $this->conexao = new PDO($host, $user, $pass);
  }

  private function setParam($statement, $key, $value) {
        // bindParam troca $key pelo $value em $rawQuery
    $statement->bindParam($key, $value);
  }

  private function setParams($statement, $parameters = array()) {
        // loop para iterar o array de parâmetros
    foreach ($parameters as $key => $value) {
      $this->setParam($statement, $key, $value);
    }
  }

  public function query($rawQuery, $params = array()) {
        // a função prepare retorna a interface statement preparada (permite executar instruções SQL)
        // a interface pode ser usada várias vezes alterando apenas os parâmetros
    $stmt = $this->conexao->prepare($rawQuery);
    $this->setParams($stmt, $params);
    $stmt->execute();
    return $stmt;
  }

  public function select($rawQuery, $params = array()): array {
    $stmt = $this->query($rawQuery, $params);
        // :: permite acesso a constantes de uma classe
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
?>