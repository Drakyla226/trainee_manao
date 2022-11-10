<?php
session_start();
$j_db = $_SERVER[DOCUMENT_ROOT]."/core/db_users.json";
$j_data = file_get_contents($j_db);
$j_array = json_decode($j_data, true);

if (json_decode($j_data, true)){
  if (isset($_POST['Login']) and isset($_POST['Password'])){
    $login = $_POST['Login'];
    $password = $_POST['Password'];

    foreach ($j_array as $key => $value) {
      if ($value["login"] == $login){
        if (password_verify($password, $value["password"])){
            $count = 1;
            $error_pass = 1;
        }
        $error_login = 1;
      }
    }
  }

  if ($count == 1){
    $_SESSION['username'] = $login;
    $_COOKIE['id'] = $_COOKIE["PHPSESSID"];}
  elseif ($error_login !== 1){echo "<div class='user_auth'>!! Данного пользователя не существует !!</div>";}
  elseif ($error_pass !== 1){echo "<div class='user_auth'>!! Неверный пароль !!</div>";}

  if (isset($_SESSION['username'])){
    echo "<h3><i>Авторизация прошла успешно!</i></h3>";?>
    <h2 class="user_text">Привет <span class="span_red"><?php echo $_SESSION["username"];
  }

}else {
  echo "JSON файл не соответствует формату!";
}?>
</span></h2>
