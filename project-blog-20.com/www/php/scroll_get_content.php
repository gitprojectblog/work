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
        <p class='block_time'>".$value['time']."</p>
        <p class='block_aut'>".$value['author']."</p></div></div>";
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
    <img src='".$value['image']."' alt='".$value['title']."' class='block-img'>
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
      <p class='block_time'>".$value['time']."</p>
      <p class='block_aut'>".$value['author']."</p></div></div>";
  }

  echo $echo_string;
}
} else {
}

?>
