<?php $title_name = "Регистрация"?>
<?php require ($_SERVER[DOCUMENT_ROOT]."/core/header.php");?>

<script type="text/javascript">
  $(function(){
    $('#form').submit(function(e){
      e.preventDefault();
      var data = $(this).serialize();
      $.ajax({
        type: "POST",
        url: "registration.php",
        data: data,
        success: function(result){
          $('#result').html(result);
          $('#form').trigger('reset');
        }
      });
    });
  });
</script>


<div class="block_auth">
    <div class="main_auth">
        <h1>РЕГИСТРАЦИЯ</h1>
        <pre>Все поля обязательны</pre>
        <form class="form_auth" id = "form">
          <NOSCRIPT><input type='hidden' name='js_form' value='no'></NOSCRIPT>
          <input class="br_auth" type="text" title="Минимум 6 символов и состоять из букв или цифр. Без пробелов." placeholder="Логин" name="Login" required pattern="[а-яА-Яa-zA-Z0-9\S]{6,}"> <br>

          <input class="br_auth" type="password" title="Минимум 6 символов и обязательно состоять из букв и цифр. Без пробелов." placeholder="Пароль" name="Password" required pattern="(?=^.{6,}$)(?=.*\d)(?=.*\W*)(?=.*[a-zA-Z])(?!.*\s).*$"> <br>
          <input class="br_auth" type="password" title="Поле долэно совпадать с паролем." placeholder="Подтверждение пароля" name="Password2" required> <br>

          <input class="br_auth" title="К примеру: email@mail.ru" placeholder="Email" name="Email" required pattern="[\d\w]{1,}@\w{1,}\.\w{1,}$"> <br>

          <input class="br_auth" type="text" title="Длинна имени минимум 2 символа. Только буквы." placeholder="Имя" name="Name" required pattern="[A-Za-zА-Яа-яЁё]{1,}"> <br>

          <button class="but_" type="submit" id="reg__" name="Register">Зарегистрироваться</button>
        </form>
        <div id="result">

        </div>


    </div>
</div>

<?php
require ($_SERVER[DOCUMENT_ROOT]."/core/footer.php");
?>
