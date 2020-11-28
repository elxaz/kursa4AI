<?php 
		require_once 'db.php';
 	 	$id = $_GET['id'];
 	 	$film = R::findOne('film', 'id = ?', [$id]);
 	 	$poster = $film['poster'];
 	 	$name = $film['name'];
 	 	$link = $film['link'];
 	 	$description = $film['description'];
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
		<th>
		<a href="../index.php"><img src="../img/smalllogo.png" class="smalllogo"></a>
		<a href="../cgi/index.php"><img src="../img/login.png" class="loginImg"></a>
		</th>

		<th>
		<div class="dropdown">
		<button onclick="myFunction()" class="dropbtn">Фильтры</button>
		  <div id="myDropdown" class="dropdown-content">
		    <form method="GET" action="cgi/search.php">
		    	<input type="text" name="filmSearch" placeholder="Название фильма" id="myInput">
		    	<br>
		    	<input type="submit" name="btn" value="Поиск" id="myInputBtn">
		    </form>

		    <a href="../cgi/filters/year/yearFilter.php">Фильтр по году</a>
		    <a href="../cgi/randomFilms.php">Что посмотреть</a>
		    <a href="#blog">Blog</a>
		    <a href="#contact">Contact</a>
		    <a href="#custom">Custom</a>
		    <a href="#support">Support</a>
		    <a href="#tools">Tools</a>
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
<!-- Вся страничка с контентом -->
<div class="film" align="center">
		<table cellpadding="10">
		<div class="filmHead">
			<!-- Постер -->
			<td>
				<img src="<?php echo "$poster" ?>" width="189" height="255" alt="lorem">
			</td>
			
			<td></td><td></td><td></td>
			<td>
			<!-- Имя фильма -->
				<h1><?php echo "$name"; ?></h1>
			
			<!-- Описание фильмов -->
			
				<p><?php echo "$description"; ?></p>
			</td>
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

			// $i = 0;

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
		    <textarea name="text_comment" placeholder="Оставить комментарий" id="comment" cols="89" rows="7" required=""></textarea><!-- берем текст комментария -->
		    <br><br>
		   </p>
		  	<input type="hidden" name="user_login" value= <?php echo "\"".$login."\""; ?>><!-- берем логи пользователя -->
		    <input type="hidden" name="film_id" value= <?php echo "\"".$id."\""; ?> ><!-- берем айди фильма -->
		    <input type="submit" value="Отправить" >
		</form>
		<?php 

		}else{
			echo "<div class=\"info\">Если вы хотите оставить комментарий пожалуйста <a href=\"index.php\">зарегестрируйтесь</a></div>";			
		} 
		?>

		
<style type="text/css"></style>

		
		

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
