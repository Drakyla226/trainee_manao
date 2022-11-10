<?php session_start();
$j_db = $_SERVER[DOCUMENT_ROOT]."/core/db_users.json";
require ($_SERVER[DOCUMENT_ROOT]."/core/class/CRUD.php");

#Если JSON файла не существует или не соответствует формату JSON
#создаем файл пустым
if (!file_exists($j_db)){
  file_put_contents($j_db,'');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <?php echo "<title>".$title_name."</title>"?>
  <link rel="stylesheet" href="/core/style.css">
</head>
<body>
<div class="back_main">
  <a id="back_main" href="/">На главную</a>
  <a id="back_main" href="/db_user">Работа с БД</a>
</div>
