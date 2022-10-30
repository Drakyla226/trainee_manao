<?php $title_name="Главная страница" ?>
<?php require ($_SERVER[DOCUMENT_ROOT]."/core/header.php") ?>
  <main>
        <?php
      if (isset($_SESSION['username'])){
          $name = $_SESSION['username'];?>
          <h2 class="user_text">Привет <?php echo $name?></h2>
          <button class="but_" id="log_in" name="log_in"><a class="a_reg" href="/log_out">Выйти</a></button>
          <button class="but_" id="reg_" name="log_in"><a class="a_reg" href="/registration">Регистрация</a></button>
<?php }else{?>
  <button class="but_" id="log_in" name="log_in"><a class="a_reg" href="/log_in">Вход</a></button>
  <button class="but_" id="reg_" name="log_in"><a class="a_reg" href="/registration">Регистрация</a></button>
<?php }?>
  </main>
<?php require ($_SERVER[DOCUMENT_ROOT]."/core/footer.php") ?>
