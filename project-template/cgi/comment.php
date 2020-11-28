<?php 
	require_once 'db.php';
	$com =	htmlspecialchars($_POST['text_comment']);
	$login = htmlspecialchars($_POST['user_login']);
	$filmId = htmlspecialchars($_POST['film_id']);
	$rating = htmlspecialchars($_POST['rating']);

	// Указываем, что будем работать с таблицей comment
	$comment = R::dispense('comment');
	// Заполняем объект свойствами
	@$comment['text_comment'] = $com;
	@$comment['user_login'] = $login;
	@$comment['film_id'] = $filmId;
	// Сохраняем объект
	R::store($comment);
	header("Location: ".$_SERVER["HTTP_REFERER"]);// Делаем реридект обратно
 ?>
