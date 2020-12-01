<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styles/reg.css">
	<link rel="stylesheet" type="text/css" href="../styles/template.css">
	<link rel="shortcut icon" href="../img/smallest.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="../styles/error.css">
	<title>ICS-media</title>
</head>


<?php 
	require_once 'db.php';

	require 'libs/PHPMailer-master/src/Exception.php';
	require 'libs/PHPMailer-master/src/PHPMailer.php';
	require 'libs/PHPMailer-master/src/SMTP.php';


	// Import PHPMailer classes into the global namespace
	// These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	

	$data = $_POST;
	
	if (isset($data['getNewPass'])) {

		//начался скрипт после нажатии на кнопку 
		$user = R::findOne('users', 'email = ?', array($data['email']));//взяли из бд email пользователя
		
		
		$email = $user['email'];
		$name = $user['name'];
		

		if(isset($user)){
			//если запись найдена
			//делаем новый пароль
			for ($i=0; $i < 10; $i++) { 
				@$newPass .= chr(mt_rand(55,122));
			}
			$id = $user['id'];		
			$user = R::load('users', $id);
			// Обращаемся к свойству объекта и назначаем ему новое значение
			$user->password = $newPass;
			// Сохраняем объект
			R::store($user);

			////подключение отправки письма

			$mail = new PHPMailer(true);

			try {
			    //Server settings
			    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
			    $mail->isSMTP();                                            // Send using SMTP
			    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
			    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			    $mail->Username   = 'ics.media.original@gmail.com';                     // SMTP username
			    $mail->Password   = 'dima1234566';                               // SMTP password
			    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
			    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

			    //Recipients
			    $mail->setFrom('ics.media.original@gmail.com', 'ICS-media');
			    $mail->addAddress($email, $name);     // Add a recipient
			    // $mail->addAddress('ellen@example.com');               // Name is optional
			    $mail->addReplyTo('info@example.com', 'Information');
			    
			    // Content
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = 'New password';
			    $mail->Body    = "Вот ваш новый пароль <b>$newPass</b>";
			   

			    $mail->send();

			    echo "	<script>
							alert(\"Новый пароль был отправлен Вам на почту.\");
						</script>";
			    echo "<script>window.location.href = \"login.php\"</script>";
			    

			} catch (Exception $e) {
		    	//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}

			


			

		}else{
			echo "<div class=\"validation\">Ваш email не найден</div>";
			exit();
		}
	}

 ?>


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
	<div class="newPassword">
		<h2>Восстановление пароля:</h2><br>
		<form action="newPassword.php" method="POST">
			<input type="email" name="email" placeholder="Введите ваш e-mail"><br><br>
			<button class="newPass" type="submit" name="getNewPass">Востановить пароль</button>
		</form>

	</div>
</body>
</html>