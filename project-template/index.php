<?php 
 	
 	require_once 'cgi/db.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ICS-media</title>
	<link rel="shortcut icon" href="img/smallest.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="styles/template.css">
</head>
<body>
	<div class="header" align="center">

		<table border="0" width="100%" class="headerTable">
		<th>
		<a href="index.php"><img src="img/smalllogo.png" class="smalllogo"></a>
		<a href="cgi/index.php"><img src="img/login.png" class="loginImg"></a>
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

		    <a href="cgi/filters/year/yearFilter.php">Фильтр по году</a>
		    <a href="cgi/randomFilms.php">Что посмотреть</a>
		    <a href="#blog">Blog</a>
		    <a href="#contact">Contact</a>
		    <a href="#custom">Custom</a>
		    <a href="#support">Support</a>
		    <a href="#tools">Tools</a>
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
	<h2 align="center">Каталог</h2>
	<div align="center" class="mainWindow">
		<?php 
			require_once "cgi/show.php";
		 ?>
	</div>
	<br>
	<div class="footer">
		<table class="headerTable">
		<th>
		<div align="left" class="copy">&#169; ICS-media <?php echo date('Y'); ?></div>
		</th>
		<th>
		<span class="media"><a href=""><img src="../img/inst.png"></a> <a href="https://t.me/joinchat/KIDuQh0XguS1gSAbg-YkWg"><img src="../img/telega.png"></a></span>
		</th>
		</table>
	</div>




</body>
</html>