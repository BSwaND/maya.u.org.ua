<?php
	$name = $_POST['Имя'];
	$phone = preg_replace("/[^+0-9]/", '', $_POST['Телефон']);
	$message = $_POST['Комментарий'];
	$host = $_POST['host'];
	$uri =  $_POST['uri'];
	$source = $host . $uri;
	$link =  $_POST['Ссылка'];
	$token = "1344608371:AAE8Vc4xI-ZJV5HQAVfn0nRg1yURvzxWRgw";
	$chat_id = "-1001371701752";
	$arr = array(
		'Имя: ' => $name,
		'Телефон: ' => $phone,
		'Комментарий' => $message,
		'Источник: ' => $source,
		'Ссылка: ' => $link,
	);
	foreach($arr as $key => $value) {
		$txt .= "<b>".$key."</b> ".$value."%0A";
	};
	if (trim($phone) && trim($source)) {
		$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");
	}
	header("Location: $uri?sended=true");
	exit;
?>