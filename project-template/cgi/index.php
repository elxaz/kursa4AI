<?php 
	require_once 'db.php';
?>



<?php if ( isset ($_SESSION['logged_user']) ) : ?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../styles/index_php_reged.css">
		<link rel="shortcut icon" href="../img/smallest.png" type="image/x-icon">
		<title>ICS-media</title>
	</head>
	<body>
		<div class="avt">
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

