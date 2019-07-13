<?php include("../../view/include/title_config.php");?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <?php
      include_once "../../view/include/head_tags.php"
    ?>

    <link rel="stylesheet" type="text/css" href="/Setac-Web/src/view/css/login.css">
  </head>

  <body>

    <?php include_once "../../view/include/navigation.php" ?>

    <br>
    <div class="container">
      <div class="columns is-vcentered">
        <div class="column">
          <h1 class="title is-1">Login</h1>
          <p>
            Faça login com sua conta da SeTAC² e acesse todas as informações sobre a edição atual do evento!
          </p>
        </div>
        <div class="column">
          <div class="box">
            <div class="logo-setac">
              <img src="/Setac-Web/src/view/img/logo.png" alt="Logo da SeTAC²">
            </div>
            <form class="form" action="../../controller/Authentication.php" method="post">
              <div class="field">
                <label for="usuario" class="label">Usuário</label>
                <div class="control">
                  <input type="text" name="usuario" class="input" required>
                </div>
              </div>
              <div class="field">
                <label for="senha" class="label">Senha</label>
                <div class="control">
                  <input type="password" name="senha" class="input" required>
                </div>
              </div>
              <div class="field is-grouped">
                <div class="control">
                  <input type="submit" value="Entrar" class="button">
                </div>
                <div class="control">
                  <a href="" class="button is-text">Recuperar dados</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


    <!-- <div class="container">
      <div class="tile is-ancestor notification">

        <div class="tile is-parent">
          <div class="tile is-child">
            <h1 class="title is-1">Login</h1>
            <p>
              Faça login com sua conta da SeTAC² e acesse todas as informações sobre a edição atual do evento!
            </p>
          </div>
        </div>

        <div class="tile is-parent">
          <div class="tile is-child box">
            <div class="logo-setac">
              <img src="/Setac-Web/src/view/img/logo.png" alt="Logo da SeTAC²">
            </div>
            <form class="form" action="" method="post">
              <div class="field">
                <label for="usuario" class="label">Usuário</label>
                <div class="control">
                  <input type="text" name="usuario" class="input">
                </div>
              </div>
              <div class="field">
                <label for="senha" class="label">Senha</label>
                <div class="control">
                  <input type="password" name="senha" class="input">
                </div>
              </div>
              <div class="field">
                <input type="submit" value="Entrar" class="button">
              </div>
            </form>
          </div>
        </div>

      </div>
    </div> -->

    <script src="/Setac-Web/src/view/js/navbar.js"></script>
  </body>
</html>