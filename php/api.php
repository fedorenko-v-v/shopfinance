<?php
session_start();
include __DIR__ . '/proxy.php';
$return = array('status' => 0, 'result' => '', 'error' => '');
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
	switch($_REQUEST['action']){
		case 'GetProxy':
			$_SESSION['proxy'] = GetProxy();
		break;
		case 'GetUuid':
			$result = GetUuid();
			if($result['info']['http_code'] == 200){
				include __DIR__ . '/simple_html_dom.php';
				$html = new simple_html_dom();
				$html->load($result['data']);
				$uuid = $html->find('#uuid')[0];
				$return['status'] = 1;
				$return['result'] = $uuid->value;
				$return['error'] = '';
				$html->clear();
				unset($html);
			}
			else{
				$return['status'] = 0;
				$return['result'] = $result;
				$return['error'] = 'error http_code GetUuid';
			}
		break;
		case 'GetCaptcha':
			$result = GetCaptcha($_REQUEST);
			if($result && $result['info']['http_code'] == 200){
				$fd = fopen(__DIR__ . '/captcha/' . $_REQUEST['type'] .'_'. $_SESSION['SSID'], 'w');
				fwrite($fd, $result['data']);
				fclose($fd);
				$return['status'] = 1;
				$return['result'] = '/php/captcha/' . $_REQUEST['type'] .'_'. $_SESSION['SSID'].'?r='.time();
				$return['error'] = '';
			}
			else{
				$return['status'] = 0;
				$return['result'] = $result;
				$return['error'] = 'error http_code GetCaptcha';
			}
		break;
		case 'SendCaptcha':
			$result = SendCapcha($_REQUEST);
			if($result && $result['info']['http_code'] == 200){
				$jsonData = json_decode($result['data'], true);
				if($jsonData['status'] == 1){
					$return['status'] = 1;
					$return['result'] = $jsonData['request'];
					$return['error'] = '';
				}
				else{
					$return['status'] = 0;
					$return['result'] = $result;
					$return['error'] = 'error status SendCapcha';
				}
			}
			else{
				$return['status'] = 0;
				$return['result'] = $result;
				$return['error'] = 'error http_code SendCapcha';
			}
		break;
		case 'GetCaptchaCode':
			$result = GetCaptchaCode($_REQUEST);
			if($result['info']['http_code'] == 200){
				$jsonData = json_decode($result['data'], true);
				if($jsonData['status'] == 1){
					$return['status'] = 1;
					$return['result'] = $jsonData['request'];
					$return['error'] = '';
				}
				else{
					$return['status'] = 0;
					$return['result'] = $jsonData['request'];
					$return['error'] = 'error status GetCaptchaCode';
				}
			}
			else{
				$return['status'] = 0;
				$return['result'] = $result;
				$return['error'] = 'error http_code GetCaptchaCode';
			}
		break;
		case 'CheckAuto':
			$result = CheckAuto($_REQUEST);
			if($result && $result['info']['http_code'] == 200){
				$jsonData = json_decode($result['data'], true);
				if($_REQUEST['type'] == 'gibdd'){
					if($jsonData['status'] == 200){
						$return['status'] = 1;
						$return['result'] = $jsonData;
						$return['error'] = '';
					}
					else{
						$return['status'] = 0;
						$return['result'] = $jsonData;
						$return['error'] = 'error status CheckAuto';
					}
				}
				elseif($_REQUEST['type'] == 'pristavi'){
					if(isset($jsonData['list']) && !empty($jsonData['list'])){
						$return['status'] = 1;
						$return['result'] = $jsonData;
						$return['error'] = '';
					}
					else{
						$return['status'] = 0;
						$return['result'] = $jsonData;
						$return['error'] = 'error status CheckAuto';
					}
				}
			}
			else{
				$return['status'] = 0;
				$return['result'] = $result;
				$return['error'] = 'error http_code CheckAuto';
				DelTempFiles();
			}
		break;
		case 'GetAvitoMarkaModel':
			$result = GetAvitoMarkaModel($_REQUEST);
			$return['status'] = $result['status'];
			$return['result'] = $result;
			$return['error'] = '';
		break;
		case 'GetAvitoFaindAuto':
			$result = GetAvitoFaindAuto($_REQUEST);
			$return['status'] = $result['status'];
			$return['result'] = $result;
			$return['error'] = '';
		break;
		case 'GetDromFaindAuto':
			$result = GetDromFaindAuto($_REQUEST);
			$return['status'] = $result['status'];
			$return['result'] = $result;
			$return['error'] = '';
		break;
	}
	echo json_encode($return);
}

