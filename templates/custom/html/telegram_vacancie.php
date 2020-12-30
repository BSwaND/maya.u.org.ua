<?php
	$title = "Отклик на вакансию";
	$name = $_POST['Имя'];
	$phone = preg_replace("/[^,.0-9]/", '', $_POST['Телефон']);
	$token = "1344608371:AAE8Vc4xI-ZJV5HQAVfn0nRg1yURvzxWRgw";
	$chat_id = "-1001371701752";
	$arr = array(		
		'Имя: ' => $name,
		'Телефон: ' => $phone,
		'Источник: ' => $title,
	);
	foreach($arr as $key => $value) {
		$txt .= "<b>".$key."</b> ".$value."%0A";
	};
	if (trim($phone)) {
		$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");
	}
	var_dump($arr);
	header("Location: /vakansii?sended=true");
	exit;
?>