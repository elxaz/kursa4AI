<?php 
		require_once 'db.php';
 	 	$id = $_GET['id'];
 	 	$film = R::findOne('film', 'id = ?', [$id]);
 	 	$poster = $film['poster'];
 	 	$name = $film['name'];
 	 	$link = $film['link'];
 	 	$description = $film['description'];
 	 	$rating = $film['rating'];
 	 	$voises = $film['voises'];
 	 	$owner = $film['owner'];
//////////////////////////////////////////////////////////
 	 	$director = $film['director'];
 	 	$year = $film['year'];
 	 	$country = $film['country'];
 	 	$genre = $film['genre'];

 	 	if (preg_match('(Android)', $_SERVER['HTTP_USER_AGENT'])
			||preg_match('(iPod)', $_SERVER['HTTP_USER_AGENT'])
			||preg_match('(iPhone)', $_SERVER['HTTP_USER_AGENT'])
		) {//верстка для мобилок		
?>
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=9, initial-scale=1.0">
			<link rel="stylesheet" type="text/css" href="../styles/template.css">
			<link rel="shortcut icon" href="../img/smallest.png" type="image/x-icon">
			<title><?php echo "$name"; ?></title>
		</head>
		<body>
		<div class="header" align="center">

		<table border="0" width="100%" class="headerTable" >
		<td>
		<a href="../index.php"><img src="../img/smalllogo.png" class="smalllogo"></a>
		<a href="../cgi/index.php"><img src="../img/login.png" class="loginImg"></a>
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
	</td>
	</table>

	<table class="filmTable" align="center">
		<!-- Постер -->
		<tr>
			<td align="center">
				<img src="<?php echo "$poster" ?>" width="189" height="255" alt="lorem">
				<p>Рейтинг: <?php echo round($rating/$voises, 2); ?></p>
			</td>
		</tr>
		<tr>
			<td>
				<!-- Имя фильма -->
				<h2><?php echo "$name"; ?></h2>
				<?php 
				if (!empty($_SESSION['logged_user'])) {
					$login = $_SESSION['logged_user']->login;

					if ($login === 'admin') {
						echo "<a href=\"deleteFilm.php?id=" . $id . "\">Delete this film</a>";
					}
				}
				 ?>
			</td>
		</tr>

		<tr>
			<td>
				<!-- описание -->
				<p><?php echo "$description"; ?></p>
			</td>
		</tr>
		<tr>
			<td><!-- режисер -->
				<?php 
					echo "Режисер : $director";
				 ?>
			</td>
		</tr>
		<tr><!-- год -->
			<td>
				<?php 
					echo "Год : $year";
				 ?>
			</td>
		</tr>
		<tr>
			<td>
		<tr>
			<td><!-- страна -->
				<?php 
					echo "Страна : $country";
				 ?>
			</td>
		</tr>
		<tr><!-- жанр -->
			<td>
				<?php 
					echo "Жанр : $genre";
				 ?>
			</td>
		</tr>

		<tr>
			<td>
				<!-- Видео -->
				<div >
					<iframe src="<?php echo "$link"; ?>" align="center" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
				</div>
			</td>
		</tr>
		<tr>
			<td align="center">
				<?php //вывод комментариев
			$filmId = $id;
			$comments = R::find('comment', 'film_id = ?', [$filmId]);

			$login = [];//создем массив в ктором будем хранить логины юзеров

			foreach ($comments as $key => $value) {
				$login[$key] = $comments[$key]['user_login'];
			}

			$img = [];

			foreach ($login as $key => $login) {//беруться аватарки из базы данных
				$users = R::findOne('users', 'login = ?', [$login]);
				$img[$key] = $users['avatar'];
			}

			if (!empty($comments)) {
				echo "<table width = \"100%\" border = \"1\" class = \"comment\">";
				foreach ($comments as $key => $value) {
					if($comments[$key]['text_comment'] != ' '){
						echo "<tr>";
						if(file_exists($img[$key])){
							echo "<td>" . "<img src=" . $img[$key] . " class = \"log_img\">". "<br><br>" . $comments[$key]['user_login'] . "</td>";
					}
						
						echo "<td>" . $comments[$key]['text_comment'] . "</td>";
						echo "</tr>";
					}
				}
				echo "</table>";
			}else

			unset($filmId);
		 ?>

		<?php  
		if (isset($_SESSION['logged_user'])) {
				$login = $_SESSION['logged_user']['login'];		

		?>
		<!-- Комментарии -->
		<form name="comment" action="comment.php" method="post">
		  <p>
		    <label>Комментарировать:</label>
		    <br />
		    <textarea name="text_comment" placeholder="Оставить комментарий" id="comment" cols="40" rows="7"></textarea><!-- берем текст комментария -->
		    <br><br>
		   </p>
		  	<input type="hidden" name="user_login" value= <?php echo "\"".$login."\""; ?>><!-- берем логи пользователя -->
		    <input type="hidden" name="film_id" value= <?php echo "\"".$id."\""; ?> ><!-- берем айди фильма -->
		    <p><label>Выберите оценку:</label></p>
		    <select name="rating">
		    	<option disabled>Выберите оценку</option>
		    	<option value="0">0</option>
		    	<option value="1">1</option>
		  		<option value="2">2</option>
		  		<option value="3">3</option>
		  		<option value="4">4</option>
		  		<option value="5">5</option>
		  		<option value="6">6</option>
		  		<option value="7">7</option>
		  		<option value="8">8</option>
		  		<option value="9">9</option>
		  		<option value="10">10</option>
		    </select><br><br>
		    <input type="submit" value="Отправить" >
		</form>

		<tr>
			<td>
				<label>Пожертвовать автору:</label>
				<form method="GET" action="donation.php">
					<input type="text" required="" name="quantity" placeholder="Количество">
					<input type="hidden" name="id" value=<?php echo $id; ?>>
					<input type="hidden" name="login" value=<?php echo $login; ?>>
					<input type="submit" name="btn">
				</form>
			</td>
		</tr>
		<?php 

		}else{
			echo "<div class=\"info\">Если вы хотите оставить комментарий пожалуйста <a href=\"index.php\">зарегестрируйтесь</a></div>";			
		} 
		
		?>
			</td>
		</tr>
		
		
		
	</table>







<?php
	}else {//верстка для десктопов
		
		
?>
	
	<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=9, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styles/template.css">
	<link rel="shortcut icon" href="../img/smallest.png" type="image/x-icon">
	<title><?php echo "$name"; ?></title>
</head>
<body>
		<div class="header" align="center">

		<table border="0" width="100%" class="headerTable" >
		<td>
		<a href="../index.php"><img src="../img/smalllogo.png" class="smalllogo"></a>
		<a href="../cgi/index.php"><img src="../img/login.png" class="loginImg"></a>
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
		    <a href="filters/genre/genreFilter.php">Фильтр по жанру</a>
		    <a href="filters/country/countryFilter.php">Фильтр по стране</a>
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
<!-- Вся страничка с контентом -->
<div class="film" align="center">
		<table cellpadding="10" class="newtab">
		<div class="filmHead">
			<!-- Постер -->
			<tr>
				<td align="center">
					<img src="<?php echo "$poster" ?>" width="189" height="255" alt="lorem">
					<p>Рейтинг: <?php echo round($rating/$voises, 2); ?></p>
				</td>
				<td>
			<!-- Имя фильма -->
				<h2><?php echo "$name"; ?></h2>
				<?php 

				if (!empty($_SESSION['logged_user'])) {
					$login = $_SESSION['logged_user']->login;
					if ($login === $owner||$login === "admin") {
						echo "<a href=\"deleteFilm.php?id=" . $id . "\">Delete this film</a>";
					}
				}
				 ?>
				<!-- описание -->
					<p><?php echo "$description"; ?></p>
				</td>

					<td>
						<tr>
							<td>
							<?php 
								echo "Режиссер : $director";
								?>
							
							</td>
						</tr>
						<tr>
							<td>
								<?php 
									echo "Год : $year";
								 ?>
							</td>
						</tr>
						<tr>
							<td>
								<?php 
									echo "Страна : $country";
								 ?>
							</td>
						</tr>
						<tr>
							<td>
								<?php 
									echo "Жанр : $genre";
								 ?>
							</td>
						</tr>
					</td>
				
				

			
			</tr>


			

			
		
		</div>
		</table>


		<!-- Видео -->
		<div class="filmCenter">
			<iframe src="<?php echo "$link"; ?>" align="center" width="640" height="360" frameborder="0" allowfullscreen></iframe>
		</div>
		<br>
		<?php //вывод комментариев
			$filmId = $id;
			$comments = R::find('comment', 'film_id = ?', [$filmId]);

			$login = [];//создем массив в ктором будем хранить логины юзеров

			foreach ($comments as $key => $value) {
				$login[$key] = $comments[$key]['user_login'];
			}

			$img = [];

			foreach ($login as $key => $login) {//беруться аватарки из базы данных
				$users = R::findOne('users', 'login = ?', [$login]);
				$img[$key] = $users['avatar'];
			}

			if (!empty($comments)) {
				echo "<table width = \"640\" border = \"1\" class = \"comment\">";
				foreach ($comments as $key => $value) {
					if($comments[$key]['text_comment'] != ' '){
						echo "<tr>";
						if(file_exists($img[$key])){
							echo "<td>" . "<img src=" . $img[$key] . " class = \"log_img\">". "<br><br>" . $comments[$key]['user_login'] . "</td>";
					}
						
						echo "<td>" . $comments[$key]['text_comment'] . "</td>";
						echo "</tr>";
					}
				}
				echo "</table>";
			}else

			unset($filmId);
		 ?>

		<?php  
		if (isset($_SESSION['logged_user'])) {
				$login = $_SESSION['logged_user']['login'];	

		?>
		<!-- Комментарии -->
		<form name="comment" action="comment.php" method="post">
		  <p>
		    <label>Комментарировать:</label>
		    <br />
		    <textarea name="text_comment" placeholder="Оставить комментарий" id="comment" cols="89" rows="7"></textarea><!-- берем текст комментария -->
		    <br><br>
		   </p>
		  	<input type="hidden" name="user_login" value= <?php echo "\"".$login."\""; ?>><!-- берем логи пользователя -->
		    <input type="hidden" name="film_id" value= <?php echo "\"".$id."\""; ?> ><!-- берем айди фильма -->
		    <select name="rating">
		    	<option disabled>Выберите оценку</option>
		    	<option value="0">0</option>
		    	<option value="1">1</option>
		  		<option value="2">2</option>
		  		<option value="3">3</option>
		  		<option value="4">4</option>
		  		<option value="5">5</option>
		  		<option value="6">6</option>
		  		<option value="7">7</option>
		  		<option value="8">8</option>
		  		<option value="9">9</option>
		  		<option value="10">10</option>
		    </select><br><br>
		    <input type="submit" value="Отправить" >
		</form>
		<tr>
			<td>
				<label>Пожертвовать автору:</label>
				<form method="GET" action="donation.php">
					<input type="text" id="1" required="" name="quantity" placeholder="Количество">
					<input type="hidden" name="id" value=<?php echo $id; ?>>
					<input type="hidden" name="login" value=<?php echo $login; ?>>
					<input type="submit" name="btn">
				</form>
			</td>
		</tr>
		<?php 

		}else{
			echo "<div class=\"info\">Если вы хотите оставить комментарий пожалуйста <a href=\"index.php\">зарегестрируйтесь</a></div>";			
		} 
		}
		?>


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
		</body>	


</html>

