<?php
//ЭТОТ КЛАСС НАПИСАН ИМЕННО ДЛЯ JSON
class CRUD
{
  var $j_data;
  var $j_array;
  var $j_db_;
  var $num;

  public function create_user(string $c_login, string $c_password, string $c_email, string $c_name)
  {
    $j_db_ = $_SERVER[DOCUMENT_ROOT]."/core/db_users.json";
    $j_data = file_get_contents($j_db_);
    $j_array = json_decode($j_data, true);
    $num = 0;
    if($j_array !== NULL){
      foreach ($j_array as $key => $value) {
        if ($value["login"] == $c_login or $value["email"] == $c_email){
          $num = $num + 1;
        }
      }
      if ($num == 0){
        $arr_filds = array(
                           "login" => $c_login,
                           "password" => password_hash($c_password, PASSWORD_DEFAULT),
                           "email" => $c_email,
                           "name" => $c_name);
        $j_array[] = $arr_filds;
        $add_arr = json_encode($j_array, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
        if (file_put_contents($j_db_, $add_arr)){
          $result = "ok";
        }
      }
      else{
        $result = "no";
      }
    }
    else{
      $arr_filds = array(
                         "login" => $c_login,
                         "password" => password_hash($c_password, PASSWORD_DEFAULT),
                         "email" => $c_email,
                         "name" => $c_name);
      $j_array[] = $arr_filds;
      $add_arr = json_encode($j_array, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
      if (file_put_contents($j_db_, $add_arr)){
        $result = "ok";
      }
    }
    return $result;
  }

  public function read_user(string $r_login)
  {
    $j_db_ = $_SERVER[DOCUMENT_ROOT]."/core/db_users.json";
    $j_data = file_get_contents($j_db_);
    $j_array = json_decode($j_data, true);
    if($j_array !== NULL){
      foreach ($j_array as $key => $value) {
        if ($value["login"] == $r_login){
          //ВЫВОД ДАННЫХ ПОЛЬЗОВАТЕЛЯ
          $email = $value["email"];
          $name = $value["name"];
          $result = array("email" => $email,
                             "name" => $name);
          break;
        }
        else{
          //ПОЛЬЗОВАТЕЛЬ НЕ НАЙДЕН
          $result = "no";
        }
      }
    }
    else{
      //БД ПУСТА
      $result = "no";
    }
    return $result;
  }

  public function update_user(string $up_login, string $up_password, string $up_email, string $up_name)
  {
    $j_db_ = $_SERVER[DOCUMENT_ROOT]."/core/db_users.json";
    $j_data = file_get_contents($j_db_);
    $j_array = json_decode($j_data, true);
    if($j_array !== NULL){
      foreach ($j_array as $key => $value) {
        if ($value["login"] == $up_login){
          //ИЗМЕНЯЕМ ЗАДАННЫЕ ПОЛЯ
          $arr_filds = array(
                             "login" => $up_login,
                             "password" => password_hash($up_password, PASSWORD_DEFAULT),
                             "email" => $up_email,
                             "name" => $up_name);
          $j_array_[$key] = $arr_filds;
          $j_array = array_replace($j_array, $j_array_);
          $add_arr = json_encode($j_array, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
          if (file_put_contents($j_db_, $add_arr)){
            $result = "ok";
            break;
          }
        }
        else{
          $result = "no";
        }
      }
    }
    else{
      $result = "no";
    }
    return $result;
  }

  public function delete_user(string $del_login)
  {
    $j_db_ = $_SERVER[DOCUMENT_ROOT]."/core/db_users.json";
    $j_data = file_get_contents($j_db_);
    $j_array = json_decode($j_data, true);
    if($j_array !== NULL){
      foreach ($j_array as $key => $value) {
        if ($value["login"] == $del_login){
          //УДАЛЯЕМ ДАННОГО ПОЛЬЗОВАТЕЛЯ
          unset($j_array[$key]);
          $add_arr = json_encode($j_array, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
          if (file_put_contents($j_db_, $add_arr)){
            $result = "ok";
            break;
          }
        }
        else{
          $result = "no";
        }
      }
    }
    else{
      $result = "no";
    }
    return $result;
  }
}
?>
