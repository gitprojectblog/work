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
} elseif ($gender == 1) {
	$gender = 'Мужской';
} else {
	$gender = 'Женский';
}

$que = $connect->query('SELECT login FROM user_list');
	$row = $que->fetch_assoc();

	if ($row['login'] == $login) {
		header("Location: ".$req."?error=login");
		exit();
	} else {
		$query = $connect->query("INSERT INTO user_list (login,mail,password,fname,lname,gender)
			VALUES ('".$login."','".$mail."','".$pass."','".$name."','".$lname."','".$gender."')");
		session_start();
		$_SESSION['login'] = $login;
		header("Location: ".$req);
		exit();
	}

?>