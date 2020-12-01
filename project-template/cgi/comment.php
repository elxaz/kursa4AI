<?php 
	require_once 'db.php';

	// Указываем, что будем работать с таблицей comment
	$comment = R::dispense('comment');

	$err = "";

	if(trim($_POST['text_comment']) !== ""){//проверка на пустоту коментария
		$com =	htmlspecialchars($_POST['text_comment']);
		@$comment['text_comment'] = $com;
	}else{
		$err .= "comment is empty";
	}

	$login = htmlspecialchars($_POST['user_login']);
	$filmId = htmlspecialchars($_POST['film_id']);

	if ($_POST['rating'] != 0) {//проверку на то отправлен ли рейтинг
		$rating = htmlspecialchars($_POST['rating']);
		@$coment['rating'] = $rating;
	}else{
		$err .= "rating is empty";
	}

	


	// Заполняем объект свойствами которые передаються автоматически
	if ($err == "comment is empty" && $err != "rating is empty") {//если пустой комментарий но не пустой рейтинг то грузим рейтинг
		$film = R::load('film' , $filmId);
		$film->rating = $film->rating+$rating;
		$film->voises++;
		R::store($film);
	}
	if ($err != "comment is empty" && $err == "rating is empty"){//если пустой рейтинг но не пустой комментарий 
		@$comment['user_login'] = $login;
		@$comment['film_id'] = $filmId;
		R::store($comment);
	}
	header("Location: ".$_SERVER["HTTP_REFERER"]);// Делаем реридект обратно
 ?>