/*==================================FUNCTION SECTION======================================*/

function GetDromFaindAuto($data){
	$reply = array(
		'status' => 0,
		'price' => 0,
		'count' => 0,
	);
	$result = GetContentCurl($data['url']);
	if($result && $result['info']['http_code'] == 200){
		include __DIR__ . '/simple_html_dom.php';
		$html = new simple_html_dom();
		$html->load($result['data']);
		$pages = $html->find('a[class=b-pagination__item]');
		
		$items_car = $html->find('a[class=b-advItem]');
		$price = 0;
		foreach($items_car as $item_car){
			$price_html = $item_car->find('div[class=b-advItem__price]')[0];
			$price_text = strip_tags($price_html->innertext);
			$price_text = str_replace('&#160;', '', $price_text);
			$price_text = preg_replace("/[^0-9]/", '', $price_text);
			$price += (int)$price_text;
		}
		$reply['count'] = count($pages) * count($items_car) + count($items_car);
		$reply['price'] = ceil($price / count($items_car));
		$reply['status'] = 1;
		$html->clear();
		unset($html);
	}
	return $reply;
}

function GetAvitoFaindAuto($data){
	$reply = array(
		'status' => 0,
		'price' => 0,
		'count' => 0,
	);
	$result = GetContentCurl($data['url'].'&view=list');
	if($result && $result['info']['http_code'] == 200){
		include __DIR__ . '/simple_html_dom.php';
		$html = new simple_html_dom();
		$html->load($result['data']);
		$pages = $html->find('a[class=pagination-page]');
		
		$catalog_list = $html->find('div[class=catalog-list]')[0];
		$items_car = $catalog_list->find('div[class=item_car]');
		$price = 0;
		foreach($items_car as $item_car){
			$price_html = $item_car->find('div[class=price]')[0];
			$price_text = strip_tags($price_html->innertext);
			$price_text = str_replace('&#160;', '', $price_text);
			$price_text = preg_replace("/[^0-9]/", '', $price_text);
			$price += (int)$price_text;
		}
		$reply['count'] = count($pages) * count($items_car) + count($items_car);
		$reply['price'] = ceil($price / count($items_car));
		$reply['status'] = 1;
		$html->clear();
		unset($html);
	}
	return $reply;
}

function GetAvitoMarkaModel($data){
	$reply = array(
		'status' => 0,
		'marka' => '',
		'model' => '',
	);
	$result = GetContentCurl('https://www.avito.ru/rossiya/avtomobili?q=' . urlencode($data['marka']), '', array(), true, true);
	if($result && $result['info']['http_code'] == 200){
		if(preg_match("!Location: (.*)!", $result['data'], $matches)){
			$temp = explode('?', $matches[1]);
			$temp = explode('/', $temp[0]);
			$reply['marka'] = array_pop($temp);
			$reply['status'] = 1;
			$result = GetContentCurl('https://www.avito.ru/rossiya/avtomobili/'.$reply['marka'].'?q=' . urlencode($data['model']), '', array(), true, true);
			if($result && $result['info']['http_code'] == 200){
				if(preg_match("!Location: (.*)!", $result['data'], $matches)){
					$temp = explode('?', $matches[1]);
					$temp = explode('/', $temp[0]);
					$reply['model'] = array_pop($temp);
					$reply['status'] = 2;
				}
			}
		}
	}
	return $reply;
}

function GetProxy(){
	global $proxy_list;
	$fname = __DIR__ . '/current_proxy';
	$fd = fopen($fname, 'r+');
	$current_index = fread($fd, filesize($fname));
	fclose($fd);
	$index = 0;
	if($current_index <> ''){
		$index = (int)$current_index;
		$index++;
		if($index >= count($proxy_list)) $index = 0;
	}
	$fd = fopen($fname, 'w+');
	fwrite($fd, $index);
	fclose($fd);
	return $proxy_list[$index];
}

function GetUuid(){
	return GetContentCurl('https://www.reestr-zalogov.ru/search/index');
}

function GetSSID(){
	return GetContentCurl('https://xn--90adear.xn--p1ai');
}

function GetCaptcha($data){
	if(isset($data['type']) && !empty($data['type'])){
		if($data['type']=='gibdd'){
			return GetContentCurl('https://xn--b1afk4ade.xn--90adear.xn--p1ai/proxy/captcha.jpg?' . time(), 'https://xn--90adear.xn--p1ai/check/auto');
		}
		elseif($data['type']=='pristavi'){
			return GetContentCurl('https://www.reestr-zalogov.ru/captcha/generate?' . (mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax()) * 10000);
		}
	}
	return false;
}

