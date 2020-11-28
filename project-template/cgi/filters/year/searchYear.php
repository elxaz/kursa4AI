<?php 
	require_once '../../db.php';

	$year = $_GET['yearSelect'];

	$films = R::getAll('SELECT * FROM `film` WHERE `year` = ?', [$year]);//запрос к базе данных

	if(!empty($films)){//проверка на то что фильмы или фильм возвращаеться и базы
		
		$newId = [];//массив который будет хранить в себе айдишки фильмов
	
		foreach ($films as $key => $value) {//переписывайем айдишки в массив
			$newId[$key] = $value['id'];
		}

		$type = 'type=yearFilter';//задаем тип передаваемого на show.php

		$id = "";

	    foreach ($newId as $value) {
	    	$id .="&id[]=".$value;
	    }

	    $url = $type.$id;

	 	header("Location: http://localhost:8080/cgi/show.php?$url");//посылание гет запроса	
	}else{
		echo "Такого года не найдено";
	}

	


 ?>