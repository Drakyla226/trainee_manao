<?php $title_name="Авторизация" ?>
<?php require ($_SERVER[DOCUMENT_ROOT]."/core/header.php") ?>

<script type="text/javascript">
  $(function(){
    $('#form').submit(function(e){
      e.preventDefault();
      var data = $(this).serialize();
      $.ajax({
        type: "POST",
        url: "log_in.php",
        data: data,
        success: function(result){
          $('#result').html(result),
          $('#form').trigger('reset');
        }
      });
    });
  });
</script>

  <div class="block_auth">
    <div class="main_auth">
      <h1>АВТОРИЗАЦИЯ</h1>

      <form class="form_auth" id = "form">
        <NOSCRIPT><input type='hidden' name='js_form' value='no'></NOSCRIPT>
        <input class="br_auth" type="text" placeholder="Логин" name="Login" required> <br>
        <input class="br_auth" type="password" placeholder="Пароль" name="Password" required> <br>
        <button class="but_" id="auth_" type="submit" name="Auth">Войти</button>
      </form>
      <button class="but_" id="reg_" name="Register"><a class="a_reg" href="/registration">Зарегистрироваться</a></button>

        <div id="result">

        </div>

    </div>
  </div>

<?php require ($_SERVER[DOCUMENT_ROOT]."/core/footer.php") ?>
