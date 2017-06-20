<?php
	if (isset($_POST['p'])) {
		$p = $_POST['p'];
	}
	switch ($p) {
		case 1:
			echo "<div id='content_left'>";
			foreach ($news as $key => $value) {
				$navig = '';
				if ($value['nav'] == 'urgent') {
					$navig = 'urgent';
				} elseif ($value['nav'] == 'funny') {
					$navig = 'funny';
				} else {
					$navig = 'standart';
				}
				$sc = mb_substr($value['short_content'], 0, 115, 'UTF-8');
				if ($sc != $value['short_content']) {
					$dots = '...';
				} else {
					$dots = '';
				}
				echo "<div class='block ".$navig."'>
				<img src='".$value['image_short']."' alt='".$value['title']."' class='block-img'>
				<h3><a href='/news/".$value['id']."'>".$value['title']."</a></h3>
				<p class='block_sc'>".$sc.$dots."</p>
				<div class='block_footer'>
					<div class='tegs'>
					";
					$tegs = explode('/', $value['tegs']);
					foreach ($tegs as $key => $teg) {
						echo "<div class='teg'>".$teg."</div>";
					}
					echo "
					</div>
					<p class='block_time'>".$value['time']."</p>
					<p class='block_aut'>".$value['author']."</p></div></div>";
			}
			echo '</div>';
			break;

		case 2:
		case 3:
			echo "<div id='content_left'>";
			foreach ($news as $key => $value) {
				$sc = substr($value['short_content'], 0, 210);
				if ($sc != $value['short_content']) {
					$dots = '...';
				} else {
					$dots = '';
				}
				echo "<div class='block'>
				<img src='".$value['image_short']."' alt='".$value['title']."' class='block-img'>
				<h3><a href='/news/".$value['id']."'>".$value['title']."</a></h3>
				<p class='block_sc'>".$sc.$dots."</p>
				<div class='block_footer'>
					<div class='tegs'>
					";
					$tegs = explode('/', $value['tegs']);
					foreach ($tegs as $key => $teg) {
						echo "<div class='teg'>".$teg."</div>";
					}
					echo "
					</div>
					<p class='block_time'>".$value['time']."</p>
					<p class='block_aut'>".$value['author']."</p></div></div>";
			}
			echo '</div>';
			break;

		case 4:
			echo "<div id='content_left'>";
			foreach ($news as $key => $value) {
				echo "	<div id='one-block'>
							<div id='one-header'>
								<div id='one-block-info'>
									<p id='one-author'>".$value['author']."</p>
									<p id='one-time'>".$value['time']."</p>
								</div>
								<div id='one-block-img-title'>
									<div id='one-block-img'>
										<img src='".$value['image_big']."' alt='img'>
									</div>
									<div id='one-block-title'>
										<h2>".$value['title']."</h2>
									</div>
								</div>
							</div>
							<p id='one-content'>".$value['content']."</p>
						<div id='comments'>";
				if ($log) {
				echo "	<h3>Оставить комментарий</h3>
							<input type='hidden' name='num_news' id='num_news' value='".$id."'>
							<input type='hidden' name='nickname' id='nickname' value='".$log."'>
							<input type='hidden' name='user_id' id='user_id' value='".$id_user."'>
							<textarea name='new_comment' id='new_comment_area'></textarea>
							<button id='send_new_comment'>Отправить</button>
				"; } else { }
				echo "
						<h3>Комментарии</h3>
						";
				foreach ($comments as $key => $value) {
					$aut = explode('/', $value['author']);
					echo "
						<div class='comment'>
							<div class='com-head'>
								<p class='com-time'>".$value['time']."</p>
								<p class='com-aut'>".$aut[0]."</p>
							</div>
							<div class='com-text'>".$value['text']."</div>
						</div>


					";
				}
				echo "		</div>
						</div>
						";
			}
			echo '</div>';
			break;
		case 5:
			echo "<div id='content_left'>";
			if (!$admin_ses) {
			echo '
				<h2>Предложить новость</h2>
				<form enctype="multipart/form-data" action="/php/addNews.php" method="post">
					<input type="hidden" name="nickname" id="nickname" value="'.$log.'">
					<input type="hidden" name="user_id" id="user_id" value="'.$id_user.'">
					<p class="about_input">Заголовок</p>
					<textarea name="title" id="title_form"></textarea>
					<p class="about_input">Короткий контент</p>
					<p class="mark_input">Максимум 115 символов</p>
					<textarea name="short_content" id="short_content_area"></textarea>
					<p class="about_input">Контент</p>
					<textarea name="content" id="content_area"></textarea>
					<p class="about_input">Картинка 280х200</p>
					<input type="file" name="img280x200">
					<p class="about_input">Большая картинка</p>
					<input type="file" name="imgBig">
					<p class="about_input">Тип новости</p>
					<select name="nav_select" id="nav_select">
						<option value=" " selected>Обычная</option>
						<option value="urgent">Срочная</option>
						<option value="funny">Забавная</option>
					</select>
					<p class="about_input">Теги</p>
					<p class="mark_input">Вводить через /</p>
					<input type="text" id="tegs_input" name="tegs_input">
					<button>Предложить</button>
				</form>
			';
			} else {
			echo '
				<h2>Добавить новость</h2>
				<form enctype="multipart/form-data" action="/php/addNews.php" method="post">
					<input type="hidden" name="nickname" id="nickname" value="'.$log.'">
					<input type="hidden" name="user_id" id="user_id" value="'.$id_user.'">
					<p class="about_input">Заголовок</p>
					<textarea name="title" id="title_form"></textarea>
					<p class="about_input">Короткий контент</p>
					<p class="mark_input">Максимум 200 символов</p>
					<textarea name="short_content" id="short_content_area"></textarea>
					<p class="about_input">Контент</p>
					<textarea name="content" id="content_area"></textarea>
					<p class="about_input">Картинка 280х200</p>
					<input type="file" name="img280x200">
					<p class="about_input">Большая картинка</p>
					<input type="file" name="imgBig">
					<p class="about_input">Тип новости</p>
					<select name="nav_select" id="nav_select">
						<option value=" " selected>Обычная</option>
						<option value="urgent">Срочная</option>
						<option value="funny">Забавная</option>
					</select>
					<p class="about_input">Теги</p>
					<p class="mark_input">Вводить через /</p>
					<input type="text" id="tegs_input" name="tegs_input">
					<button>Добавить</button>
				</form>
			';
			}
			echo "</div>";

			break;

		//admin
		case 6:

			require_once '/php/admin/admin.php';
			if ($pre) {
				$counter = 1;
				echo "<div id='content'>";

				if (!$id) {
					echo "<table>";
						echo "<tr>";
							echo "<th id='number'>Номер</th>";
							echo "<th id='author'>Автор</th>";
							echo "<th id='title'>Заголовок</th>";
							echo "<th id='time'>Дата</th>";
							echo "<th id='news'>Перейти</a></th>";
						echo "</tr>";
					foreach ($news as $key => $value) {
						echo "<tr>";
						echo "<td>".$counter."</td><td>".$value['author']."</td><td>".$value['title']."</td><td>".$value['time']."</td><td><a href='/admin/pre_news/".$value['id']."'>Перейти</a></td>";
						echo "</tr>";
						$counter++;
					}
					echo "</table>";
				} else {
					foreach ($news as $key => $value) {
						echo "<pre>";
						print_r($value);
						echo "</pre>";
					}

					echo "<h3>PRE-VIEW [block]</h3>";

				// BLOCK

					$navig = '';
					if ($value['nav'] == 'urgent') {
						$navig = 'urgent';
					} elseif ($value['nav'] == 'funny') {
						$navig = 'funny';
					} else {
						$navig = 'standart';
					}
					$sc = mb_substr($value['short_content'], 0, 115, 'UTF-8');
					if ($sc != $value['short_content']) {
						$dots = '...';
					} else {
						$dots = '';
					}
					echo "<div class='block ".$navig."'>
					<img src='".$value['image_short']."' alt='".$value['title']."' class='block-img'>
					<h3><a href='/news/".$value['id']."'>".$value['title']."</a></h3>
					<p class='block_sc'>".$sc.$dots."</p>
					<div class='block_footer'>
						<div class='tegs'>
						";
						$tegs = explode('/', $value['tegs']);
						foreach ($tegs as $key => $teg) {
							echo "<div class='teg'>".$teg."</div>";
						}
						echo "
						</div>
						<p class='block_time'>".$value['time']."</p>
						<p class='block_aut'>".$value['author']."</p></div></div>";

// $navig = '';
// 				if ($value['nav'] == 'urgent') {
// 					$navig = 'urgent';
// 				} elseif ($value['nav'] == 'funny') {
// 					$navig = 'funny';
// 				} else {
// 					$navig = '';
// 				}
// 				$sc = substr($value['short_content'], 0, 210);
// 				if ($sc != $value['short_content']) {
// 					$dots = '...';
// 				} else {
// 					$dots = '';
// 				}
// 				echo "<div class='block ".$navig."'>
// 				<h3><a href='/admin/pre_news/".$value['id']."'>".$value['title']."</a></h3>
// 				<p class='block_sc'>".$sc.$dots."</p>
// 				<div class='block_footer'>
// 					<div class='tegs'>
// 					";
// 					$tegs = explode('/', $value['tegs']);
// 					foreach ($tegs as $key => $teg) {
// 						echo "<div class='teg'>".$teg."</div>";
// 					}
// 					echo "
// 					</div>
// 					<p class='block_time'>".$value['time']."</p>
// 					<p class='block_aut'>".$value['author']."</p></div></div>";

				// block
					echo "<h3>PRE-VIEW [news]</h3>";
					echo "	<div id='one-block'>
							<div id='one-header'>
							<div id='one-block-info'>
								<p id='one-author'>".$value['author']."</p>
								<p id='one-time'>".$value['time']."</p>
							</div>
							<div id='one-block-img-title'>
								<div id='one-block-img'>
									<img src='".$value['image_big']."' alt='img'>
								</div>
								<div id='one-block-title'>
									<h2>".$value['title']."</h2>
								</div>
							</div>
							</div>
							<p id='one-content'>".$value['content']."</p></div>";
				}

				if($id) {
					echo "<h2 id='succunsucc'>Подтвердить \ Отклонить</h2>";
					echo "<form action='/php/addNews.php' method='post'>";
					echo "<input type='hidden' name='author' value='".$value['author']."'>";
					echo "<input type='hidden' name='adminka' value='1'>";
					echo "<input type='hidden' name='pre_news_id' value='".$value['id']."'>";
					echo "<input type='hidden' name='title' value='".$value['title']."'>";
					echo "<input type='hidden' name='short_content' value='".$value['short_content']."'>";
					echo "<input type='hidden' name='content' value='".$value['content']."'>";
					echo "<input type='hidden' name='image_short' value='".$value['image_short']."'>";
					echo "<input type='hidden' name='image_big' value='".$value['image_big']."'>";
					echo "<input type='hidden' name='nav_select' value='".$value['nav']."'>";
					echo "<input type='hidden' name='tegs_input' value='".$value['tegs']."'>";
					echo "<button id='suc' class='suc_but' name='success'>Одобрить</button>";
					echo "<button id='unsuc' class='suc_but' name='unsuccess'>Отклонить</button>";
					echo "<p>Причина</p>";
					echo "<textarea name='unsuc' id='unsuc_area'></textarea>";
				}

				echo "</div>";
			} elseif ($mess) {
						echo "<div id='content'>";
				echo "<table>";
						echo "<tr>";
							echo "<th id='number'>Номер</th>";
							echo "<th id='author'>Автор</th>";
							echo "<th id='title'>Заголовок</th>";
							echo "<th id='time'>Дата</th>";
							echo "<th id='news'>Перейти</a></th>";
						echo "</tr>";
					foreach ($mess as $key => $value) {
						echo "<tr>";
						echo "<td>".$counter."</td><td>".$value['name']."</td><td>".$value['title']."</td><td>".$value['time']."</td><td><a href='/admin/pre_news/".$value['id']."'>Перейти</a></td>";
						echo "</tr>";
						$counter++;
					}
					echo "</table></div>";

			}
			break;
		case 404:

			require_once '/php/404.php';
			break;
		default:
			break;
	}

?>
