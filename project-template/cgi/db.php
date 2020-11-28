<html>
<head>
	<link rel="stylesheet" type="text/css" href="../styles/error.css">
</head>

<?php 
require 'libs/rb.php';
R::setup( 'mysql:host=localhost;dbname=ics-media','root2504','E8e5L6x6Q4k4F2'); 

if ( !R::testconnection() )
{
		echo "<div class=\"validation\">Извините наш сервис не работает. Обратитесь на email : ics.media.original@gmail.com</div>";
		exit ();
}

session_start();

?>

</body>
</html>