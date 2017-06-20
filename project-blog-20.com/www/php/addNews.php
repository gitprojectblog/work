<?php

session_start();

require_once 'config.php';

$nickname = $_POST['nickname'];
$user_id = $_POST['user_id'];
// echo '123';
// echo $admin_ses;
// echo $_SESSION['is_admin_ses'];
// print_r($_SESSION);
// exit();

$title = $_POST['title'];
if ($_POST['author']) {
	$nickname = $_POST['author'];
}
$short_content = $_POST['short_content'];
$content = $_POST['content'];
$nav = $_POST['nav_select'];
$tegs = $_POST['tegs_input'];
// $tegs = 'Новость/'.$tegs;


		$date1 = date('Y_m_d_');
		$date2 = date('G');
		$date3 = date('_i_s');
		if ($date2 < 10) {
			$date2 = '0'.$date2;
		}
		$date = $date1.$date2.$date3;

$ex_tegs = explode('/', $tegs);
$test_tegs = false;
foreach ($ex_tegs as $key => $value) {
	$str_lower = mb_strtolower($value, 'UTF-8');
	// echo $value." : ".$str_lower." : ".mb_strtolower($value, 'UTF-8')." ";
	if ($str_lower == 'новость' || $value == 'новость' || $value == 'Новость')
		$test_tegs = true;
}
if (!$test_tegs)
	$tegs = 'Новость/'.$tegs;
// exit();
// echo $user_id." : ".$_SESSION['id_ses']." <br> ";
// echo $nickname." : ".$_SESSION['login_ses'];

// echo $nickname."<br>";
// echo $id."<br>";
// echo $title."<br>";
// echo $short_content."<br>";
// echo $content."<br>";
// echo $nav."<br>";
// echo $tegs."<br>";
// print_r($_FILES);
// die();
if(!empty($_FILES['img280x200']['name'])) {
	$img280x200 = '/images/block/img280x200/'.$date.$_FILES['img280x200']['name'];
} else {
	if(isset($_POST['image_short'])) {
		$img280x200 = $_POST['image_short'];
	} else {
		$img280x200 = '/images/block/280x200.png';
	}
}
if(!empty($_FILES['imgBig']['name'])) {
	$imgBig = '/images/block/imgBig/'.$date.$_FILES['imgBig']['name'];
} else {
	if(isset($_POST['image_big'])) {
		$imgBig = $_POST['image_big'];
	} else {
		$imgBig = '/images/block/big.png';
	}
}

if ($_SESSION['is_admin_ses']) {
if (($user_id == $_SESSION['id_ses'] && $nickname == $_SESSION['login_ses']) || $_POST['adminka']) {
	if (
		!empty($title) &&
		!empty($short_content) &&
		!empty($content) &&
		!empty($nav) &&
		!empty($tegs)) {
		$query = $connect->query("INSERT INTO news (
			title,
			short_content,
			content,
			image_short,
			image_big,
			author,
			nav,
			tegs)
				VALUES ('".$title."',
						'".$short_content."',
						'".$content."',
						'".$img280x200."',
						'".$imgBig."',
						'".$nickname."',
						'".$nav."',
						'".$tegs."')");

		if(isset($_FILES['img280x200'])) {
			move_uploaded_file($_FILES['img280x200']['tmp_name'], '../images/block/img280x200/'.$date.$_FILES['img280x200']['name']);
		}
		if(isset($_FILES['imgBig'])) {
			move_uploaded_file($_FILES['imgBig']['tmp_name'], '../images/block/imgBig/'.$date.$_FILES['imgBig']['name']);
		}

		if ($_POST['pre_news_id']) {
			$query = $connect->query("DELETE FROM pre_news WHERE id='".$_POST['pre_news_id']."'");
		}

		header('location: /');
	} else {
		header('location: /addNews?error1neVashPost');
		exit();
	}
} else {
	header('location: /addNews?error');
	exit();
}
} else {
	if ($user_id == $_SESSION['id_ses'] && $nickname == $_SESSION['login_ses']) {
	if (
		!empty($title) &&
		!empty($short_content) &&
		!empty($content) &&
		!empty($nav) &&
		!empty($tegs)) {
		$query = $connect->query("INSERT INTO pre_news (
			title,
			short_content,
			content,
			image_short,
			image_big,
			author,
			nav,
			tegs)
				VALUES ('".$title."',
						'".$short_content."',
						'".$content."',
						'".$img280x200."',
						'".$imgBig."',
						'".$nickname."',
						'".$nav."',
						'".$tegs."')");

						if(isset($_FILES['img280x200'])) {
							move_uploaded_file($_FILES['img280x200']['tmp_name'], '../images/block/img280x200/'.$date.$_FILES['img280x200']['name']);
						}
						if(isset($_FILES['imgBig'])) {
							move_uploaded_file($_FILES['imgBig']['tmp_name'], '../images/block/imgBig/'.$date.$_FILES['imgBig']['name']);
						}

		header('location: /');
	} else {
		header('location: /addNews?error1');
		exit();
	}
} else {
	header('location: /addNews?error');
	exit();
}
}

?>
