<?php 
	require_once 'db.php';
	$id = [];
    $maxId = R::count( 'film' );  
    for ($i=0; $i < 10; $i++) { //делаем рандомные айдишники
        $id[$i] = mt_rand(1 , $maxId);
    }
    $newId = array_unique($id);//делаем все айдишники в массиве уникальными, для того что бы у нас не было дубликатов постеров

    unset($id);

    $type = "type=".urlencode('rand');//для передачи через гет запрос типа выполняемого когда

    $id = "";

    foreach ($newId as $value) {
    	$id .="&id[]=".$value;
    }
    
    $url = $type.$id;

 	header("Location: http://localhost:8080/cgi/show.php?$url");//выполнение гет запроса

 ?>