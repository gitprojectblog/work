<?php 

session_start();
$req = $_POST['uri'];
session_destroy();
header('location: '.$req);

?>