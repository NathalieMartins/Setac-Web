<?php

    class Connection extends MySQLi {

        private $conexao;

        public function __construct(){
            $host="localhost";
            $bd="setac";
            $user="root";
            $pass="";

            $this->conexao = new mysqli($host, $user, $pass, $bd);

            if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit(1);
            }
        }

        private function setParam($statement, $key, $value){
            // bindParam troca $key pelo $value em $rawQuery
            #echo $statement." : ".$key." : ".$value;
            $statement->bind_param($key, $value);
        }

        private function setParams($statement, $parameters = array()){
            // loop para iterar o array de parâmetros
            foreach ($parameters as $key => $value){
                $this->setParam($statement, $key, $value);
                #echo $parameters." - ".$key." - ".$value;
            }
        }

        public function query($rawQuery, $params = array()){
            // a função prepare retorna a interface statement preparada (permite executar instruções SQL)
            // a interface pode ser usada várias vezes alterando apenas os parâmetros
            #echo get_class($this->conexao);
            #echo "<br>";
            echo $rawQuery;
            echo "<br>";
            echo get_class($this->conexao);
            echo "<br>";
            if($stmt = $this->conexao->prepare($rawQuery)){
                #echo gettype($stmt);
                #echo get_class($stmt);
                echo "DEU CERTO";
                /*$this->setParams($stmt, $params);
                $stmt->execute();
                return $stmt;*/
            }else{
                echo "DEU BOSTA";
            }
        }

        public function select($rawQuery, $params = array()){
            $stmt = $this->query($rawQuery, $params);
            // :: permite acesso a constantes de uma classe
            #return $stmt->fetch_assoc();
        }

    }
?>