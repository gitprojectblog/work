<?php

require_once 'config.php';
$que = $connect->query('SELECT views FROM news WHERE id='.$id.'');
$row = $que->fetch_assoc();
$count_views = $row['views'];
$count_views++;
$que = $connect->query('UPDATE news SET views='.$count_views.' WHERE id='.$id.'');

?>
