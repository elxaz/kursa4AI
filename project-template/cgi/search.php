<?php 
		require_once 'db.php';
		$filmName = $_REQUEST['filmSearch'];	
		$film = R::find('film', 'name LIKE ?',["%$filmName%"]);
		foreach ($film as $film) {
		}
		$link = $film['link'];
		$poster = $film['poster'];
		$name = $film['name'];
		$description = $film['description'];
		?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=9, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styles/template.css">
	<link rel="shortcut icon" href="../img/smallest.png" type="image/x-icon">
	<title><?php echo "$filmName"; ?></title>
</head>
<body>
		<div class="header" align="center">
		<img src="../img/smalllogo.png" class="smalllogo">
		<div class="filmSearchDiv">
			<form action="search.php" method="GET">
				<input type="text" class="filmSearch" name="filmSearch" placeholder="Название фильма">
				<input type="submit" name="submit" value="Поиск" class="searchBtn">
			</form>
		</div>
		<div class="nav" align="center">
			<nav role = "navigation">
					<ul>
						<li><a href="">Случайный фильм</a></li>
						<li><a href="">Новинки</a></li>
						<li><a href="">Выбор по режисеру</a></li>
						<li><a href="">Жанры</a>
							<ul class="dropdown">
									<li><a href="">Комедия</a></li>
									<li><a href="">Сериалы</a></li>
									<li><a href="">Боевик</a></li>
									<li><a href="">Мелодрама</a></li>
							  		<li><a href="">Ужасы</a></li>
							  		<li><a href="">Драма</a></li>
							  		<li><a href="">Мультфильм</a></li>
							  		<li><a href="">Приключения</a></li>
							  		<li><a href="">. . .</a></li>	
							</ul>
						</li>		
						<li><a href="">Выбор по стране</a></li>
						<li><a href="">Выбор по году</a></li>
						<li><a href="">Выбор по актеру</a></li>
					</ul>
			</nav>
		</div>
	</div>




<!-- Вся страничка с контентом -->
<div class="film" align="center">

		<div class="filmHead">
			<!-- Постер -->
			<div class="poster">
				<img src="<?php echo "$poster" ?>" width="189" height="255" alt="lorem">
			</div>
			<div class="name" align="left">
			<!-- Имя фильма -->
				<h1><?php echo "$name"; ?></h1>
			</div>
			<div class="filmDescription" align="left">
				<p><?php echo "$description"; ?></p>
			</div>
		</div>
		<!-- Видео -->
		<div class="filmCenter">
			<iframe src="<?php echo "$link"; ?>" align="center" width="640" height="360" frameborder="0" allowfullscreen></iframe>
		</div>

		
		

</div>



	<div class="footer">
		<div class="copy">&#169; ICS-media 2020</div>
		<span class="media"><a href=""><img src="../img/inst.png"></a> <a href=""><img src="../img/telega.png"></a></span>
	</div>
		</body>	
</html>
