<?php
	include __DIR__ . '/../config.php';
	include __DIR__ . '/SendMailSmtpClass.php';
	$param = $_REQUEST;
	$vin = $param['vin'];
	$phone = $param['phone'];
	$summa = $param['summa'];
	$days = $param['days'];
	$flagZaloga = $param['flagZaloga']=='true' ? 'Да' : 'Нет';
	$companyZalog = $param['companyZalog'];
	$theme = 'Message Shop Finance';
	$to = $e_mail_to;
$form_message = <<<EOD
<div>
	vin: <b>{$vin}</b><br>
	тел: <b>{$phone}</b><br>
	сумма: <b>{$summa}</b><br>
	срок: <b>{$days}</b><br>
	в залоге: <b>{$flagZaloga}</b><br>
			  <b>{$companyZalog}</b><br>
</div>
EOD;
	$mailSMTP = new SendMailSmtpClass($Smtp_mail, $Smtp_pass, 'ssl://smtp.yandex.ru', 465, "UTF-8");
	$from = array("Shop Finance", $e_mail_from);
	$result = $mailSMTP->send($to, $theme, $form_message, $from);
	if($result === true) echo "ok";
	else echo "Error: " . $result;
?>