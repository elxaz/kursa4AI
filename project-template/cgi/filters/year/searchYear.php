<?php 
	require_once '../../db.php';

	function print_pre($arr){//функция для удобного вывода массивово(для отладки)
		echo "<pre>";
		print_r($arr);
		echo "</pre>"."<br>";

	}
	

	$year = $_GET['yearSelect'];

	$films = R::getAll('SELECT * FROM `film` WHERE `year` = ?', [$year]);//запрос к базе данных

	if(!empty($films)){//проверка на то что фильмы или фильм возвращаеться и базы
		$posters = [];//два масиива в которые мы будем записывать данные из массива $films
		$names = [];

		// print_pre($films);

		foreach ($films as $key => $value) {
				$names[$key] = $films[$key]['name'];
				$posters[$key] = $films[$key]['poster'];
		}	


		foreach ($posters as $key => $link) {
			echo "<img src=$link width=\"100\" height=\"150\">"."<br>";
			echo "$names[$key]"."<br>";
		}
		
		


	}else{
		echo "Такого года не найдено";
	}

	


 ?>