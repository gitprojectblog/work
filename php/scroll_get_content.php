<?php

require 'config.php';
$path = $_POST['path'];
$counter = $_POST['counter'];
$nav = explode('/', $path);


if ($nav[1] == '') {
  $que = $connect->query("SELECT * FROM news ORDER BY time DESC LIMIT $counter, 10");
  while ($row = $que->fetch_assoc()) {
    $news[] = $row;
  }
  $echo_string = '';

  if (is_array($news)) {
    foreach ($news as $key => $value) {
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
      $navig = '';
      if ($value['nav'] == 'urgent') {
        $navig = 'urgent';
      } elseif ($value['nav'] == 'funny') {
        $navig = 'funny';
      } else {
        $navig = 'standart';
      }
      $sc = mb_substr($value['short_content'], 0, 115, 'UTF-8');
      if ($sc != $value['short_content']) {
        $dots = '...';
      } else {
        $dots = '';
      }
      $echo_string .= "<div class='block ".$navig."'>
      <img src='".$value['image_short']."' alt='".$value['title']."' class='block-img'>
      <h3><a href='/news/".$value['id']."'>".$value['title']."</a></h3>
      <p class='block_sc'>".$sc.$dots."</p>
      <div class='block_footer'>
        <div class='tegs'>
        ";
        $tegs = explode('/', $value['tegs']);
        foreach ($tegs as $key => $teg) {
          $echo_string .= "<div class='teg'>".$teg."</div>";
        }
        $echo_string .= "
        </div>
        <p class='block_time'>".$time_news.", Рейтинг: <span>".$value['raiting']."</span>, Просмотров: <span>".$value['views']."</span></p>
        <p class='block_aut'><a href='/profile/".$value['author']."'>".$value['author']."</a></p></div></div>";
    }

    echo $echo_string;
  }

} elseif ($nav[1] == 'urgent' || $nav[1] == 'funny') {
  $que = $connect->query("SELECT * FROM news WHERE nav='".$nav[1]."' ORDER BY time DESC LIMIT $counter, 10");
  while ($row = $que->fetch_assoc()) {
    $news[] = $row;
  }
  $echo_string = '';

  if (is_array($news)) {
  foreach ($news as $key => $value) {
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
    $navig = '';
    if ($value['nav'] == 'urgent') {
      $navig = 'urgent';
    } elseif ($value['nav'] == 'funny') {
      $navig = 'funny';
    } else {
      $navig = 'standart';
    }
    $sc = mb_substr($value['short_content'], 0, 115, 'UTF-8');
    if ($sc != $value['short_content']) {
      $dots = '...';
    } else {
      $dots = '';
    }
    $echo_string .= "<div class='block'>
    <img src='".$value['image_short']."' alt='".$value['title']."' class='block-img'>
    <h3><a href='/news/".$value['id']."'>".$value['title']."</a></h3>
    <p class='block_sc'>".$sc.$dots."</p>
    <div class='block_footer'>
      <div class='tegs'>
      ";
      $tegs = explode('/', $value['tegs']);
      foreach ($tegs as $key => $teg) {
        $echo_string .= "<div class='teg'>".$teg."</div>";
      }
      $echo_string .= "
      </div>
			<p class='block_time'>".$time_news.", Рейтинг: <span>".$value['raiting']."</span>, Просмотров: <span>".$value['views']."</span></p>
      <p class='block_aut'><a href='/profile/".$value['author']."'>".$value['author']."</a></p></div></div>";
  }

  echo $echo_string;
}
} else {
}

?>
