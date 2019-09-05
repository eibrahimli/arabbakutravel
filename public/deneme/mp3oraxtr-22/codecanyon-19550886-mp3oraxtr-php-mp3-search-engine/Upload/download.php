<?php
$data_file = unserialize(base64_decode(file_get_contents('includes/website_setting.conf')));

include 'includes/secure.php';
include 'includes/functions.php';
include 'includes/config.php';
session_start();

//$token = substr($token, 0, 10);

//echo $_SESSION['token'];

//var_dump($_GET);
$id        = showinfo($key_encrypt, $_GET['i']);
$hash      = showinfo($key_encrypt, $_GET['h']);
$title     = toAscii(rawurldecode($_GET['t']), '', '-') . '.mp3';

//echo $id.' '.$hash.' '.$title;
//die();
$sid       = array(1 => "gpkio.yt-downloader.org",
  2 => "hpbnj.yt-downloader.org",
  3 => "macsn.yt-downloader.org",
  4 => "hcqwb.yt-downloader.org",
  5 => "fgkzc.yt-downloader.org",
  6 => "hmqbu.yt-downloader.org",
  7 => "kyhxj.yt-downloader.org",
  8 => "nwwxj.yt-downloader.org",
  9 => "sbist.yt-downloader.org",
  10=> "ditrj.yt-downloader.org",
  11=> "qypbr.yt-downloader.org",
  12=> "trciw.yt-downloader.org",
  13=> "sjjec.yt-downloader.org",
  14=> "afyzk.yt-downloader.org",
  15=> "kjzmv.yt-downloader.org",
  16=> "txrys.yt-downloader.org",
  17=> "kzrzi.yt-downloader.org",
  18=> "rmira.yt-downloader.org",
  19=> "umbbo.yt-downloader.org",
  20=> "aigkk.yt-downloader.org",
  21=> "qgxhg.yt-downloader.org",
  22=> "twrri.yt-downloader.org",
  23=> "fkaph.yt-downloader.org",
  24=> "xqqqh.yt-downloader.org",
  25=> "xrmrw.yt-downloader.org",
  26=> "fjhlv.yt-downloader.org",
  27=> "ejtbn.yt-downloader.org",
  28=> "urynq.yt-downloader.org",
  29=> "tjljs.yt-downloader.org",
  30=> "ywjkg.yt-downloader.org");

$file         = 'download.php?id=';

$mp3_download = 'http://' . $sid[$id] . '/' . $file . $hash;
//echo $mp3_download;
//die();

function get_size($url)
{
  $my_ch = curl_init();
  curl_setopt($my_ch, CURLOPT_URL, $url);
  curl_setopt($my_ch, CURLOPT_HEADER, true);
  curl_setopt($my_ch, CURLOPT_NOBODY, true);
  curl_setopt($my_ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($my_ch, CURLOPT_TIMEOUT, 10);
  $r = curl_exec($my_ch);
  foreach (explode("\n", $r) as $header) {
    if (strpos($header, 'Content-Length:') === 0) {
      return trim(substr($header, 16));
    }
  }
  return '';
}
// Set operation params
//$mime = filter_var($_GET['mime']);
//$ext = str_replace(array(' / ', 'x - '), '', strstr($mime, ' / '));
//$url = base64_decode(filter_var($_GET['url']));
//$name = urldecode($_GET['title']). '.' .$ext;

// Fetch and serve
if ($mp3_download) {
  $size = get_size($mp3_download);
  // Generate the server headers
  if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE) {
    header('Content-Type: "application/octet-stream"');
    header('Content-Disposition: attachment; filename="' . $title . '"');
    header('Expires: 0');
    header('Content-Length: ' . $size);
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header("Content-Transfer-Encoding: binary");
    header('Pragma: public');
  }
  else {
    header('Content-Type: "application/octet-stream"');
    header('Content-Disposition: attachment; filename="' . $title . '"');
    header("Content-Transfer-Encoding: binary");
    header('Expires: 0');
    header('Content-Length: ' . $size);
    header('Pragma: no-cache');
  }
  header('location:' . $mp3_download);
  exit;
}
?>