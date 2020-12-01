<?php //для того что бы никто кроме админа не мог добавлять фильмы
	require_once 'db.php';

	$user = R::findOne('users', 'login = ?', array('admin'));

	if ($_SESSION['logged_user'] != $user) {
		header("Location:../index.php");
		
	}

 ?>

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

		<table border="0" width="100%" class="headerTable">
		<th>
		<a href="../index.php"><img src="../img/smalllogo.png" class="smalllogo"></a>
		<a href="index.php"><img src="../img/login.png" class="loginImg"></a>
		</th>
		<th>
		<?php 
		if (!empty($_SESSION)) {
			$login = $_SESSION['logged_user']->login;

			if ($login === 'admin') {
				echo "<a href=\"addFilm.php\">Add film</a>";
				// echo "<th>";
				// echo "<a href=\"cgi\deleteFilm.php\">Delete film</a>";
				// echo "</th>";
			}
		}
		?>
		</th>
		<th>
		<div class="dropdown">
		<button onclick="myFunction()" class="dropbtn">Фильтры</button>
		  <div id="myDropdown" class="dropdown-content">
		    <form method="GET" action="search.php">
		    	<input type="text" name="filmSearch" placeholder="Название фильма" id="myInput">
		    	<br>
		    	<input type="submit" name="btn" value="Поиск" id="myInputBtn">
		    </form>

		    <a href="filters/year/yearFilter.php">Фильтр по году</a>
		    <a href="filters/genre/countryFilter.php">Фильтр по стране</a>
		    <a href="randomFilms.php">Что посмотреть</a>

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
	 	 	<input type="file" name="file" align="center" v  placeholder="Link to poster" class="add"><br><br>
	 	 	<input type="textarea" name="description" align="center"  placeholder="Description" class="add"><br><br>

	 	 	<input type="submit" class="addBtn">
	 	</form>
	 </div>



	<div class="footer">
		<table class="headerTable">
		<th>
		<div align="left" class="copy">&#169; ICS-media <?php echo date('Y'); ?></div>
		</th>
		<th>
		<span class="media"><a href=""><img src="../img/inst.png"></a> <a href="https://t.me/joinchat/KIDuQh0XguS1gSAbg-YkWg"><img src="../img/telega.png"></a></span>
		</th>
		</table>
	</div>

	 <?php 	
	 	@$filmCountry = $_REQUEST['country'];
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
	 	//проверка на пустоту формы 
	 	if (!empty($filmName)&&!empty($filmURL)) {
	 		// Добавление фильма
	 		$film = R::dispense('film');
			$film->name = $filmName;
			// if (empty($filmURL)) {
			// 	$filmURL = '../user_films'.$filmName.$FILES['file']['type'];
			// 	move_uploaded_file($FILES['file']['tmp-name'], $filmURL);
			// 	$film->link = $filmURL;
			// }else{
			// 	$film->link = $filmURL;
			// }
			$film->country = $filmCountry;
			$film->link = $filmURL;
			$film->genre = $filmGenre;
			$film->year = $filmYear;
			$film->description = $filmDescription;
			$film->director = $filmDirector;
			$film->actor = $filmActor;
			$film->poster = $filmPoster;
			$film->rating = 0;
			$film->voises = 1;
			echo "
			<script type='text/javascript'>
					alert('Film has been added!')
			</script>";
			R::store($film);
	 	}	
	 ?>
</body>
</html>