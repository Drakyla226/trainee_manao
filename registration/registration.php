<?php
session_start();
$j_db = $_SERVER[DOCUMENT_ROOT]."/core/db_users.json";
$j_data = file_get_contents($j_db);
$j_array = json_decode($j_data, true);

if (json_decode($j_data, true)){
  if (isset($_POST['Login']) and isset($_POST['Password']) and isset($_POST['Password2']) and isset($_POST['Email']) and isset($_POST['Name'])){
    $login = $_POST['Login'];
    $password = $_POST['Password'];
    $password2 = $_POST['Password2'];
    $email = $_POST['Email'];
    $name = $_POST['Name'];

    $min_log_pass = 6;
    $min_name = 2;

    if ($min_log_pass <= strlen($login) and $min_log_pass <= strlen($password) and $min_name <= strlen($name)) {
      $res_reg = "login+email";
      $num = 0;

      if($password != $password2){
          $res_reg = "pass";
      }else{
        if($j_array !== NULL){
          foreach ($j_array as $key => $value) {
            if ($value["login"] == $login or $value["email"] == $email){
              $num = $num + 1;
            }
          }
          if ($num == 0){
            $res_reg = "ok";
          }
        }
        if ($res_reg == "ok"){
          $arr_filds = array(
                             "login" => $login,
                             "password" => password_hash($password, PASSWORD_DEFAULT),
                             "email" => $email,
                             "name" => $name);
          $j_array[] = $arr_filds;
          $add_arr = json_encode($j_array, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
          if (file_put_contents($j_db, $add_arr)){
            $res_reg = "ok";
          }
        }
        if($j_array == NULL){
          $arr_filds = array(
                             "login" => $login,
                             "password" => password_hash($password, PASSWORD_DEFAULT),
                             "email" => $email,
                             "name" => $name);
          $j_array[] = $arr_filds;
          $add_arr = json_encode($j_array, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
          if (file_put_contents($j_db, $add_arr)){
            $res_reg = "ok";
          }
        }
      }
    }else{
      $res_reg = "len";
    }
  }

  if ($res_reg == "len") {
    echo "???????????????????????? ???????????? ????????????";
  }
  if ($res_reg == "pass") {echo "???????????? ???? ??????????????????";}
  elseif ($res_reg == "login+email") {echo "Login ?????? Email ?????? ????????????";}
  elseif ($res_reg == "login") {echo "???????????? Login ??????????";}
  elseif ($res_reg == "email") {echo "???????????? Email ?????? ????????????????????????";}
  elseif($res_reg == "ok") {echo "?????????????????????? ???????????? ??????????????";
    $_SESSION["username"] = $name;
  }
}else {
  echo "JSON ???????? ???? ?????????????????????????? ??????????????!";
}
?>
