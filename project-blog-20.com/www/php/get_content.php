<?php

	require 'config.php';

	$news = array();
	$comments = array();
	if (isset($_POST['p'])) {
		$p = $_POST['p'];
	}
	switch ($p) {
		case 1:
			$que = $connect->query("SELECT * FROM news ORDER BY time DESC LIMIT 10");
			while ($row = $que->fetch_assoc()) {
				$news[] = $row;
			}
			// print_r($news);
			break;

		case 2:
		case 3:
			$que = $connect->query("SELECT * FROM news WHERE nav='".$nav."' ORDER BY time DESC LIMIT 10");
			while ($row = $que->fetch_assoc()) {
				$news[] = $row;
			}
			// print_r($news);
			break;

		case 4:
			$que = $connect->query("SELECT * FROM news WHERE id=".$id."");
			while ($row = $que->fetch_assoc()) {
				$news[] = $row;
			}
			$que = $connect->query("SELECT * FROM comments WHERE id_news=".$id."");
			while ($row = $que->fetch_assoc()) {
				$comments[] = $row;
			}
			// print_r($news);
			break;

		case 5:

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
		case 404:

			break;
		default:
			break;
	}

?>
