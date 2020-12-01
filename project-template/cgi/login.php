<?php 
	require_once 'db.php';

	$data = $_POST;
	if ( isset($data['do_login']) )
	{	
		
		$user = R::findOne('users', 'login = ?', array($data['login']));

		if ($user)
		{	
			//логин существует
			if ( $data['password']==$user->password)
			{					
				//если пароль совпадает, то нужно авторизовать пользователя
				$_SESSION['logged_user'] = $user;
					header("Location:../index.php");
			}else
			{	
				$errors[] = 'Неверно введен пароль!';
			}

		}else
		{
			$errors[] = 'Пользователь с таким логином не найден!';
		}
		
		if ( ! empty($errors) )
		{
			echo '<div id="errors" style="color:red;">' .array_shift($errors). '</div><hr>';
		}

	}

?>

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
	<div class="login">
		<h2>Авторизация</h2>
		<form action="login.php" method="POST" >
			<input type="text" name="login" placeholder="Введите логин" required="" value="<?php echo @$data['login']; ?>"><br/><br/>
			<input type="password" name="password" required="" placeholder="Введите пароль" value="<?php echo @$data['password']; ?>"><br/><br/>
	
			<button class="do_login" type="submit" name="do_login">Войти</button>
			<a href="newPassword.php">Восстановить пароль</a>
		</form>
	</div>
</body>
</html>