function SendCapcha($data){
	if(isset($data['type']) && !empty($data['type']) && ($data['type']=='gibdd' || $data['type']=='pristavi')){
		$url = __DIR__ . '/captcha/' . $data['type'] .'_'. $_SESSION['SSID'];
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime =  finfo_file($finfo, $url);
		$post_data = array(
			'key' => '7e2d739b7d2db2879e0ec1254be0ecfc',
			'file' => curl_file_create($url, $mime, 'captcha.png'),
			'method' => 'post',
			'numeric' => $data['type']=='gibdd' ? 1 : 4,
			'min_len' => 5,
			'max_len' => 5,
			'json' => 1,
		);
		return UploadFilesCurl('https://rucaptcha.com/in.php', $post_data);
	}
	return false;
}

function GetCaptchaCode($data){
	$post_data = array(
		'key' => '7e2d739b7d2db2879e0ec1254be0ecfc',
		'action' => 'get',
		'id' => (int)$data['capcha_id'],
		'json' => 1,
	);
	return GetContentCurl('http://rucaptcha.com/res.php', '', $post_data);
}

function CheckAuto($data){
	if(isset($data['type']) && !empty($data['type']) && ($data['type']=='gibdd' || $data['type']=='pristavi')){
		if($data['type']=='gibdd'){
			$post_data = array(
				'vin' => $data['vin'],
				'captchaWord' => $data['captcha'],
				'checkType' => 'history',
			);
			return GetContentCurl('https://xn--b1afk4ade.xn--90adear.xn--p1ai/proxy/check/auto/history', 'https://xn--90adear.xn--p1ai/check/auto', $post_data);
		}
		elseif($data['type']=='pristavi'){
			$post_data = array(
				'VIN' => $data['vin'],
				'token' => $data['captcha'],
				'formName' => 'vehicle-form',
				'uuid' => $data['uuid'],
			);
			return GetContentCurl('https://www.reestr-zalogov.ru/search/endpoint', 'https://www.reestr-zalogov.ru/search/index', $post_data);
		}
	}
	return false;
}

function DelTempFiles(){
	if(file_exists(__DIR__ . '/cookies/' . $_SESSION['SSID'])) unlink(__DIR__ . '/cookies/' . $_SESSION['SSID']);
	if(file_exists(__DIR__ . '/captcha/' . $_SESSION['SSID'])) unlink(__DIR__ . '/captcha/' . $_SESSION['SSID']);
}

function GetContentCurl($url, $referer = '', $post_data = array(), $header = false, $nobody = false){
	$result = array();
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, $header);
	curl_setopt($ch, CURLOPT_NOBODY, 0);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	if(!empty($_SESSION['proxy'])){
		curl_setopt($ch, CURLOPT_PROXY, $_SESSION['proxy']['ip']);
		curl_setopt($ch, CURLOPT_PROXYUSERPWD, $_SESSION['proxy']['auth']);
	}
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.170 Safari/537.36 OPR/53.0.2907.68');
	curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . '/cookies/' . $_SESSION['SSID']);
	curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . '/cookies/' . $_SESSION['SSID']);
	if(!empty($referer)) curl_setopt($ch, CURLOPT_REFERER, $referer);
	if(!empty($post_data)){
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
	}
	curl_setopt($ch, CURLOPT_URL, $url);
	$result['data'] = curl_exec($ch);
	$result['info'] = curl_getinfo($ch);
	$result['error'] = curl_error($ch);
	//Logs(array('request' => $_REQUEST, 'session' => $_SESSION, 'result' => $result));
	curl_close($ch);
	return $result;
}

function UploadFilesCurl($url, $post_data = array()){
	$result = array();
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_NOBODY, 0);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.170 Safari/537.36 OPR/53.0.2907.68');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result['data'] = curl_exec($ch);
	$result['info'] = curl_getinfo($ch);
	$result['error'] = curl_error($ch);
	curl_close($ch);
	return $result;
}

function Logs($str){
	$type = gettype($str);
	if($type=='array' || $type=='object'){
		$str = json_encode($str);
	}
	$fp = fopen(__DIR__ . '/logs.txt','a+');
	fwrite($fp,$str."\r\n");
	fclose($fp);
}
/*===============================END FUNCTION SECTION=====================================*/
?>