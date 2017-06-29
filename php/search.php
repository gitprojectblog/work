<?php

$text = '~'.trim(mb_strtolower($_POST['text'], 'UTF-8')).'~';
$navi = array();
if(isset($_POST['navig'])) {
  $navi = explode(',',$_POST['navig']);
} else {
  for($i = 2; $i < 6; $i++) {
    if(isset($_POST['navig'.$i.''])) {
      $navi[] = 1;
    } else {
      $navi[] = 0;
    }
  }
}
$news = array();
require_once 'config.php';
$que = $connect->query("SELECT * FROM news ORDER BY time DESC");
while($row = $que->fetch_assoc()) {
  $news[] = $row;
}
$news_out = array();

if($news != array()) {
  foreach ($news as $key => $value) {
    if($navi[0] == 1) {
      if(preg_match($text, mb_strtolower($value['title'], 'UTF-8'))) {
        $news_out[] = $value;
        continue;
      }
    }
    if($navi[1] == 1) {
      if(preg_match($text, mb_strtolower($value['short_content'], 'UTF-8'))) {
        $news_out[] = $value;
        continue;
      }
    }
    if($navi[2] == 1) {
      if(preg_match($text, mb_strtolower($value['content'], 'UTF-8'))) {
        $news_out[] = $value;
        continue;
      }
    }
    if($navi[3] == 1) {
      if(preg_match($text, mb_strtolower($value['tegs'], 'UTF-8'))) {
        $news_out[] = $value;
        continue;
      }
    }
  }
  $news_cout = count($news_out);
} else {
}


// $pat = '~text~';
// $txt = 'vot eto texxt';
//
// var_dump(preg_match($pat, $txt));

// echo "<pre>";
// echo $text;
// print_r($navi);
// print_r($news_out);
// exit();

?>
