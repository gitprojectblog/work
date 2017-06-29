<?php 

	require_once 'config.php';

	$login = $_POST['login'];
	$pass = $_POST['pass'];
	$req = $_POST['uri'];

	if(!empty($login) && !empty($pass)) {
		$que = $connect->query('SELECT id, login, password, isAdmin FROM user_list WHERE login="'.$login.'"');
		$row = $que->fetch_assoc();
		
		if($row['login'] == $login && $row['password'] == $pass) {
			session_start();
			$_SESSION['login_ses'] = $_POST['login'];
			$_SESSION['id_ses'] = $row['id'];
			$_SESSION['is_admin_ses'] = $row['isAdmin'];
			header("Location: ".$req);
			exit();
		} else {
			header("Location: ".$req."?error=1");	
		}
	} else {
		header("location: /?ne-balui");
	}
?>