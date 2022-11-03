<?php $title_name="Чтение" ?>
<?php require ($_SERVER[DOCUMENT_ROOT]."/core/header.php") ?>

<?php

?>

  <main>
    <form class="form_auth" method="POST">
      <input class="br_auth" type="text" placeholder="Логин" name="Login" required> <br>
      <button class="but_" id="reg__" type="submit" name="Auth">Найти пользователя</button>
    </form>
    <?php
    if (isset($_POST['Login'])){
      $login = $_POST['Login'];
      $res = new CRUD();
      $result = $res->read_user($login);
      if ($result !== "no") {
        echo 'Login - '.$login.'</br>';
        echo 'Email - '.$result["email"].'</br>';
        echo 'Name - '.$result["name"].'</br>';
      }
      else {
        echo 'Пользователь "'.$login.'" отсутствет в БД. ';
      }
    }
     ?>
  </main>
<?php require ($_SERVER[DOCUMENT_ROOT]."/core/footer.php") ?>
