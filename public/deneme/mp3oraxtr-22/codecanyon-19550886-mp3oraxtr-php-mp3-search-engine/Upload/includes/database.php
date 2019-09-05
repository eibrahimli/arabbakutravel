<?php
session_start();
include 'config.php';
include 'class/medoo.php';
header('Content-type: text/html; charset=utf-8');
// What languages do we support
$available_langs = array('en', 'fr', 'de', 'br');

// Set our default language session

if (isset($_GET['lang']) && $_GET['lang'] != '') {
	// check if the language is one we support
	if (in_array($_GET['lang'], $available_langs)) {
		$_SESSION['lang'] = $_GET['lang']; // Set session
		$lang_url = 'lang.' . $_SESSION['lang'] . '.php';
		$lang_code = $_SESSION['lang'];
	}
} else {
	if (isset($_SESSION['lang']) and $_SESSION['lang'] != '') {
		//$_SESSION['lang'] = $available_langs[1];// Set session

		$lang_code = $_SESSION['lang'];
		$lang_url = 'lang.' . $_SESSION['lang'] . '.php';
	} else {
		$lang_url = 'lang.' . $lang_default . '.php';
		$lang_code = $lang_default;
	}
} // var_dump($data_file);
// Include active language
//echo $_GET['lang'];
// echo 'lang/'.$lang_url;
include 'lang/' . $lang_url;
$database = new medoo(array(
	// required
	'database_type' => 'mysql',
	'database_name' => $database['db_name'],
	'server' => $database['db_host'],
	'username' => $database['db_user'],
	'password' => $database['db_pass'],
	'charset' => 'utf8',

)
);

function url_origin($s, $use_forwarded_host = false) {
	$ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on');
	$sp = strtolower($s['SERVER_PROTOCOL']);
	$protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
	$port = $s['SERVER_PORT'];
	$port = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
	$host = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
	$host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
	return $protocol . '://' . $host;
}

function full_url($s, $use_forwarded_host = false) {
	return url_origin($s, $use_forwarded_host) . $s['REQUEST_URI'];
}
$absolute_url = full_url($_SERVER);
              //  echo urldecode($absolute_url);
           //     die();
$count = $database->count("dmca", array(
	"dmca" => "{$absolute_url}",
));

if ($count >= 1) {
	header('HTTP/1.1 503 Service Temporarily Unavailable');
	header('Status: 503 Service Temporarily Unavailable');
	die('URL blocked DUE TO copyright Claim!!');

} else {
	// echo $count;
}
?>