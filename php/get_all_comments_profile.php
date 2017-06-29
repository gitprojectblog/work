<?php

require_once 'config.php';
$news_id = $_POST['news_id'];

$que = $connect->query("SELECT * FROM news WHERE id=".$news_id."");

$row = $que->fetch_assoc();
$mbshort = mb_substr($row['short_content'], 0, 100, "UTF-8");
if ($mbshort != $row['short_content']) {
  $mbshort .= '...';
}
echo "
  <h5>".$row['title']."</h5>
  <p>".$mbshort."</p>
";

?>
