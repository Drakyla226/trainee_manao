<?php $title_name="Авторизация" ?>
<?php require ($_SERVER[DOCUMENT_ROOT]."/core/header.php") ?>
<?php if (isset($_SESSION['username'])){
  header('Location: /');
  exit();}?>
  <div class="block_auth">
    <div class="main_auth">
      <h1>АВТОРИЗАЦИЯ</h1>
      <?php
          if (isset($_POST['Login']) and isset($_POST['Password'])){
            $login = $_POST['Login'];
            $password = $_POST['Password'];

            $j_data = file_get_contents($j_db);
            $j_array = json_decode($j_data, true);

            foreach ($j_array as $key => $value) {
              if ($value["login"] == $login){
                if (password_verify($password, $value["password"])){
                    $count = 1;
                    $error_pass = 1;
                }
                $error_login = 1;
              }
            }

            if ($count == 1){
              $_SESSION['username'] = $login;}
            elseif ($error_login !== 1){echo "<div class='user_auth'>!! Данного пользователя не существует !!</div>";}
            elseif ($error_pass !== 1){echo "<div class='user_auth'>!! Неверный пароль !!</div>";}
            if (isset($_SESSION['username'])){
              $_SESSION["username"] = $login;
              header("Location: /");
              exit();}
        }
      ?>
      <form class="form_auth" method="POST">
        <input class="br_auth" type="text" placeholder="Логин" name="Login" required> <br>
        <input class="br_auth" type="password" placeholder="Пароль" name="Password" required> <br>
        <button class="but_" id="auth_" type="submit" name="Auth">Войти</button>
      </form>
      <button class="but_" id="reg_" name="Register"><a class="a_reg" href="/registration">Зарегистрироваться</a></button>

    </div>
  </div>

<?php require ($_SERVER[DOCUMENT_ROOT]."/core/footer.php") ?>
