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
				if($data['login']==='admin'&&$data['password']==='root'){
					//Вход для админа
					header("Location:adminConsole.php");
				}else{
					//Вход для всех остальных смертных
					header("Location:../index.php");
				} 
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
	<link rel="stylesheet" type="text/css" href="../styles/login.css">
	<link rel="shortcut icon" href="../img/smallest.png" type="image/x-icon">
	<title>ICS-media</title>
</head>
<body>
	<div class="login">
		<h2>Авторизация</h2>
		<form action="login.php" method="POST" >
			<input type="text" name="login" placeholder="Введите логин" value="<?php echo @$data['login']; ?>"><br/><br/>
			<input type="password" name="password" placeholder="Введите пароль" value="<?php echo @$data['password']; ?>"><br/><br/>
	
			<button type="submit" name="do_login">Войти</button>
			<a href="newPassword.php">Восстановить пароль</a>
		</form>
	</div>
</body>
</html>
