<?php

	$get = explode('?', $uri);
	$path = explode('/', $get[0]);

	if ($path[1] == 'last' || $path[1] == '') {
		$p = 1;
	} elseif ($path[1] == 'urgent') {
		$p = 2;
		$nav = 'urgent';
	} elseif ($path[1] == 'funny') {
		$p = 3;
		$nav = 'funny';
	} elseif ($path[1] == 'news') {
		$p = 4;
		$id = $path[2];
	} elseif ($path[1] == 'addNews') {
		$p = 5;
		if ($path[2] == 'pre') {
			$pre = true;
		}
	} elseif ($path[1] == 'admin') {
		if ($admin_ses) {
			$p = 6;
			if($path[2] == 'pre_news') {
				$pre = true;
				if ($path[3]) {
					$id = $path[3];
				}
			}
			if($path[2] == 'messages') {
				$mess = true;
			}
		} else {
			$p = 404;
		}
	} elseif ($path[1] == 'profile') {
		if (!empty($path[2])) {
			$p = 7;
			$nick = $path[2];
		}
	} elseif ($path[1] == 'search') {
		$p = 8;
	}
	else {
		$p = 404;
	}

?>
