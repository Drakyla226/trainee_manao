<?php session_start();
$j_db = $_SERVER[DOCUMENT_ROOT]."/core/db_users.json";
require ($_SERVER[DOCUMENT_ROOT]."/core/class/CRUD.php");

#Если JSON файла не существует или не соответствует формату JSON
#создаем файл пустым
if (!file_exists($j_db) or json_last_error() !== JSON_ERROR_NONE){
  file_put_contents($j_db,'');
}
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <?php echo "<title>".$title_name."</title>"?>
  <script src="/core/clearform.js"></script>
  <link rel="stylesheet" href="/core/style.css">
  <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<body>
<div class="back_main">
  <a id="back_main" href="/">На главную</a>
  <a id="back_main" href="/db_user">Работа с БД</a>
</div>
