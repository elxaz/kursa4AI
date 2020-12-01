<?php 
	require 'db.php';

	$data = $_POST;

	$err = "";

	if (isset($_FILES['login_img']['name']) && !empty($_FILES['login_img']['name'])) {
		var_dump($_FILES);
		if ($_FILES['login_img']['size'] < 2000000){//ограничение по размеру
			if (//ограничение на формат
				$_FILES['login_img']['type'] === 'image/jpeg'
     			||$_FILES['login_img']['type'] === 'image/png'
     			||$_FILES['login_img']['type'] === 'image/bmp'
      			||$_FILES['login_img']['type'] === 'image/jpg'
			){ //Файлы прошли проверки
					$path = '../user_login_img/'.$data['login'].'.jpg';
					move_uploaded_file($_FILES['login_img']['tmp_name'], $path);//сохранения фотки на сервере
			}
			else{
						$err .= "Не правильный формат. ";	
				}
			}
			else{
				$err .= "Ваш файл не правильного размера. ";	
			}
			
			if (!empty($err)) {
				echo "<script>alert(\"$err\");</script>";
			}
			}else{
				$path = '../user_login_img/stock.png';
			}
	unset($_FILES);	


	

	//если кликнули на button
	if ( isset($data['do_signup']) )
	{
    // проверка формы на пустоту полей
		$errors = array();
		if ( trim($data['login']) == '' )
		{
			$errors[] = 'Введите логин';
		}

		if ( trim($data['email']) == '' )
		{
			$errors[] = 'Введите Email';
		}

		if ( $data['password'] == '' )
		{
			$errors[] = 'Введите пароль';
		}

		if ( $data['password_2'] != $data['password'] )
		{
			$errors[] = 'Повторный пароль введен не верно!';
		}

		//проверка на существование одинакового логина
		if ( R::count('users', "login = ?", array($data['login'])) > 0)
		{
			$errors[] = 'Пользователь с таким логином уже существует!';
		}
    
    //проверка на существование одинакового email
		if ( R::count('users', "email = ?", array($data['email'])) > 0)
		{
			$errors[] = 'Пользователь с таким Email уже существует!';
		}
               

		if ( empty($errors) && empty($err) )
		{
			//ошибок нет, теперь регистрируем
			$user = R::dispense('users');
			$user->avatar = $path;
			$user->login = $data['login'];
			$user->email = $data['email'];
			$user->age = $data['age'];
			$user->password = $data['password'];
			R::store($user);
			echo "<script>alert(\"Вы успешно зарегестрировались!\"); location=\"index.php\";</script>";
			$_SESSION['logged_user'] = $user;
			header("Location:../index.php");
		}else
		{
			echo '<div id="errors" style="color:red;">' . array_shift($errors). '</div><hr>';
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
	<div class="signup">
		<h2>Регистрация</h2>
		<form action="../cgi/signup.php" method="POST" enctype="multipart/form-data">
		<input type="text" name="login" placeholder="Введите логин" required="" value="<?php echo @$data['login']; ?>"><br><br>
		<input type="email" name="email" placeholder="Введите e-mail" required="" value="<?php echo @$data['email']; ?>"><br><br>
		<input type="text" name="age" placeholder="Введите возраст" required="" value="<?php echo @$data['age']; ?>"><br><br>
		<input type="password" name="password" placeholder="Введите пароль" required="" value="<?php echo @$data['password']; ?>"><br><br>
		<input type="password" name="password_2" placeholder="Повторите пароль" required="" value="<?php echo @$data['password_2']; ?>"><br/><br/>
		<label for="file">Выберите аватара (не более 2мб):</label>
		<input type="file" name="login_img">
		<br/><br/>

		<button class="signupBtn" type="submit" name="do_signup">Регистрация</button>



		<h1><?php echo @"$name"; ?></h1>
	</div>
</form>
</body>
</html>