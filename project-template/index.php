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
		<div class="filmSearchDiv" >

			<form action="../cgi/search.php" method="GET">
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
						<li><a href="cgi/filters/year/yearFilter.php">Выбор по году</a></li>
						<li><a href="cgi/index.php">Вход</a></li>
					</ul>
			</nav>
		</div>
	</div>





	<div class="footer">
		<div class="copy">&#169; ICS-media <?php echo date('Y'); ?></div>
		<span class="media"><a href=""><img src="../img/inst.png"></a> <a href="https://t.me/joinchat/KIDuQh0XguS1gSAbg-YkWg"><img src="../img/telega.png"></a></span>
	</div>


</body>
</html>