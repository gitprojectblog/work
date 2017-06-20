<?php
session_start();

require_once 'config.php';

$id = $_POST['id'];
$nickname = $_POST['login'];
$text = $_POST['text'];
$user_id = $_POST['user_id'];

// echo $_SESSION['id_ses'];
// exit();

if ($user_id == $_SESSION['id_ses'] && $nickname == $_SESSION['login_ses']) {
	if (!empty($id) && !empty($nickname) && !empty($text)) {
		$query = $connect->query("INSERT INTO comments (id_news,author,text)
				VALUES ('".$id."','".$nickname."','".$text."')");
	} else {
		echo 'error';
		exit();
	}

	$date1 = date('Y-m-d ');
	$date2 = date('G');
	$date3 = date(':i:s');
	if ($date2 < 10) {
		$date2 = '0'.$date2;
	}
	$date = $date1.$date2.$date3;

	echo "
		<div class='comment'>
			<div class='com-head'>
				<p class='com-time'>".$date."</p>
				<p class='com-aut'>".$nickname."</p>
			</div>
			<div class='com-text'>".$text."</div>
		</div>
	";
} else {
	echo 'error';
}

?>
