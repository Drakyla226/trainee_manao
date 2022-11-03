<?php $title_name = "Регистрация"?>
<?php require ($_SERVER[DOCUMENT_ROOT]."/core/header.php");?>

        <?php
          if($_POST['js_form'] == "no"){
            $js_ = 1;
          }else{
            if (isset($_POST['Login']) and isset($_POST['Password']) and isset($_POST['Password2']) and isset($_POST['Email']) and isset($_POST['Name'])){
              $login = $_POST['Login'];
              $password = $_POST['Password'];
              $password2 = $_POST['Password2'];
              $email = $_POST['Email'];
              $name = $_POST['Name'];

              $j_data = file_get_contents($j_db);
              $j_array = json_decode($j_data, true);
              $res_reg = "login+email";
              $num = 0;

              if($password != $password2){
                  $res_reg = "pass";
              }
              else{
                if($j_array !== NULL){
                  foreach ($j_array as $key => $value) {
                    if ($value["login"] == $login or $value["email"] == $email){
                      $num = $num + 1;
                    }
                  }
                  if ($num == 0){
                    $res_reg = "ok";
                  }
                }
                if ($res_reg == "ok"){
                  $arr_filds = array(
                                     "login" => $login,
                                     "password" => password_hash($password, PASSWORD_DEFAULT),
                                     "email" => $email,
                                     "name" => $name);
                  $j_array[] = $arr_filds;
                  $add_arr = json_encode($j_array, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                  file_put_contents($j_db, $add_arr);
                }
                if($j_array == NULL){
                  $arr_filds = array(
                                     "login" => $login,
                                     "password" => password_hash($password, PASSWORD_DEFAULT),
                                     "email" => $email,
                                     "name" => $name);
                  $j_array[] = $arr_filds;
                  $add_arr = json_encode($j_array, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
                  if (file_put_contents($j_db, $add_arr)){
                    $res_reg = "ok";
                  }
                }

              }
            }
          }
        ?>

<div class="block_auth">
    <div class="main_auth">
      <?php if ($js_ == 1) { echo "<div class='js_'>!! Для отправки данных включите JavaScript в настройках вашего браузера !!</div>";}?>
        <h1>РЕГИСТРАЦИЯ</h1>
        <pre>Все поля обязательны</pre>
        <form class="form_auth" method="POST" >
          <NOSCRIPT><input type='hidden' name='js_form' value='no'></NOSCRIPT>
          <input value="<?php if ($res_reg == "pass" or $res_reg == "email") {echo $login;}?>"
                        class="br_auth" type="text" title="Минимум 6 символов и состоять из букв или цифр. Без пробелов." placeholder="Логин" name="Login" required pattern="[а-яА-Яa-zA-Z0-9\S]{6,}"> <br>

          <input class="br_auth" type="password" title="Минимум 6 символов и обязательно состоять из букв и цифр. Без пробелов." placeholder="Пароль" name="Password" required pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[a-zA-Z])(?!.*\s).*$"> <br>
          <input class="br_auth" type="password" title="Поле долэно совпадать с паролем." placeholder="Подтверждение пароля" name="Password2" required> <br>

          <input value="<?php if ($res_reg == "pass" or $res_reg == "login") {echo $email;}?>"
                        class="br_auth" title="К примеру: email@mail.ru" placeholder="Email" name="Email" required pattern="[\d\w]{1,}@\w{1,}\.\w{1,}$"> <br>

          <input value="<?php if ($res_reg == "pass" or $res_reg == "email") {echo $name;}?>"
                        class="br_auth" type="text" title="Длинна имени от 1 до 3 символов. Только буквы." placeholder="Имя" name="Name" required pattern="[A-Za-zА-Яа-яЁё]{1,3}"> <br>

          <button class="but_" type="submit" id="reg__" name="Register">Зарегистрироваться</button>
        </form>

        <?php
        if ($res_reg == "pass") {echo "Пароли не совпадают";}
        elseif ($res_reg == "login+email") {echo "Login или Email уже заняты";}
        elseif ($res_reg == "login") {echo "Данный Login занят";}
        elseif ($res_reg == "email") {echo "Данный Email уже используется";}
        elseif($res_reg == "ok") {echo "Регистрация прошла успешно";
          $_SESSION["username"] = $name;
        }
        ?>
    </div>
</div>

<?php
require ($_SERVER[DOCUMENT_ROOT]."/core/footer.php");
?>
