<?php 
//cart_model.php
include 'config.php';
	// Подключение к БД
	$mysqli = mysqli_connect(
		$dbhost, 
		$dbuser, 
		$dbpass, 
		$dbname);
	// Обработка ошибок подключения

	if (count($_SESSION['cart'])) {
		$subSQL = implode(" OR `goods`.`id`=", array_keys($_SESSION['cart']));
		// Выполнение запроса к БД
		$sSQL = "SELECT 
		`goods`.`id`, 
		`goods`.`name`,
		`goods`.`price`,
		`goods`.`description`,
		`categories`.`name` as `category_name`
		FROM `goods`,`categories` WHERE `id_category`=`categories`.`id` AND (`goods`.`id`= $subSQL)";
		$res = mysqli_query($mysqli, $sSQL);
		// Обработка результатов
		while ($good = mysqli_fetch_assoc($res)) {
			$cart_goods[] = $good;
		}
		
		// Закрываем соединение
		mysqli_close($mysqli);
	}

 ?>