<?php
	require_once 'db.php';
	if(!empty($_GET)){
		$id = $_GET['id'];
		$film = R::load('film',$id);
		R::trash($film);
		echo "<script> alert('Фильм был удален');location=\"../index.php\";</script>";


	}else{
		echo "<script> alert('Что то пошло не так');</script>";
	}
 ?>
