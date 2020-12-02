<?php 
	require_once 'db.php';
	 if (isset($_POST) && !empty($_POST)) {
	 	$isFilm = R::findOne('film', 'name = ?', [$_POST['filmName']]);
	 	$login = $_SESSION['logged_user']->login;
	 	//проверка на пустоту формы 
	 	if ( !empty($_POST['filmName']) && !empty($_POST['filmURL']) && isset($login) && $isFilm->year != $_POST['year']) {//проверка на валидность фильма
	 		// Добавление фильма
	 		$film = R::dispense('film');
			$film->name = $_POST['filmName'];
			$film->country = $_POST['country'];	
			$film->link = $_POST['filmURL'];
			$film->genre = $_POST['genre'];
			$film->year = $_POST['year'];
			$film->description = $_POST['description'];
			$film->director = $_POST['director'];
			$film->poster = $_POST['poster'];
			$film->rating = 0;
			$film->voises = 1;
			$film->owner = $login;
			echo "
			<script type='text/javascript'>
					alert('Фильм был добавлен.')
			</script>";
			R::store($film);
	 	}else{
	 		echo "<script>alert(\"Что-то пошло не так.\")</script>";
	 	}	
	 }
	 	
	 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styles/template.css">
	<link rel="shortcut icon" href="../img/smallest.png" type="image/x-icon">
	<title>Добавления фильма</title>
</head>
<body>



	<div class="header" align="center">

		<table border="0" width="100%" class="headerTable">
		<td>
		<a href="../index.php"><img src="../img/smalllogo.png" class="smalllogo"></a>
		<a href="index.php"><img src="../img/login.png" class="loginImg"></a>
		</td>
		<td>
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
		</td>
		</table>
		<script>
		function myFunction() {
		    document.getElementById("myDropdown").classList.toggle("show");
		}
		</script>
	</div>
	<div class="adder" align="center">

	 	<h2>Добавления фильма</h2>
	 	<form method="POST" action="addFilm.php">
	 	 	<input type="text" name="filmName" align="center" placeholder="Name" class="add"><br><br>
	 	 	<input type="text" name="filmURL" align="center"  placeholder="URL" class="add"><br><br>
	 	 	<input type="text" name="genre" align="center" placeholder="Genre" class="add"><br><br>
	 	 	<input type="text" name="year" align="center" placeholder="Year" class="add"><br><br>
	 	 	<input type="text" name="director" align="center"  placeholder="Director" class="add"><br><br>
	 	 	<input type="text" name="country" align="center"   placeholder="Country" class="add"><br><br>
	 	 	<input type="text" name="poster" align="center" v  placeholder="Link to poster" class="add"><br><br>
	 	 	<textarea type="textarea" cols="22" rows="5" name="description" align="center"  placeholder="Description" rows class="add"></textarea><br><br>
	 	 	<input type="submit" class="addBtn"><br><br><br><br><br><br><br><br><
	 	</form>
	 </div>



	<div class="footer">
		<table class="headerTable">
		<td>
		<div align="left" class="copy">&#169; ICS-media <?php echo date('Y'); ?></div>
		</td>
		<td>
		<span class="media"><a href=""><img src="../img/inst.png"></a> <a href="https://t.me/joinchat/KIDuQh0XguS1gSAbg-YkWg"><img src="../img/telega.png"></a></span>
		</td>
		</table>
	</div>

	 
</body>
</html>
