<?php 
	require_once 'db.php';
	

	if ( isset ($_SESSION['logged_user']) ) : ?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../styles/index_php_reged.css">
		<link rel="stylesheet" type="text/css" href="../styles/template.css">
		<link rel="stylesheet" type="text/css" href="../styles/new_tem.css">
		<link rel="shortcut icon" href="../img/smallest.png" type="image/x-icon">
		<title>ICS-media</title>
	</head>
	<body>
		<div class="header" align="center">

		<table border="0" width="100%" class="headerTable" >
		<th>
		<a href="../index.php"><img src="../img/smalllogo.png" class="smalllogo"></a>
		<a href="../cgi/index.php"><img src="../img/login.png" class="loginImg"></a>
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
		    <a href="filters/genre/genreFilter.php">Фильтр по жанру</a>
		    <a href="filters/country/countryFilter.php">Фильтр по стране</a>
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
		<div class="avt">
			<?php  
				$login = $_SESSION['logged_user']->login;
				$user = R::findOne('users', 'login = ?', [$login]);
				$img_login = $user['avatar'];
				$link_ch = "change_login_img.php?login=".$login;
				$link_del = "delete_login_photo.php?login=".$login;
				$id = $_SESSION['logged_user']->id;
				$link_del_acc = "delete_acc.php?id=" . $id . "&login=" . $login;
				$stock = '../user_login_img/stock.png';

			?>
			

			<?php

			 if (file_exists($img_login)) {
					echo "<p><img src= \"". $img_login."\" class=\"img_login\"></p>";
				}else{
					echo "<p><img src= \"" . $stock . "\" class=\"img_login\"></p>";	
				}

				 ?>
			
			<?php echo "<a href = " .  $link_ch . ">Изменить аватара</a>"; ?>
			<?php echo "<a href= " . $link_del . ">Удалить фото профиля</a>" ?>
			<?php echo "<a href= " . $link_del_acc . ">Удалить профиль</a>" ?>
			<?php echo "<a href= \"addFilm.php\">Добавить фильм</a>" ?>;
			<h2>Привет, <?php echo $_SESSION['logged_user']->login; ?>!</h2> <br/>
			<a href="logout.php">Выйти</a>
		</div>

	</body>
	</html>
	

<?php else : ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styles/reg.css">
	<link rel="stylesheet" type="text/css" href="../styles/template.css">
	<link rel="shortcut icon" href="../img/smallest.png" type="image/x-icon">
	<title>ICS-media</title>
</head>
<body>
	<div class="header" align="center">

		<table border="0" width="100%" class="headerTable" >
		<th>
		<a href="../index.php"><img src="../img/smalllogo.png" class="smalllogo"></a>
		<a href="../cgi/index.php"><img src="../img/login.png" class="loginImg"></a>
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
		    <a href="filters/genre/genreFilter.php">Фильтр по жанру</a>
		    <a href="filters/country/countryFilter.php">Фильтр по стране</a>
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
	<div class="reg">
		<br/>
		<h2>Вы не авторизованы</h2>
		<br/>
		<a href="login.php">Авторизация</a>
		<a href="signup.php">Регистрация</a>
	</div>
</body>
</html>


<?php endif; ?>

