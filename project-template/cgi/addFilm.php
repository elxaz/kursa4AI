<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styles/template.css">
	<link rel="shortcut icon" href="../img/smallest.png" type="image/x-icon">
	<title>Addidng film</title>
</head>
<body>



	<div class="header" align="center">
		<img src="../img/smalllogo.png" class="smalllogo">
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
						<li><a href="index.php">Вход</a></li>
					</ul>
			</nav>
		</div>
	</div>

	 <div class="adder" align="center">
	 	<h2>Adding film</h2>
	 	<form method="POST">
	 	 	<input type="text" name="filmName" align="center" placeholder="Name" class="add"><br><br>
	 	 	<input type="text" name="filmURL" align="center"  placeholder="URL" class="add"><br><br>
	 	 	<input type="text" name="genre" align="center" placeholder="Genre" class="add"><br><br>
	 	 	<input type="text" name="year" align="center" placeholder="Year" class="add"><br><br>
	 	 	<input type="text" name="director" align="center"  placeholder="Director" class="add"><br><br>
	 	 	<input type="text" name="country" align="center"   placeholder="Country" class="add"><br><br>
	 	 	<input type="text" name="actor" align="center" placeholder="Actor" class="add"><br><br>
	 	 	<input type="text" name="poster" align="center" v  placeholder="Link to poster" class="add"><br><br>
	 	 	<input type="file" name="file" align="center" v  placeholder="Link to poster" class="add"><br>
	 	 	<?php if (@$_FILES['file']['name']==="new.txt.txt") {
	 	 		header('Location: www.google.com');  
	 	 	}
	 	 	?>
	 	 	<input type="textarea" name="description" align="center"  placeholder="Description" class="add"><br><br>

	 	 	<input type="submit" class="addBtn">
	 	</form>
	 </div>



	<div class="footer">
		<div class="copy">&#169; ICS-media 2020</div>
		<span class="media"><a href=""><img src="../img/inst.png"></a> <a href="https://t.me/joinchat/KIDuQh0XguS1gSAbg-YkWg"><img src="../img/telega.png"></a></span>
	</div>

	 <?php 	
	 	require_once 'db.php';
	 	@$filmName = $_REQUEST['filmName'];
	 	@$filmURL = $_REQUEST['filmURL'];
	 	@$filmGenre = $_REQUEST['genre'];
	 	@$filmYear = $_REQUEST['year'];
	 	@$filmDescription = $_REQUEST['description'];
	 	@$filmDirector = $_REQUEST['director'];
	 	@$filmActor = $_REQUEST['actor'];
	 	@$filmPoster = $_REQUEST['poster'];
	 	@$filmFile = $_REQUEST['file'];

	 	//переменная которая используеться для проверки на существования такого фильма в базе данных
	 	@$isFilm = R::findOne('film', 'name = ?', [$filmName]);
	 	//проверка на пустоту формы и на то есть ли такой фильм в базе данных
	 	if (!empty($filmName)&&!empty($filmURL)&&$filmName!=$isFilm['name']) {
	 		// Добавление фильма
	 		$film = R::dispense('film');
			$film->name = $filmName;
			$film->link = $filmURL;
			$film->genre = $filmGenre;
			$film->year = $filmYear;
			$film->description = $filmDescription;
			$film->director = $filmDirector;
			$film->actor = $filmActor;
			$film->poster = $filmPoster;
			echo "
			<script type='text/javascript'>
					alert('Film has been added!')
			</script>";
			R::store($film);
	 	}	
	 ?>
</body>
</html>