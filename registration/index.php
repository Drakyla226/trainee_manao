<?php $title_name = "Регистрация"?>
<?php require ($_SERVER[DOCUMENT_ROOT]."/core/header.php");?>
<?php
    if (isset($_POST['Login']) and isset($_POST['Password']) and isset($_POST['Password2']) and isset($_POST['Email']) and isset($_POST['Name'])){
        $login = $_POST['Login'];
        $password = $_POST['Password'];
        $password2 = $_POST['Password2'];
        $email = $_POST['Email'];
        $name = $_POST['Name'];

        $j_data = file_get_contents($j_db);
        $j_array = json_decode($j_data, true);

        if($password != $password2){
            $res_reg = "pass";
        }
        else{
          if($j_array !== NULL){
            foreach ($j_array as $key => $value) {
              if ($value["login"] == $login and $value["email"] == $email){
                $res_reg = "login+email";
                break;
              }
              elseif ($value["login"] == $login){
                $res_reg = "login";
                break;
              }
              elseif ($value["email"] == $email){
                $res_reg = "email";
              }
              else{
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
          else{
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
?>

<div class="block_auth">
    <div class="main_auth">
        <h1>АВТОРИЗАЦИЯ</h1>
        <pre>Все поля обязательны</pre>
        <form class="form_auth" method="POST">

            <input value="<?php if ($res_reg == "pass" or $res_reg == "email") {echo $login;}?>"
                          class="br_auth" type="text" title="Минимум 6 символов и состоять из букв или цифр. Без пробелов." placeholder="Логин" name="Login" required pattern="[а-яА-Яa-zA-Z0-9\S]{6,}"> <br>

            <input class="br_auth" type="password" title="Минимум 6 символов и обязательно состоять из букв и цифр. Без пробелов." placeholder="Пароль" name="Password" required pattern="(?=^.{6,}$)^(?=.*\d)(?=.*[a-zA-Z])(?!.*\s).*$"> <br>
            <input class="br_auth" type="password" title="Поле долэно совпадать с паролем." placeholder="Подтверждение пароля" name="Password2" required> <br>

            <input value="<?php if ($res_reg == "pass" or $res_reg == "login") {echo $email;}?>"
                          class="br_auth" type="email" title="" placeholder="Email" name="Email" required>  <br>

           <input value="<?php if ($res_reg == "pass" or $res_reg == "email") {echo $name;}?>"
                          class="br_auth" type="text" title="Длинна имени от 2 до 30 символов. Только буквы." placeholder="Имя" name="Name" required pattern="[A-Za-zА-Яа-яЁё]{2,30}"> <br>

        <button class="but_" type="submit" id="reg__" name="Register">Зарегистрироваться</button>
        </form>
        <?php
        if ($res_reg == "pass") {echo "Пароли не совпадают";}
        elseif ($res_reg == "login+email") {echo "Login и Email уже заняты";}
        elseif ($res_reg == "login") {echo "Данный Login занят";}
        elseif ($res_reg == "email") {echo "Данный Email уже используется";}
        elseif($res_reg == "ok") {echo "Регистрация прошла успешно";
          $_SESSION["username"] = $name;
          header("Location: /");
          exit();
        }
        ?>
    </div>
</div>

<?php
require ($_SERVER[DOCUMENT_ROOT]."/core/footer.php");
?>
