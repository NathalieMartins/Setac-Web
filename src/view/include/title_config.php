<?php
  switch ($_SERVER["SCRIPT_NAME"]) {
    case "/Setac-Web/src/pages/acesso/login.php":
      $TITULO_PAGINA = "SeTAC² > Login";
      break;
    case "/Setac-Web/src/pages/acesso/cadastro.php":
      $TITULO_PAGINA = "SeTAC² > Cadastro";
      break;
    default:
      $TITULO_PAGINA = "SeTAC² - Semana Tecnológica Acadêmica de Ciência da Computação";
  }
?>