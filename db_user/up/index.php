<?php $title_name="Работа с БД" ?>
<?php require ($_SERVER[DOCUMENT_ROOT]."/core/header.php") ?>
  <main>
    <form class="form_auth" method="POST">
      <?php
        if (isset($_POST['Login'])){
          $login = $_POST['Login'];
          $j_data = file_get_contents($j_db);
          $j_array = json_decode($j_data, true);
          if($j_array !== NULL){
            foreach ($j_array as $key => $value) {
              if ($value["login"] == $login){
                $ress = "ok";
                break;
              }
              else{
                $ress = "no";
              }
            }
          }
          else{
            $ress = "no";
          }
        }
        if ($ress == "ok"){echo "Пользователь найден. Введите новые данные.</br>";}
      ?>
      <input value="<?php if ($ress == "ok") {echo $login;?>" readonly <?php };?>"
                    class="br_auth" type="text" title="Минимум 6 символов и состоять из букв или цифр. Без пробелов." placeholder="Логин" name="Login" required pattern="[а-яА-Яa-zA-Z0-9\S]{6,}"> <br>



        <?php
            if (isset($_POST['Login']) and isset($_POST['Password']) and isset($_POST['Email']) and isset($_POST['Name'])){
                $login = $_POST['Login'];
                $password = $_POST['Password'];
                $email = $_POST['Email'];
                $name = $_POST['Name'];
                $res = new CRUD();
                $result = $res->update_user($login, $password, $email, $name);
                header("Location: /db_user");
                exti();
            }
            if ($ress == "ok"){
        ?>

      <input class="br_auth" type="password" title="Минимум 6 символов и обязательно состоять из букв и цифр. Без пробелов." placeholder="Пароль" name="Password" required pattern="(?=^.{6,}$)^(?=.*\d)(?=.*[a-zA-Z])(?!.*\s).*$"> <br>

      <input class="br_auth" type="email" title="" placeholder="Email" name="Email" required>  <br>

      <input class="br_auth" type="text" title="Длинна имени от 2 до 30 символов. Только буквы." placeholder="Имя" name="Name" required pattern="[A-Za-zА-Яа-яЁё]{2,30}"> <br>

        <?php
          }
        ?>

      <button class="but_" type="submit" id="reg__" name="Register">Изменить данные</button>
    </form>
    <?php
    if ($ress == "no") {
      echo 'Пользователь "'.$login.'" отсутствет в БД. ';
    } ?>
  </main>
<?php require ($_SERVER[DOCUMENT_ROOT]."/core/footer.php") ?>
