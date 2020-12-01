	<?php 
	require_once 'db.php';

	if (isset($_POST) && !empty($_POST)) {
		$answer =$_POST['btn'];
		if ($answer === 'Yes') {
			$login = $_POST['login'];
			$user = R::findOne('users' , 'login = ?' , [$login]);
			$user->avatar = "../user_login_img/stock.png";
			R::store($user);
			echo "<script> alert(\"Фото успешно удалено\");
			location=\"index.php\";
			</script>";
						
		}elseif ($answer === 'No') {
			header('Location: ../index.php');
		}
		
		
	}
	if (isset($_GET) && !empty($_GET)) {
		$login = $_GET['login'];
		echo "<html>
				<head>
					<title>Подтверждение</title>
					<link rel=\"stylesheet\" type=\"text/css\" href=\"../styles/new_tem.css\">
					<link rel=\"stylesheet\" type=\"text/css\" href=\"../styles/template.css\">
				</head>
				<body>
					<div class=\"header\" align=\"centre\">
					<table border=\"0\" width=\"100%\" class=\"headerTable\" >
					<th>
					<a href=\"../index.php\"><img src=\"../img/smalllogo.png\" class=\"smalllogo\"></a>
					<a href=\"../cgi/index.php\"><img src=\"../img/login.png\" class=\"loginImg\"></a>
					</th>

					<th>
					<div class=\"dropdown\">
					<button onclick=\"myFunction()\" class=\"dropbtn\">Фильтры</button>
					  <div id=\"myDropdown\" class=\"dropdown-content\">
					    <form method=\"GET\" action=\"cgi/search.php\">
					    	<input type=\"text\" name=\"filmSearch\" placeholder=\"Название фильма\" id=\"myInput\">
					    	<br>
					    	<input type=\"submit\" name=\"btn\" value=\"Поиск\" id=\"myInputBtn\">
					    </form>

					    <a href=\"filters/year/yearFilter.php\">Фильтр по году</a>
					    <a href=\"filters/genre/genreFilter.php\">Фильтр по жанру</a>
					    <a href=\"filters/country/countryFilter.php\">Фильтр по стране</a>
					    <a href=\"randomFilms.php\">Что посмотреть</a>
					  </div>
					</div>
					</th>
					</table>
					<script>
					function myFunction() {
					    document.getElementById(\"myDropdown\").classList.toggle(\"show\");
					}
					</script>
				</div>
					<div class=\"accept\">
						<form method=\"POST\" action=\"delete_login_photo.php\">
							<p>Вы уверины что хотите удалить фото профиля закрепленного за $login ?</p>
							<input class = \"yes\" type=\"submit\" name=\"btn\" value = \"Yes\">
							<input type=\"hidden\" name= \"login\" value = " . $login . ">
							<input class = \"no\" type=\"submit\" name=\"btn\" value=\"No\">					
						</form>
					</div>
				</body>
				</html>";

		}?>



