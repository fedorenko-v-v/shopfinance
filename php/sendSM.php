<?php
	include __DIR__ . '/../config.php';
	include __DIR__ . '/SendMailSmtpClass.php';
	$param = $_REQUEST;
	$name = $param['name'];
	$phone = $param['phone'];
	$theme = 'Message Shop Finance';
	$to = $e_mail_to;
$form_message = <<<EOD
<div>
	имя: <b>{$name}</b><br>
	тел: <b>{$phone}</b><br>
</div>
EOD;
	$mailSMTP = new SendMailSmtpClass($Smtp_mail, $Smtp_pass, 'ssl://smtp.yandex.ru', 465, "UTF-8");
	$from = array("Shop Finance", $e_mail_from);
	$result = $mailSMTP->send($to, $theme, $form_message, $from);
	if($result === true) echo "ok";
	else echo "Error: " . $result;
?>