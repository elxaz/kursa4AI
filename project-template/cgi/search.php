<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../styles/error.css">
</head>
<body>


	<?php 
		require_once 'db.php';
		$filmName = $_GET['filmSearch'];	
		$films = R::find('film', 'name = ?', [$filmName]);//выбираем все фильмы по даному имени 
		if(!empty($films)){//проверка на то что фильмы или фильм возвращаеться и базы
		
		$newId = [];//массив который будет хранить в себе айдишки фильмов
	
		foreach ($films as $key => $value) {//переписывайем айдишки в массив
			$newId[$key] = $value['id'];
		}

		$type = 'type=search';//задаем тип передаваемого на show.php

		$id = "";

	    foreach ($newId as $value) {
	    	$id .="&id[]=".$value;
	    }

	    $url = $type.$id;

	 	header("Location:show.php?$url");//посылание гет запроса	
	}else{
		echo "<div class=\"validation\">Фильма с таким названием не найдено</div>";

	}







?>


<a href="../index.php">Вернуться на главную страницу</a>
</body>
</html>

