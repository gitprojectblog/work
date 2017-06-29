<?php
	if (isset($_POST['p'])) {
		$p = $_POST['p'];
	}
	switch ($p) {
		case 1:
			echo "<div id='header-most-popular'>";
			require_once 'show_most_views_news.php';
			echo "</div>";
			echo "<div id='content_left'>";
			foreach ($news as $key => $value) {
				$time_now = date('Y-m-d-G-i-s');
				$time_explode = explode('-', $time_now);
				$time_now =
				$time_explode[0] * 12 * 30 * 24 * 60 * 60 +
				$time_explode[1] * 30 * 24 * 60 * 60 +
				$time_explode[2] * 24 * 60 * 60 +
				$time_explode[3] * 60 * 60 +
				$time_explode[4] * 60 +
				$time_explode[5];

				$time_news_1 = explode(' ', $value['time']);
				$time_news_l = explode('-', $time_news_1[0]);
				$time_news_r = explode(':', $time_news_1[1]);
				$time_news =
				$time_news_l[0] * 12 * 30 * 24 * 60 * 60 +
				$time_news_l[1] * 30 * 24 * 60 * 60 +
				$time_news_l[2] * 24 * 60 * 60 +
				$time_news_r[0] * 60 * 60 +
				$time_news_r[1] * 60 +
				$time_news_r[2];

				$time_dif = $time_now - $time_news;
				if ($time_dif < 60) {
					$time_news = $time_dif." сек. назад";
				} else {
					if ($time_dif < 3600) {
						$time_news = floor($time_dif / 60)." мин. назад";
					} else {
						if ($time_dif < 86400) {
							$time_news = floor($time_dif / 60 / 60 )." час. назад";
						} else {
							if ($time_dif < 172800 && $time_dif >= 86400) {
								$time_news = "Вчера в ".$time_news_r[0].":".$time_news_r[1]."";
							} else {
								if ($time_dif < 2592000) {
									$time_news = floor($time_dif / 60 / 60 / 24)." дней назад.";
								} else {
									if ($time_dif < 31104000) {
										$time_news = floor($time_dif / 60 / 60 / 24 / 24)." месяцев назад";
									} else {
										if ($time_dif < 62208000) {
											$time_news = "Более года назад";
										} else {
											$time_news = "Более пары лет назад";
										}
									}
								}
							}
						}
					}
				}
				// echo $time_dif;
				$navig = '';
				if ($value['nav'] == 'urgent') {
					$navig = 'urgent';
				} elseif ($value['nav'] == 'funny') {
					$navig = 'funny';
				} else {
					$navig = 'standart';
				}
				$sc = mb_substr($value['short_content'], 0, 110, 'UTF-8');
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
					<p class='block_time'>".$time_news.", Рейтинг: <span>".$value['raiting']."</span>, Просмотров: <span>".$value['views']."</span></p>
					<p class='block_aut'><a href='/profile/".$value['author']."'>".$value['author']."</a></p></div></div>";
			}
			echo '</div>';
			break;

		case 2:
		case 3:
			echo "<div id='header-most-popular'>";
			require_once 'show_most_views_news.php';
			echo "</div>";
			echo "<div id='content_left'>";
			foreach ($news as $key => $value) {
				$time_now = date('Y-m-d-G-i-s');
				$time_explode = explode('-', $time_now);
				$time_now =
				$time_explode[0] * 12 * 30 * 24 * 60 * 60 +
				$time_explode[1] * 30 * 24 * 60 * 60 +
				$time_explode[2] * 24 * 60 * 60 +
				$time_explode[3] * 60 * 60 +
				$time_explode[4] * 60 +
				$time_explode[5];

				$time_news_1 = explode(' ', $value['time']);
				$time_news_l = explode('-', $time_news_1[0]);
				$time_news_r = explode(':', $time_news_1[1]);
				$time_news =
				$time_news_l[0] * 12 * 30 * 24 * 60 * 60 +
				$time_news_l[1] * 30 * 24 * 60 * 60 +
				$time_news_l[2] * 24 * 60 * 60 +
				$time_news_r[0] * 60 * 60 +
				$time_news_r[1] * 60 +
				$time_news_r[2];

				$time_dif = $time_now - $time_news;
				if ($time_dif < 60) {
					$time_news = $time_dif." сек. назад";
				} else {
					if ($time_dif < 3600) {
						$time_news = floor($time_dif / 60)." мин. назад";
					} else {
						if ($time_dif < 86400) {
							$time_news = floor($time_dif / 60 / 60 )." час. назад";
						} else {
							if ($time_dif < 172800 && $time_dif >= 86400) {
								$time_news = "Вчера в ".$time_news_r[0].":".$time_news_r[1]."";
							} else {
								if ($time_dif < 2592000) {
									$time_news = floor($time_dif / 60 / 60 / 24)." дней назад.";
								} else {
									if ($time_dif < 31104000) {
										$time_news = floor($time_dif / 60 / 60 / 24 / 24)." месяцев назад";
									} else {
										if ($time_dif < 62208000) {
											$time_news = "Более года назад";
										} else {
											$time_news = "Более пары лет назад";
										}
									}
								}
							}
						}
					}
				}
				$sc = mb_substr($value['short_content'], 0, 110, 'UTF-8');
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
					<p class='block_time'>".$time_news.", Рейтинг: <span>".$value['raiting']."</span>, Просмотров: <span>".$value['views']."</span></p>
					<p class='block_aut'><a href='/profile/".$value['author']."'>".$value['author']."</a></p></div></div>";
			}
			echo '</div>';
			break;

		case 4:
			$rait_plus = '';
			$rait_minus = '';
			require_once 'views.php';
			echo "<div id='content_left'>";
			foreach ($news as $key => $value) {
				$time_now = date('Y-m-d-G-i-s');
				$time_explode = explode('-', $time_now);
				$time_now =
				$time_explode[0] * 12 * 30 * 24 * 60 * 60 +
				$time_explode[1] * 30 * 24 * 60 * 60 +
				$time_explode[2] * 24 * 60 * 60 +
				$time_explode[3] * 60 * 60 +
				$time_explode[4] * 60 +
				$time_explode[5];

				$time_news_1 = explode(' ', $value['time']);
				$time_news_l = explode('-', $time_news_1[0]);
				$time_news_r = explode(':', $time_news_1[1]);
				$time_news =
				$time_news_l[0] * 12 * 30 * 24 * 60 * 60 +
				$time_news_l[1] * 30 * 24 * 60 * 60 +
				$time_news_l[2] * 24 * 60 * 60 +
				$time_news_r[0] * 60 * 60 +
				$time_news_r[1] * 60 +
				$time_news_r[2];

				$time_dif = $time_now - $time_news;
				if ($time_dif < 60) {
					$time_news = $time_dif." сек. назад";
				} else {
					if ($time_dif < 3600) {
						$time_news = floor($time_dif / 60)." мин. назад";
					} else {
						if ($time_dif < 86400) {
							$time_news = floor($time_dif / 60 / 60 )." час. назад";
						} else {
							if ($time_dif < 172800 && $time_dif >= 86400) {
								$time_news = "Вчера в ".$time_news_r[0].":".$time_news_r[1]."";
							} else {
								if ($time_dif < 2592000) {
									$time_news = floor($time_dif / 60 / 60 / 24)." дней назад.";
								} else {
									if ($time_dif < 31104000) {
										$time_news = floor($time_dif / 60 / 60 / 24 / 24)." месяцев назад";
									} else {
										if ($time_dif < 62208000) {
											$time_news = "Более года назад";
										} else {
											$time_news = "Более пары лет назад";
										}
									}
								}
							}
						}
					}
				}
				$users_raiting = explode(',', $value['users_raiting']);
				foreach ($users_raiting as $key => $value2) {
					$user_raing = explode('/', $value2);
						if($user_raing[0] == $id_user) {
							if($user_raing[1] == 1) {
								$rait_plus = "class='rait-plus'";
							} elseif ($user_raing[1] == -1) {
								$rait_minus = "class='rait-minus'";
							} else {
							}
						}
					}
				echo "	<div id='one-block'>
							<div id='one-header'>
								<div id='one-block-info'>
									<p id='one-author'><a href='/profile/".$value['author']."'>".$value['author']."</a></p>
									<p id='one-time'>".$time_news."</p>
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
							<div id='one-tegs'>
								";
								$tegs = explode('/', $value['tegs']);
								foreach ($tegs as $key => $value2) {
									echo "<div class='one-teg'>";
									echo "#".$value2;
									echo "</div>";
								}
							echo "
							</div>
							<div id='raiting'>
								<div id='rait'> Рейтинг:
									<input type='hidden' id='rait_news_id' value='".$id."'>
									<input type='hidden' id='rait_user_id' value='".$id_user."'>
									<div id='rait-plus' ".$rait_plus.">+</div>
									<div id='rait-counter'>".$value['raiting']."</div>
									<div id='rait-minus' ".$rait_minus.">-</div>
									<div id='rait_views'><span>Просмотров:</span> ".$value['views']."</div>
								</div>
							</div>
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
						<h3>Комментарии [<span id='com_counter'>".$com_counter."</span>]</h3>
						";
				foreach ($comments as $key => $value) {
					$time_now = date('Y-m-d-G-i-s');
					$time_explode = explode('-', $time_now);
					$time_now =
					$time_explode[0] * 12 * 30 * 24 * 60 * 60 +
					$time_explode[1] * 30 * 24 * 60 * 60 +
					$time_explode[2] * 24 * 60 * 60 +
					$time_explode[3] * 60 * 60 +
					$time_explode[4] * 60 +
					$time_explode[5];

					$time_news_1 = explode(' ', $value['time']);
					$time_news_l = explode('-', $time_news_1[0]);
					$time_news_r = explode(':', $time_news_1[1]);
					$time_news =
					$time_news_l[0] * 12 * 30 * 24 * 60 * 60 +
					$time_news_l[1] * 30 * 24 * 60 * 60 +
					$time_news_l[2] * 24 * 60 * 60 +
					$time_news_r[0] * 60 * 60 +
					$time_news_r[1] * 60 +
					$time_news_r[2];

					$time_dif = $time_now - $time_news;
					if ($time_dif < 60) {
						$time_news = $time_dif." сек. назад";
					} else {
						if ($time_dif < 3600) {
							$time_news = floor($time_dif / 60)." мин. назад";
						} else {
							if ($time_dif < 86400) {
								$time_news = floor($time_dif / 60 / 60 )." час. назад";
							} else {
								if ($time_dif < 172800 && $time_dif >= 86400) {
									$time_news = "Вчера в ".$time_news_r[0].":".$time_news_r[1]."";
								} else {
									if ($time_dif < 2592000) {
										$time_news = floor($time_dif / 60 / 60 / 24)." дней назад.";
									} else {
										if ($time_dif < 31104000) {
											$time_news = floor($time_dif / 60 / 60 / 24 / 24)." месяцев назад";
										} else {
											if ($time_dif < 62208000) {
												$time_news = "Более года назад";
											} else {
												$time_news = "Более пары лет назад";
											}
										}
									}
								}
							}
						}
					}
					$aut = explode('/', $value['author']);
					echo "
						<div class='comment'>
							<div class='com-head'>
								<p class='com-aut'><a href='/profile/".$aut[0]."'>".$aut[0]."</a></p>
								<p class='com-time'>".$time_news."</p>
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
		case 7:
			// post_counter = count of posts [int]
			// comments_counter = count of comments [int]
			// posts = all posts [array]
			// comments = all comments [array]
			// profile = all info of profile [array]
			echo "<div id='content_left'>";

			// header -> profile info
			// echo "<h1>".$profile['login']."</h1>";
			// echo "<pre>";
			// print_r($profile);
			// echo "</pre>";
			$time_now = date('Y-m-d-G-i-s');
			$time_explode = explode('-', $time_now);
			$time_now =
			$time_explode[0] * 12 * 30 * 24 * 60 * 60 +
			$time_explode[1] * 30 * 24 * 60 * 60 +
			$time_explode[2] * 24 * 60 * 60 +
			$time_explode[3] * 60 * 60 +
			$time_explode[4] * 60 +
			$time_explode[5];

			$time_news_1 = explode(' ', $profile['regTime']);
			$time_news_l = explode('-', $time_news_1[0]);
			$time_news_r = explode(':', $time_news_1[1]);
			$time_news =
			$time_news_l[0] * 12 * 30 * 24 * 60 * 60 +
			$time_news_l[1] * 30 * 24 * 60 * 60 +
			$time_news_l[2] * 24 * 60 * 60 +
			$time_news_r[0] * 60 * 60 +
			$time_news_r[1] * 60 +
			$time_news_r[2];

			$time_dif = $time_now - $time_news;
			if ($time_dif < 60) {
				$time_news = $time_dif." сек. назад";
			} else {
				if ($time_dif < 3600) {
					$time_news = floor($time_dif / 60)." мин. назад";
				} else {
					if ($time_dif < 86400) {
						$time_news = floor($time_dif / 60 / 60 )." час. назад";
					} else {
						if ($time_dif < 172800 && $time_dif >= 86400) {
							$time_news = "Вчера в ".$time_news_r[0].":".$time_news_r[1]."";
						} else {
							if ($time_dif < 2592000) {
								$time_news = floor($time_dif / 60 / 60 / 24)." дней назад.";
							} else {
								if ($time_dif < 31104000) {
									$time_news = floor($time_dif / 60 / 60 / 24 / 24)." месяцев назад";
								} else {
									if ($time_dif < 62208000) {
										$time_news = "Более года назад";
									} else {
										$time_news = "Более пары лет назад";
									}
								}
							}
						}
					}
				}
			}
			echo "<div id='profile_info'>
				<div id='left_profile_info'>
					<style>
						#left_profile_info {
							width: 200px;
							height: 200px;
							background: url('".$profile['avatar']."');
							background-size: cover;
						}
					</style>
				</div>
				<div id='right_profile_info'>
						<p class='profile_row'><span>id</span>".$profile['id']."</p>
						<p class='profile_row'><span>Логин</span>".$profile['login']."</p>
						<p class='profile_row'><span>Почта</span>".$profile['mail']."</p>
						<p class='profile_row'><span>Имя</span>".$profile['fname']."</p>
						<p class='profile_row'><span>Фамилия</span>".$profile['lname']."</p>
						<p class='profile_row'><span>Пол</span>".$profile['gender']."</p>
						<p class='profile_row'><span>Дата регистрации</span>".$time_news." ( ".$profile['regTime']." )</p>
				</div>
			</div>";

			echo "<div id='posts_info'>";
				echo "<h2>Количество постов: ".$post_counter."</h2>";
				if ($post_counter > 3) echo "<h4>Последние 3</h4>";
				if ($post_counter > 3) $stop_post = 3; else $stop_post = $post_counter;
				echo "<div id='posts_all'>";
					for ($i = 0; $i < $stop_post; $i++) {
						$time_now = date('Y-m-d-G-i-s');
						$time_explode = explode('-', $time_now);
						$time_now2 =
						$time_explode[0] * 12 * 30 * 24 * 60 * 60 +
						$time_explode[1] * 30 * 24 * 60 * 60 +
						$time_explode[2] * 24 * 60 * 60 +
						$time_explode[3] * 60 * 60 +
						$time_explode[4] * 60 +
						$time_explode[5];

						$time_news_1 = explode(' ', $posts[$i]['time']);
						$time_news_l = explode('-', $time_news_1[0]);
						$time_news_r = explode(':', $time_news_1[1]);
						$time_news =
						$time_news_l[0] * 12 * 30 * 24 * 60 * 60 +
						$time_news_l[1] * 30 * 24 * 60 * 60 +
						$time_news_l[2] * 24 * 60 * 60 +
						$time_news_r[0] * 60 * 60 +
						$time_news_r[1] * 60 +
						$time_news_r[2];

						$time_dif = $time_now2 - $time_news;
						if ($time_dif < 60) {
							$time_news = $time_dif." сек. назад";
						} else {
							if ($time_dif < 3600) {
								$time_news = floor($time_dif / 60)." мин. назад";
							} else {
								if ($time_dif < 86400) {
									$time_news = floor($time_dif / 60 / 60 )." час. назад";
								} else {
									if ($time_dif < 172800 && $time_dif >= 86400) {
										$time_news = "Вчера в ".$time_news_r[0].":".$time_news_r[1]."";
									} else {
										if ($time_dif < 2592000) {
											$time_news = floor($time_dif / 60 / 60 / 24)." дней назад.";
										} else {
											if ($time_dif < 31104000) {
												$time_news = floor($time_dif / 60 / 60 / 24 / 24)." месяцев назад";
											} else {
												if ($time_dif < 62208000) {
													$time_news = "Более года назад";
												} else {
													$time_news = "Более пары лет назад";
												}
											}
										}
									}
								}
							}
						}
						echo "<div class='post_block ".$posts[$i]['nav']."'>
							<div class='post_block_left'>
								<img src='".$posts[$i]['image_big']."'>
							</div>
							<div class='post_block_right'>
							<h4><a href='/news/".$posts[$i]['id']."'>".$posts[$i]['title']."</a></h4>
							<p class='post_short_content'>".$posts[$i]['short_content']."</p>";
							$tegs = explode('/', $posts[$i]['tegs']);
							foreach ($tegs as $key => $teg) {
								echo "<div class='teg'>".$teg."</div>";
							}
							echo "<p class='post_time'>".$time_news."</p>";
						echo "</div></div>";
					}
					$json_posts = json_encode($posts);
					echo "<input type='hidden' value='".$json_posts."' id='json_posts'>";
					if ($post_counter > 3) echo "<button id='load_all_posts'>Загрузить все посты</button>";
				echo "</div>";
			echo "</div>"; // posts_info
			// mid = last posts [3] and button
			// echo "<h1>Количество постов: ".$post_counter."</h1>";
			// echo "<h2>Последние 3</h2>";
			// echo "<pre>";
			// for ($i = 0; $i < 3; $i++) {
			// 	print_r($posts[$i]);
			// }
			// echo "</pre>";

			// footer = last comments [3] and button
			echo "<div id='comments_info'>";
			echo "<h2>Количество комментариев: ".$comments_counter."</h2>";
			if ($comments_counter > 3) echo "<h4>Последние 3</h4>";
			echo "<div id='comments_all'>";
				// foreach ($comments as $key => $value) {
				// 	echo "<div class='comment_block'>";
				// 	echo "<div class='comment_about_post'></div>";
				// 	echo "<div class='comment_block_info'>";
				// 	echo "<p class='hover_comment'>Комментарий к новости
				// 	<input type='hidden' id='about_post' value='".$value['id_news']."'></p>";
				// 	echo "<p class='comment_text'>".$value['text']."</p>";
				// 	echo "<p class='comment_time'>".$value['time']."</p>";
				// 	echo "</div></div>";
				// }
			if ($comments_counter > 3) {
				$stop_comments = 3;
			} else {
				$stop_comments = $comments_counter;
			}
			for ($i = 0; $i < $stop_comments; $i++) {
				$time_now = date('Y-m-d-G-i-s');
				$time_explode = explode('-', $time_now);
				$time_now2 =
				$time_explode[0] * 12 * 30 * 24 * 60 * 60 +
				$time_explode[1] * 30 * 24 * 60 * 60 +
				$time_explode[2] * 24 * 60 * 60 +
				$time_explode[3] * 60 * 60 +
				$time_explode[4] * 60 +
				$time_explode[5];

				$time_news_1 = explode(' ', $comments[$i]['time']);
				$time_news_l = explode('-', $time_news_1[0]);
				$time_news_r = explode(':', $time_news_1[1]);
				$time_news =
				$time_news_l[0] * 12 * 30 * 24 * 60 * 60 +
				$time_news_l[1] * 30 * 24 * 60 * 60 +
				$time_news_l[2] * 24 * 60 * 60 +
				$time_news_r[0] * 60 * 60 +
				$time_news_r[1] * 60 +
				$time_news_r[2];

				$time_dif = $time_now2 - $time_news;
				if ($time_dif < 60) {
					$time_news = $time_dif." сек. назад";
				} else {
					if ($time_dif < 3600) {
						$time_news = floor($time_dif / 60)." мин. назад";
					} else {
						if ($time_dif < 86400) {
							$time_news = floor($time_dif / 60 / 60 )." час. назад";
						} else {
							if ($time_dif < 172800 && $time_dif >= 86400) {
								$time_news = "Вчера в ".$time_news_r[0].":".$time_news_r[1]."";
							} else {
								if ($time_dif < 2592000) {
									$time_news = floor($time_dif / 60 / 60 / 24)." дней назад.";
								} else {
									if ($time_dif < 31104000) {
										$time_news = floor($time_dif / 60 / 60 / 24 / 24)." месяцев назад";
									} else {
										if ($time_dif < 62208000) {
											$time_news = "Более года назад";
										} else {
											$time_news = "Более пары лет назад";
										}
									}
								}
							}
						}
					}
				}
				echo "<div class='comment_block'>";
				echo "<div class='comment_about_post'></div>";
				echo "<div class='comment_block_info'>";
				echo "<p class='hover_comment'><a href='/news/".$comments[$i]['id_news']."'>Комментарий к новости</a>
				<input type='hidden' class='about_post' value='".$comments[$i]['id_news']."'></p>";
				echo "<p class='comment_text'>".$comments[$i]['text']."</p>";
				echo "<p class='comment_time'>".$time_news."</p>";
				echo "</div></div>";
			}
			echo "</div></div>";
			// echo "<pre>";
			// for ($i = 0; $i < 3; $i++) {
			// 	print_r($comments[$i]);
			// }
			// echo "</pre>";

			echo "</div>";
			break;
		case 8:
		echo "<div id='content_left'>";
		echo "<h2 id='h2-search'>По запросу '<span>".trim($_POST['text'])."</span>' было найдено <span>".$news_cout."</span> новостей</h2>";
		foreach ($news_out as $key => $value) {
			$time_now = date('Y-m-d-G-i-s');
			$time_explode = explode('-', $time_now);
			$time_now =
			$time_explode[0] * 12 * 30 * 24 * 60 * 60 +
			$time_explode[1] * 30 * 24 * 60 * 60 +
			$time_explode[2] * 24 * 60 * 60 +
			$time_explode[3] * 60 * 60 +
			$time_explode[4] * 60 +
			$time_explode[5];

			$time_news_1 = explode(' ', $value['time']);
			$time_news_l = explode('-', $time_news_1[0]);
			$time_news_r = explode(':', $time_news_1[1]);
			$time_news =
			$time_news_l[0] * 12 * 30 * 24 * 60 * 60 +
			$time_news_l[1] * 30 * 24 * 60 * 60 +
			$time_news_l[2] * 24 * 60 * 60 +
			$time_news_r[0] * 60 * 60 +
			$time_news_r[1] * 60 +
			$time_news_r[2];

			$time_dif = $time_now - $time_news;
			if ($time_dif < 60) {
				$time_news = $time_dif." сек. назад";
			} else {
				if ($time_dif < 3600) {
					$time_news = floor($time_dif / 60)." мин. назад";
				} else {
					if ($time_dif < 86400) {
						$time_news = floor($time_dif / 60 / 60 )." час. назад";
					} else {
						if ($time_dif < 172800 && $time_dif >= 86400) {
							$time_news = "Вчера в ".$time_news_r[0].":".$time_news_r[1]."";
						} else {
							if ($time_dif < 2592000) {
								$time_news = floor($time_dif / 60 / 60 / 24)." дней назад.";
							} else {
								if ($time_dif < 31104000) {
									$time_news = floor($time_dif / 60 / 60 / 24 / 24)." месяцев назад";
								} else {
									if ($time_dif < 62208000) {
										$time_news = "Более года назад";
									} else {
										$time_news = "Более пары лет назад";
									}
								}
							}
						}
					}
				}
			}
			// echo $time_dif;
			$navig = '';
			if ($value['nav'] == 'urgent') {
				$navig = 'urgent';
			} elseif ($value['nav'] == 'funny') {
				$navig = 'funny';
			} else {
				$navig = 'standart';
			}
			$sc = mb_substr($value['short_content'], 0, 110, 'UTF-8');
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
				<p class='block_time'>".$time_news.", Рейтинг: <span>".$value['raiting']."</span>, Просмотров: <span>".$value['views']."</span></p>
				<p class='block_aut'><a href='/profile/".$value['author']."'>".$value['author']."</a></p></div></div>";
		}
		echo '</div>';
			break;
		case 404:

			require_once '/php/404.php';
			break;
		default:
			break;
	}

?>
