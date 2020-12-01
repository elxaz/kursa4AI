<?php 
	require_once 'db.php';
	$err = "";

	if (empty($_GET)&&!empty($_POST)) {
		if ($_FILES['new_img']['size'] < 2000000) {//проверка на размер файла 
			if (//проверка на формат
				$_FILES['new_img']['type'] === 'image/jpeg'
     			||$_FILES['new_img']['type'] === 'image/png'
     			||$_FILES['new_img']['type'] === 'image/bmp'
      			||$_FILES['new_img']['type'] === 'image/jpg'
			){
				$login = $_POST['login'];
				$path = '../user_login_img/'.$login.'.jpg';
				if (file_exists($path)) {//проверка на наличие старого файла
					unlink($path);//удаление старого фото
				}
				move_uploaded_file($_FILES['new_img']['tmp_name'], $path);//сохранения нового фото
				$user = R::findOne('users','login = ?',[$login]);//передача нового имени в базу
				$user->avatar = $path;
				R::store($user);
				echo "<script> alert(\"Ваша фото профиля успешно изменено.\"); location=\"index.php\";</script>";
			}else{
						$err .= "Не правильный формат";	
				}
			}else{
				$err .= "Ваш файл не правильного размера";		
			}
			
			if (!empty($err)) {
				echo "<script>alert(\"$err\");</script>";
			}
		}
?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Изменения фото</title>
 	<link rel="stylesheet" type="text/css" href="../styles/new_tem.css">
 	<link rel="stylesheet" type="text/css" href="../styles/template.css">
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
 	<div class="avt1">
 		<h2>Изменения фото</h2>
 		<form method="POST" enctype="multipart/form-data" action="change_login_img.php">
 			<input type="file" name="new_img"><br>
	 			<?php 
		 	 		if (!empty($_GET['login'])) {
		 			$login = $_GET['login'];
					echo "<input type=\"hidden\" name=\"login\" value=" . $login . ">";
				}
				?>
	 		<input type="submit" name="btn" value="Изменить фото">
 	 	</form>
 	</div>
 </body>
 </html>