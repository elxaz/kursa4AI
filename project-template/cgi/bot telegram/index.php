<?php 
define("TOKEN", '1446847195:AAExsHWvVqRSXn0XlHgCSPoQp5gK9NEiKHs');

  
  define("BASE_URL", 'https://api.telegram.org/bot' . TOKEN . '/');

  function sendRequest($method , $params = []){
    if(!empty($params)){
      $url = BASE_URL . $method . '?' . http_build_query($params);

    }else{
      $url = BASE_URL . $method;
    }
    return $response = json_decode(file_get_contents($url) , JSON_OBJECT_AS_ARRAY);;
  }
  // var_dump(sendRequest('getUpdates'));
  // var_dump(sendRequest('sendMessage',['chat_id' => 285044192, 'text' => 'probe']))

  $updates = sendRequest('getUpdates');

  foreach ($updates['result'] as $update) {
  	$chat_id = $update['message']['chat']['id'];
	sendRequest('sendMessage',['chat_id' => $chat_id, 'text' => 'Привет']);
  }


 ?>