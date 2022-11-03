<?php $title_name="Удаление" ?>
<?php require ($_SERVER[DOCUMENT_ROOT]."/core/header.php") ?>


  <main>
    <form class="form_auth" method="POST">
      <input class="br_auth" type="text" placeholder="Логин" name="Login" required> <br>
      <button class="but_" id="reg__" type="submit" name="Auth">Удалить пользователя</button>
    </form>
    <?php
        if (isset($_POST['Login'])){
            $login = $_POST['Login'];
            $res = new CRUD();
            $result = $res->delete_user($login);
            if ($result == "ok") {
              echo "Пользователь '".$login."' успешно удален";
            }
            else {
              echo 'Пользователь "'.$login.'" отсутствет в БД. ';
            }
        }
    ?>
  </main>
<?php require ($_SERVER[DOCUMENT_ROOT]."/core/footer.php") ?>
