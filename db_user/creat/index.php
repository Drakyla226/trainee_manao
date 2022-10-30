<?php $title_name="Работа с БД" ?>
<?php require ($_SERVER[DOCUMENT_ROOT]."/core/header.php") ?>
  <main>

    <?php
        if (isset($_POST['Login']) and isset($_POST['Password']) and isset($_POST['Email']) and isset($_POST['Name'])){
            $login = $_POST['Login'];
            $password = $_POST['Password'];
            $email = $_POST['Email'];
            $name = $_POST['Name'];
            $res = new CRUD();
            $result = $res->create_user($login, $password, $email, $name);
            if ($result == "ok") {
              $res_reg = "ok";
            }
            else {
              $res_reg = "no";
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

              <input value="<?php if ($res_reg == "pass" or $res_reg == "login") {echo $email;}?>"
                            class="br_auth" type="email" title="" placeholder="Email" name="Email" required>  <br>

              <input value="<?php if ($res_reg == "pass" or $res_reg == "email") {echo $name;}?>"
                            class="br_auth" type="text" title="Длинна имени от 2 до 30 символов. Только буквы." placeholder="Имя" name="Name" required pattern="[A-Za-zА-Яа-яЁё]{2,30}"> <br>

              <button class="but_" type="submit" id="reg__" name="Register">Добавить пользователя</button>
            </form>
            <?php
            if ($res_reg == "no") {echo "Пользователь или email уже зарегистрирован";}
            elseif($res_reg == "ok") {echo "Пользователь успешно добавлен";
              header("Location: /db_user");
              exit();
            }
            ?>
        </div>
    </div>


  </main>
<?php require ($_SERVER[DOCUMENT_ROOT]."/core/footer.php") ?>
