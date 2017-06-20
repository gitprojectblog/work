<?php 

$connect = mysqli_connect(
	'localhost', // адрес
	'root', // логин
	'', // пароль
	'blog'); // база данных

if ( $connect == falce ) {
	echo 'Ошибка подключения: '.mysqli_connect_error();
	exit();
}

?>