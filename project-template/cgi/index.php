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
		<link rel="shortcut icon" href="../img/smallest.png" type="image/x-icon">
		<title>ICS-media</title>
	</head>
	<body>
		<div class="avt">
			<?php  
				$login = $_SESSION['logged_user']->login;
				$user = R::findOne('users', 'login = ?', [$login]);
				$img_login = $user['avatar'];
				$link_ch = "change_login_img.php?img_login=".$img_login;
				$link_del = "delete_login_photo.php?login=".$login;

				$stock = '../user_login_img/stock.bmp'

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
	<link rel="shortcut icon" href="../img/smallest.png" type="image/x-icon">
	<title>ICS-media</title>
</head>
<body>
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

