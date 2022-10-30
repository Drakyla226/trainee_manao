<?php $title_name="Работа с БД" ?>
<?php require ($_SERVER[DOCUMENT_ROOT]."/core/header.php") ?>
  <main>
    <ul>
      <li><a class="li_db" id="li_db" href="creat">Добавление</a></li>
      <li><a class="li_db" id="li_db" href="read">Проверка</a></li>
      <li><a class="li_db" id="li_db" href="up">Изменение</a></li>
      <li><a class="li_db" id="li_db" href="del">Удаление</a></li>
    </ul>
    <div class="inform">
      СЧИТАЕМ ЧТО ЭТО АДМИН ПАНЕЛЬ
      Зарегистрированные пользователи
      <?php
      $j_data = file_get_contents($j_db);
      $j_array = json_decode($j_data, true);
      if($j_array !== NULL){
        foreach ($j_array as $key => $value) {
          echo $value["login"];
          echo "<br>";
        }
      }
      else{
        $result = "no";
      }
      ?>
    </div>
  </main>
<?php require ($_SERVER[DOCUMENT_ROOT]."/core/footer.php") ?>
