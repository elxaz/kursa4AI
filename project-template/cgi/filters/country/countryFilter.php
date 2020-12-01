<?php 
	require_once '../../db.php';
	if (isset($_GET) && !empty($_GET)) {
	
	$country = $_GET['country'];

	$films = R::getAll('SELECT * FROM `film` WHERE `country` = ?', [$country]);//запрос к базе данных

	if(!empty($films)){//проверка на то что фильмы или фильм возвращаеться и базы
		
		$newId = [];//массив который будет хранить в себе айдишки фильмов
	
		foreach ($films as $key => $value) {//переписывайем айдишки в массив
			$newId[$key] = $value['id'];
		}

		$type = 'type=countryFilter';//задаем тип передаваемого на show.php

		$id = "";

	    foreach ($newId as $value) {
	    	$id .="&id[]=".$value;
	    }

	    $url = $type.$id;

	 	header("Location: http://localhost:8080/cgi/show.php?$url");//посылание гет запроса	
	}else{
		echo "Такой страны не найдено";
	}

	}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Фильтр по стране</title>
	<link rel="stylesheet" type="text/css" href="../../../styles/reg.css">
	<link rel="stylesheet" type="text/css" href="../../../styles/template.css">
</head>
<body>
	<div class="header" align="center">

		<table border="0" width="100%" class="headerTable" >
		<th>
		<a href="../../../index.php"><img src="../../../img/smalllogo.png" class="smalllogo"></a>
		<a href="../../index.php"><img src="../../../img/login.png" class="loginImg"></a>
		</th>

		<th>
		<div class="dropdown">
		<button onclick="myFunction()" class="dropbtn">Фильтры</button>
		  <div id="myDropdown" class="dropdown-content">
		    <form method="GET" action="../../search.php">
		    	<input type="text" name="filmSearch" placeholder="Название фильма" id="myInput">
		    	<br>
		    	<input type="submit" name="btn" value="Поиск" id="myInputBtn">
		    </form>

		    <a href="../year/yearFilter.php">Фильтр по году</a>
		    <a href="../genre/genreFilter.php">Фильтр по жанру</a>
		    <a href="countryFilter.php">Фильтр по стране</a>
		    <a href="../../randomFilms.php">Что посмотреть</a>
		  </div>
		</div>
		</th>
		</table>
		<script>
		function myFunction() {
		    document.getElementById("myDropdown").classList.toggle("show");
		}
		</script>
	</div>
	<div class="reg">
		<h2>Фильтр по стране:</h2>
		<form method="GET" action="countryFilter.php">
			<input type="text" placeholder="Введите страну" name="country">
			<br><br>
			<input type="submit" class="countryBtn" name="btn">
		</form>
	</div>
</body>
</html>