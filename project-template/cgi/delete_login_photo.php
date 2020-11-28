<?php 
	require_once 'db.php';

	if (isset($_GET)&&!empty($_GET)) {
		$login = $_GET['login'];
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<title>Подтверждение</title>
		</head>
		<body>
			<div class="accept">
				<form method="POST" action="delete_login_photo.php">
					<table>
						<tr>
							<P>Вы уверины что хотите удалить фото профиля закрепленного за <?php echo $login; ?>?</P>
						</tr>
						<td>
							<input type="submit" name="Yes" value="Yes">
							<input type="hidden" name= <?php echo $login; ?>>
						</td>
						<td>
							<input type="submit" name="No" value="No">
						</td>

					</table>
				</form>
			</div>
			
		</body>
		</html>
		<?php
	}

	if (isset($_POST) && !empty($_POST) {

		echo "<pre>";
		print_r($_post);

		echo "</pre>";
		// $login = 1;
		// Загружаем объект с ID = 1
		// $book = R::load('book', $id);
		// // Обращаемся к свойству объекта и назначаем ему новое значение
		// $book->price = 210;
		// // Сохраняем объект
		// R::store($book);
	}



 ?>