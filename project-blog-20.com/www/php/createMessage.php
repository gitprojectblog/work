<?php 

require 'config.php';

$req = $_POST['uri'];
$name = $_POST['login'];
$title = $_POST['title'];
$text = $_POST['textarea'];

if (!empty($name) && !empty($text)) {
	$query = $connect->query("INSERT INTO message (name,title,text)
			VALUES ('".$name."','".$title."','".$text."')");
		header("Location: ".$req);
		exit();
} else {
	header("Location: ".$req."?error=vvediteImyaIliText");
	exit();
}

?>