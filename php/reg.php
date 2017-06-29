<?php

require 'config.php';

$req = $_POST['uri'];
$login = $_POST['login'];
$pass = $_POST['pass'];
$mail = $_POST['mail'];
$name = $_POST['firstname'];
$lname = $_POST['lastname'];
$gender = $_POST['gender'];

if ($gender == '0') {
	$gender = '-';
	$avatar = '/images/avatar/avatar_undefined.png';
} elseif ($gender == 1) {
	$gender = 'Мужской';
	$avatar = '/images/avatar/avatar_male.jpg';
} else {
	$gender = 'Женский';
	$avatar = '/images/avatar/avatar_female.jpg';
}

$que = $connect->query('SELECT login FROM user_list');
	$row = $que->fetch_assoc();

	if ($row['login'] == $login) {
		header("Location: ".$req."?error=login");
		exit();
	} else {
		$query = $connect->query("INSERT INTO user_list (login,mail,password,fname,lname,avatar,gender)
			VALUES ('".$login."','".$mail."','".$pass."','".$name."','".$lname."','".$avatar."','".$gender."')");
		session_start();
		$_SESSION['login'] = $login;
		header("Location: ".$req);
		exit();
	}

?>
