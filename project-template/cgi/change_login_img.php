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
				$path = $_POST['img_login'];
				if (file_exists($path)) {//проверка на наличие старого файла
					unlink($path);//удаление старого фото
				}
				move_uploaded_file($_FILES['new_img']['tmp_name'], $path);//сохранения нового фото
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
 	<title>try</title>
 </head>
 <body>
 	<form method="POST" enctype="multipart/form-data" action="change_login_img.php">
	 	<input type="file" name="new_img"><br>
	 	<?php 
	 		if (!empty($_GET['img_login'])) {
	 			$img_login = $_GET['img_login'];
	 			echo "<input type=\"hidden\" name=\"img_login\" value=" . $img_login . ">";
	 		}
	 	 ?>
	 	<input type="submit" name="btn">
 	</form>
 </body>
 </html>