<?php

include_once('../controller/Session.php');
include_once('../model/Usuario.php');
include_once('../model/Estudante.php');
include_once('../model/Professor.php');

if(empty($_POST)) {
  header("Location: ../login.php");
}

$dados = $_POST;

$result = Usuario::searchByLoginOrdened($dados["usuario"]);

if(!empty($result)) {
  setcookie("usuario", serialize($dados), time()+2, "/"); 
  setcookie("usuario_indisponivel", "Nome de usuário indisponível", time()+2, "/");
  header("Location: " . $_SERVER["HTTP_REFERER"]);
}

switch((int) $dados["tipo"]) {
  case 1:
    $usuario = new Estudante($dados["usuario"], $dados["senha"], $dados["email"], (int) $dados["tipo"], $dados["nome"], $dados["cpf"], $dados["telefone"]);
    $usuario->insertEstudante();
    break;
  case 2:
    $usuario = new Professor($dados["usuario"], $dados["senha"], $dados["email"], (int) $dados["tipo"], $dados["nome"], $dados["cpf"], $dados["telefone"]);
    $usuario->insertProfessor();
    break;
}



try {
  $usuario->login($usuario->getLogin(), $usuario->getSenha());
}
catch (InvalidArgumentException $e) {
  session_destroy();

  if($e->getCode() == 101) {
    header("Location: ../erro/101.php");
  }
  if($e->getCode() == 102) {
    header("Location: ../erro/102.php");
  }

  exit();
}
catch (PDOException $e) {
  session_destroy();
  header("Location: ../erro/201.php");
  exit();
}


$_SESSION['usuario'] = serialize($usuario);
header("Location: ../painel/");
exit();


?>