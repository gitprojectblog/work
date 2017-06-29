<?php

require_once '../../php/config.php';
require_once '../../php/test.php';

echo "<h1>Before</h1>";
$que = $connect->query("SELECT * FROM user_list");
$avatar_male = '/images/avatar/avatar_male.jpg';
$avatar_female = '/images/avatar/avatar_female.jpg';

echo "<pre>";
while ($row = $que->fetch_assoc()) {
  print_r($row);
  if ($row['gender'] == 'Мужской' && $row['avatar'] == '') {
    $que2 = $connect->query("UPDATE user_list SET avatar='".$avatar_male."' WHERE id='".$row['id']."'");
  } else {
    if ($row['avatar'] == '') {
      $que2 = $connect->query("UPDATE user_list SET avatar='".$avatar_female."' WHERE id='".$row['id']."'");
    }
  }
}

echo "<h1>END</h1>";
$que = $connect->query("SELECT * FROM user_list");
while ($row = $que->fetch_assoc()) {
  print_r($row);
}


?>
