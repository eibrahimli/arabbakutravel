<?php
session_start();
$data_file = unserialize(base64_decode(file_get_contents('includes/website_setting.conf')));
include 'includes/config.php';
include 'includes/functions.php';

//$_SESSION['token'] = substr(md5(date('y h')), 0, 10);
$token     = 'asdfghjklqwerty';
//$token = substr($token, 0, 10);
//echo $token;
include 'includes/secure.php';
$id        = $_GET['id'];
$title     = rawurlencode($_GET['title']);
$link      = $_GET['link'];
$url       = "https://d.yt-downloader.org/check.php?v=$link&f=mp3";
$json      = cache_url($url, true);
$json_decode = json_decode($json, true);
//print_r($json_decode);
$ce = $json_decode['ce'];
if (isset($ce) && $ce == 0) {
  $m_hash = $json_decode['hash'];
  $url    = "https://d.yt-downloader.org/progress.php?id=$m_hash&f=mp3";
  $json   = cache_url($url, true);
  $json_decode = json_decode($json, true);
}
//print_r($json_decode);
$server_id = $json_decode['sid'];
$m_title   = $json_decode['title'];
if (isset($json_decode['hash']) && $json_decode['hash'] != '') {
  $m_hash = $json_decode['hash'];
}
else {
  $m_hash = $m_hash;
}
//echo $server_id;
if ($server_id == '') {
  die('Something Happen, We will look into it!');
}
if ($m_hash == '') {
  die('Something Happen, We will look into it!');
}
$hash         = hideinfo($key_encrypt, $m_hash);
$sid          = hideinfo($key_encrypt, $server_id);
$mp3_download = $siteurl . 'download.php?i=' . $sid . '&h=' . $hash . '&t=' . rawurlencode($m_title);
//echo $mp3_download;
echo '<div id="download_link"><a class="ytdlink" target="_blank" id="ytd" rel="nofollow" href="' . $mp3_download . '"><span><i style="color:red;" class="fa fa-download"></i> DOWNLOAD MP3</span></a></div>';
?>