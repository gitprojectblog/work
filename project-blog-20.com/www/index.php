<?php

session_start();
$log = $_SESSION['login_ses'];
$id_user = $_SESSION['id_ses'];
$admin_ses = $_SESSION['is_admin_ses'];

function getUri() {
	return $_SERVER['REQUEST_URI'];
}

$uri = getUri();

// files
require_once '/php/get_path.php';
require_once '/php/get_content.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>project.blog</title>
	<?php if ($p == 6 && $admin_ses):?>
	<link rel="stylesheet" href="/css/admin.css">
	<?php else:?>
	<link rel="stylesheet" href="/css/main.css">
	<?php endif;?>
	<?php
	if ($p == 5) {
		echo '<link rel="stylesheet" href="/css/addNews.css">';
	}
	?>
	<script src='/js/jquery-3.1.1.min.js'></script>
	<script src='/js/main.js'></script>
	<?php

	if ($p == 1 || $p == 2 || $p == 3) {
		echo "<script src='/js/scroll.js'></script>";
	}

	?>
</head>
<body class="dis_transition_none dis_transition">
<div id="background"></div>
<div id="background_header"></div>
<div id="scroll_top"></div>

	<?php if ($p != 6):?>
	<div id="wrap">
		<div id="header">
			<h1>Блог</h1>
			<div id="nav">
				<a <?php if($p == 1) echo 'id="select"';?> href="/">Последние</a>
				<a <?php if($p == 2) echo 'id="select"';?> href="/urgent">Срочные</a>
				<a <?php if($p == 3) echo 'id="select"';?> href="/funny">Забавные</a>
			</div>
			<div id="forms">
				<?php if ($admin_ses): ?>
				<a id='addNews' href="/addNews">Добавить новость</a>
				<?php else: ?>
					<?php if ($log): ?>
					<a id='addNews' href="/addNews">Предложить новость</a>
					<?php else: ?>
					<?php endif; ?>
				<?php endif; ?>
				<button id="obrSvz">Обратная связь</button>
				<?php if(!empty($log)):?>
				<a href="#"><b><?php echo $log;?></b></a>
				<form action="/php/exit.php" method='post'>
					<input type="hidden" name='uri' value='<?php echo $uri;?>'>
					<button>Выйти</button>
				</form>
				<?php else: ?>
				<button id="getIn">Вход</button>
				<button id="getReg">Регистрация</button>
				<?php endif; ?>
			</div>
		</div>
		<div id="content">
			<div id="content_wrap">
					<?php require_once '/php/output_content.php'; ?>
				<div id="content_right">

				</div>
			</div>
		</div>
		<div id="footer"></div>
	</div>

	<!-- forms -->
	<div id="blockObrSvz">
		<div class="remove">
		</div>
		<div id="form">
			<h2>Обратная связь</h2>
			<form action="/php/createMessage.php" method='post'>
				<input type="hidden" name='uri' value="<?php echo "$uri";?>">
				<p>Имя</p>
				<input type="text" name='login'>
				<p>Заголовок</p>
				<input type="text" name='title'>
				<p>Сообщение</p>
				<textarea name="textarea"></textarea>
				<button>Написать</button>
			</form>
		</div>
	</div>
	<div id="blockGetIn">
		<div class="remove">
		</div>
		<div id="form">
			<h2>Вход</h2>
			<form action="/php/login.php" method='post'>
				<input type="hidden" name='uri' value="<?php echo "$uri";?>">
				<p>Логин</p>
				<input type="text" name='login'>
				<p>Пароль</p>
				<input type="password" name='pass'>
				<button>Войти</button>
			</form>
		</div>
	</div>
	<div id="blockReg">
		<div class="remove">
		</div>
		<div id="form">
			<h2>Регистрация</h2>
			<p><span class="spanRed">*</span> - обязательные</p>
			<form action="/php/reg.php" method='post'>
				<input type="hidden" name='uri' value="<?php echo "$uri";?>">
				<p>Логин<span class="spanRed">*</span></p>
				<input type="text" name='login'>
				<p>Пароль<span class="spanRed">*</span></p>
				<input type="password" name='pass'>
				<p>Почта<span class="spanRed">*</span></p>
				<input type="mail" name='mail'>
				<p>Имя</p>
				<input type="text" name='firstname'>
				<p>Фамилия</p>
				<input type="text" name='lastname'>
				<p>Пол</p>
				<select name='gender'>
					<option value="0">Не выбран</option>
					<option value="1">Мужской</option>
					<option value="2">Женский</option>
				</select>
				<button>Зарегистрироваться</button>
			</form>
		</div>
	</div>
	<?php else:

		if ($admin_ses) {
			require_once '/php/output_content.php';
		}

	?>
	<?php endif; ?>


</body>
</html>
