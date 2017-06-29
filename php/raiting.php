<?php

session_start();
require_once 'config.php';

if ($_SESSION['id_ses'] == $_POST['id_user']) {
  $que = $connect->query("SELECT users_raiting FROM news WHERE id='".$_POST['id_news']."'");
  $row = $que->fetch_assoc();
  // echo "row";
  // print_r($row);
  // echo "user_rait";
  // print_r($row['users_raiting']);
  $new_rait = array();
  $user_rait = false;
  $rait_array = explode(',', $row['users_raiting']);
  // echo "rate_array";
  // print_r($rait_array);
  if (is_array($rait_array)){
    foreach ($rait_array as $key => $value) {
      $user_rate = explode('/', $value);
      if($user_rate[0] == $_POST['id_user']) {
        $user_rait = true;
        // echo '<hr>1';
        if($user_rate[1] != $_POST['rait']) {
          $value = $user_rate[0]."/".$_POST['rait'];
          $new_rait[] = $value;
          // echo '<hr>2';
        } else {
          $value = $user_rate[0]."/0";
          $_POST['rait'] = 0;
          $new_rait[] = $value;
          // echo '<hr>3';
        }
      } else {
        $new_rait[] = $value;
      }
    }
  } else {

  }
  // echo "new_rait";
  // print_r($new_rait);
  $imp_new_rait = implode(",", $new_rait);
  // echo "imp_new_rate";
  // print_r($imp_new_rait);
  if(!$user_rait) {
    $que = $connect->query("UPDATE news SET users_raiting='".$imp_new_rait.','.$_POST['id_user']."/".$_POST['rait']."' WHERE id='".$_POST['id_news']."'");
    // echo 'end 1';
  } else {
    $que = $connect->query("UPDATE news SET users_raiting='".$imp_new_rait."' WHERE id='".$_POST['id_news']."'");
    // echo 'end 2';
  }
  $que = $connect->query("SELECT users_raiting FROM news WHERE id='".$_POST['id_news']."'");
  $row = $que->fetch_assoc();
  $counter_raiting = 0;
  $new_raiting = explode(',', $row['users_raiting']);
  foreach ($new_raiting as $key => $value) {
    $user_raiting = explode('/', $value);
    if($user_raiting[0]) {
      $counter_raiting = $counter_raiting + +$user_raiting[1];
    }
  }
  $que = $connect->query("UPDATE news SET raiting='".$counter_raiting."' WHERE id='".$_POST['id_news']."'");
  echo $counter_raiting."/".$_POST['rait'];
  // echo "reaady";
} else {
  echo '0/0';
}

?>
