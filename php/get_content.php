<?php

	require 'config.php';

	$news = array();
	$comments = array();
	$posts = array();
	$most_views = array();
	$most_rating = array();
	if (isset($_POST['p'])) {
		$p = $_POST['p'];
	}
	$count_week_news = 0;
	$new_array_popular_news = array();
	$time_array_popular_news = array();
	$que_week_news = $connect->query("SELECT * FROM news ORDER BY time DESC");
	while ($row = $que_week_news->fetch_assoc()) {
		$turn1 = explode(' ', $row['time']);
		$turn2 = explode('-', $turn1[0]);
		$turn3 = +$turn2[0] * 12 * 30 * 24 + +$turn2[1] * 30 * 24 + +$turn2[2] * 24;
		$now_date = date("Y-m-d");
		$turn4 = explode("-", $now_date);
		$turn5 = +$turn4[0] * 12 * 30 * 24 + +$turn4[1] * 30 * 24 + +$turn4[2] * 24;
		if (($turn3 - $turn5) >= -168) {
			$count_week_news++;
			$new_array_popular_news[] = $row;
			$time_array_popular_news[] = -($turn3 - $turn5);
			continue;
		} else {
			break;
		}
		// echo ( 2017 * 12 * 30 * 24 + 5 * 30 * 24 + 8 * 24 ) - ( 2017 * 12 * 30 * 24 + 5 * 30 * 24 + 1 * 24 );
	}
	// echo $count_week_news;
	// print_r($new_array_popular_news);
	$sort_popular_news = array();
	$sort_popular_news2 = array();
	// echo "<pre>";
	// print_r($new_array_popular_news);
	for($i = 0; $i < $count_week_news; $i++) {
		for($j = $i + 1; $j < $count_week_news; $j++) {
			if($time_array_popular_news[$i] == 0) $time_array_popular_news[$i] = 1;
			if($time_array_popular_news[$j] == 0) $time_array_popular_news[$j] = 1;
			if(+$new_array_popular_news[$i]['views'] / $time_array_popular_news[$i]/168 < +$new_array_popular_news[$j]['views'] / $time_array_popular_news[$j]/168) {
				$save = $new_array_popular_news[$i];
				$new_array_popular_news[$i] = $new_array_popular_news[$j];
				$new_array_popular_news[$j] = $save;
			}
		}
		$sort_popular_news[$i] = +$new_array_popular_news[$i]['raiting'] / $time_array_popular_news[$i]/168;
	}
	// print_r($new_array_popular_news);
	// print_r($time_array_popular_news);
	// print_r($sort_popular_news);
	for ($i = 0; $i < 3; $i++) {
		$most_views[$i] = $new_array_popular_news[$i];
	}

	for($i = 0; $i < $count_week_news; $i++) {
		for($j = $i + 1; $j < $count_week_news; $j++) {
			if($time_array_popular_news[$i] == 0) $time_array_popular_news[$i] = 1;
			if(+$new_array_popular_news[$i]['raiting'] / $time_array_popular_news[$i]/168 < +$new_array_popular_news[$j]['raiting'] / $time_array_popular_news[$j]/168) {
				$save = $new_array_popular_news[$i];
				$new_array_popular_news[$i] = $new_array_popular_news[$j];
				$new_array_popular_news[$j] = $save;
			}
		}
		$sort_popular_news2[$i] = +$new_array_popular_news[$i]['raiting'] / $time_array_popular_news[$i]/168;
	}
	for ($i = 0; $i < 3; $i++) {
		$most_rating[$i] = $new_array_popular_news[$i];
	}
	//
	// echo "<pre>";
	// print_r($sort_popular_news);
	// print_r($sort_popular_news2);
	// exit();

	switch ($p) {
		case 1:

			// $que = $connect->query("SELECT * FROM news ORDER BY views DESC LIMIT 3");
			// while ($row = $que->fetch_assoc()) {
			// 	$most_views[] = $row;
			// }
		  // $que = $connect->query("SELECT * FROM news ORDER BY raiting DESC LIMIT 3");
		  // while ($row = $que->fetch_assoc()) {
		  //   $most_rating[] = $row;
		  // }
			$que = $connect->query("SELECT * FROM news ORDER BY time DESC LIMIT 10");
			while ($row = $que->fetch_assoc()) {
				$news[] = $row;
			}
			// print_r($news);
			break;

		case 2:
		case 3:

			// $que = $connect->query("SELECT * FROM news ORDER BY views DESC LIMIT 3");
			// while ($row = $que->fetch_assoc()) {
			// 	$most_views[] = $row;
			// }
		  // $que = $connect->query("SELECT * FROM news ORDER BY raiting DESC LIMIT 3");
		  // while ($row = $que->fetch_assoc()) {
		  //   $most_rating[] = $row;
		  // }
			$que = $connect->query("SELECT * FROM news WHERE nav='".$nav."' ORDER BY time DESC LIMIT 10");
			while ($row = $que->fetch_assoc()) {
				$news[] = $row;
			}
			// print_r($news);
			break;

		case 4:

			// $que = $connect->query("SELECT * FROM news ORDER BY views DESC LIMIT 3");
			// while ($row = $que->fetch_assoc()) {
			// 	$most_views[] = $row;
			// }
		  // $que = $connect->query("SELECT * FROM news ORDER BY raiting DESC LIMIT 3");
		  // while ($row = $que->fetch_assoc()) {
		  //   $most_rating[] = $row;
		  // }
			if ($id > 0) {

			} else {
				$p = 404;
				break;
			}
			$que = $connect->query("SELECT * FROM news WHERE id=".$id."");
			if ($row = $que->fetch_assoc()) {
				$news[] = $row;
			} else {
				$p = 404;
				break;
			}
			while ($row = $que->fetch_assoc()) {
				$news[] = $row;
			}
			$que = $connect->query("SELECT * FROM comments WHERE id_news=".$id."");
			$com_counter = $que->num_rows;
			while ($row = $que->fetch_assoc()) {
				$comments[] = $row;
			}
			// print_r($news);
			break;

		case 5:

					// $que = $connect->query("SELECT * FROM news ORDER BY views DESC LIMIT 3");
					// while ($row = $que->fetch_assoc()) {
					// 	$most_views[] = $row;
					// }
				  // $que = $connect->query("SELECT * FROM news ORDER BY raiting DESC LIMIT 3");
				  // while ($row = $que->fetch_assoc()) {
				  //   $most_rating[] = $row;
				  // }
			break;
		// admin
		case 6:
			if (!$id) {
				$que = $connect->query("SELECT * FROM pre_news");
				while ($row = $que->fetch_assoc()) {
					$news[] = $row;
				}
			} else {
				$que = $connect->query("SELECT * FROM pre_news WHERE id='".$id."'");
				$row = $que->fetch_assoc();
				$news[] = $row;
			}

			if($mess) {
				$mess = array();
				$que = $connect->query("SELECT * FROM message");
				while ($row = $que->fetch_assoc()) {
					$mess[] = $row;
				}
			}
			break;
		case 7:

					// $que = $connect->query("SELECT * FROM news ORDER BY views DESC LIMIT 3");
					// while ($row = $que->fetch_assoc()) {
					// 	$most_views[] = $row;
					// }
				  // $que = $connect->query("SELECT * FROM news ORDER BY raiting DESC LIMIT 3");
				  // while ($row = $que->fetch_assoc()) {
				  //   $most_rating[] = $row;
				  // }
			$que = $connect->query("SELECT * FROM user_list WHERE login='".$nick."'");
			if($row = $que->fetch_assoc()) {
				$profile = $row;
				$que = $connect->query("SELECT * FROM news WHERE author='".$nick."' ORDER BY time DESC");
				$post_counter = 0;
				while($row = $que->fetch_assoc()) {
					$posts[] = $row;
					$post_counter++;
				}
				$que = $connect->query("SELECT * FROM comments WHERE author='".$nick."' ORDER BY time DESC");
				$comments_counter = 0;
				while ($row = $que->fetch_assoc()) {
					$comments[] = $row;
					$comments_counter++;
				}
			} else {
				$p = 404;
			}
			break;
		case 8:

			if ((isset($_POST['navig']) ||
					isset($_POST['navig2']) ||
					isset($_POST['navig3']) ||
					isset($_POST['navig4']) ||
					isset($_POST['navig5']))
			 && isset($_POST['text']) &&
			 		!empty($_POST['text']) &&
	 			  trim($_POST['text']) != '') {
				require_once 'search.php';
			} else {
				$p = 404;
			}

			break;
		case 404:

					// $que = $connect->query("SELECT * FROM news ORDER BY views DESC LIMIT 3");
					// while ($row = $que->fetch_assoc()) {
					// 	$most_views[] = $row;
					// }
				  // $que = $connect->query("SELECT * FROM news ORDER BY raiting DESC LIMIT 3");
				  // while ($row = $que->fetch_assoc()) {
				  //   $most_rating[] = $row;
				  // }
			break;
		default:
			break;
	}

?>
