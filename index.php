<?php 
 	require_once 'cgi/db.php';

 	$year = 2020;

 	$films = R::getAll('SELECT * FROM `film` WHERE `year` = ?', [$year]);

	//сбор массива из постеров

	$posters = [];
	

	foreach ($films as $key => $value) {
		$posters[$key] = $films[$key]['poster'];
		
	}

	


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ICS-media</title>
	<link rel="shortcut icon" href="img/smallest.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="styles/template.css">
</head>
<body>
	<div class="header" align="center">
		<img src="img/smalllogo.png" class="smalllogo">
		<a href="cgi/index.php"><img src="img/login.png" class="loginImg"></a>

		<div class="dropdown">
		<button onclick="myFunction()" class="dropbtn">Фильтры</button>
		  <div id="myDropdown" class="dropdown-content">
		    <form method="GET" action="cgi/search.php">
		    	<input type="text" name="filmSearch" placeholder="Название фильма" id="myInput">
		    	<input type="submit" name="btn" value="Поиск" id="myInputBtn">
		    </form>

		    <a href="cgi/filters/year/yearFilter.php">Фильтр по году</a>
		    <a href="cgi/randomFilms.php">Что посмотреть</a>
		    <a href="#blog">Blog</a>
		    <a href="#contact">Contact</a>
		    <a href="#custom">Custom</a>
		    <a href="#support">Support</a>
		    <a href="#tools">Tools</a>


		  </div>
		</div>
		<script>
		function myFunction() {
		    document.getElementById("myDropdown").classList.toggle("show");
		}
		</script>
	</div>

	<div class="footer">
		<div class="copy">&#169; ICS-media <?php echo date('Y'); ?></div>
		<span class="media"><a href=""><img src="../img/inst.png"></a> <a href="https://t.me/joinchat/KIDuQh0XguS1gSAbg-YkWg"><img src="../img/telega.png"></a></span>
	</div>


</body>
</html>