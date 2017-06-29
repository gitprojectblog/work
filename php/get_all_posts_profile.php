<?php

$de_json_posts = json_decode($_POST['json'], true);
$all_posts = '';

foreach ($de_json_posts as $key => $value) {
  $time_now = date('Y-m-d-G-i-s');
  $time_explode = explode('-', $time_now);
  $time_now =
  $time_explode[0] * 12 * 30 * 24 * 60 * 60 +
  $time_explode[1] * 30 * 24 * 60 * 60 +
  $time_explode[2] * 24 * 60 * 60 +
  $time_explode[3] * 60 * 60 +
  $time_explode[4] * 60 +
  $time_explode[5];

  $time_news_1 = explode(' ', $value['time']);
  $time_news_l = explode('-', $time_news_1[0]);
  $time_news_r = explode(':', $time_news_1[1]);
  $time_news =
  $time_news_l[0] * 12 * 30 * 24 * 60 * 60 +
  $time_news_l[1] * 30 * 24 * 60 * 60 +
  $time_news_l[2] * 24 * 60 * 60 +
  $time_news_r[0] * 60 * 60 +
  $time_news_r[1] * 60 +
  $time_news_r[2];

  $time_dif = $time_now - $time_news;
  if ($time_dif < 60) {
    $time_news = $time_dif." сек. назад";
  } else {
    if ($time_dif < 3600) {
      $time_news = floor($time_dif / 60)." мин. назад";
    } else {
      if ($time_dif < 86400) {
        $time_news = floor($time_dif / 60 / 60 )." час. назад";
      } else {
        if ($time_dif < 172800 && $time_dif >= 86400) {
          $time_news = "Вчера в ".$time_news_r[0].":".$time_news_r[1]."";
        } else {
          if ($time_dif < 2592000) {
            $time_news = floor($time_dif / 60 / 60 / 24)." дней назад.";
          } else {
            if ($time_dif < 31104000) {
              $time_news = floor($time_dif / 60 / 60 / 24 / 24)." месяцев назад";
            } else {
              if ($time_dif < 62208000) {
                $time_news = "Более года назад";
              } else {
                $time_news = "Более пары лет назад";
              }
            }
          }
        }
      }
    }
  }
  $all_posts .= "<div class='post_block ".$value['nav']."'>
    <div class='post_block_left'>
      <img src='".$value['image_big']."'>
    </div>
    <div class='post_block_right'>
    <h4><a href='/news/".$value['id']."'>".$value['title']."</a></h4>
    <p class='post_short_content'>".$value['short_content']."</p>";
    $tegs = explode('/', $value['tegs']);
    foreach ($tegs as $key => $teg) {
      $all_posts .= "<div class='teg'>".$teg."</div>";
    }
    $all_posts .= "<p class='post_time'>".$time_news."</p>";
  $all_posts .= "</div></div>";
}

echo $all_posts;

?>
