<?php
header('Content-Type: text/html; charset=utf-8');

$data_file = unserialize(base64_decode(file_get_contents('includes/website_setting.conf')));

include 'includes/database.php';
include 'includes/functions.php';
#include('class / nocsrf.php');

if (isset($_REQUEST['search']) && $_REQUEST['search'] != '') {



  $title = $_REQUEST['search'];
  $title = toAscii($title, '', ' ');
  $title = trim($title);
  $title = $title;
  // $search = urlencode($title);

  $count = $database->count("search", array(
      "tag"=> "{$title}",
    ));

  if ($count < 1) {
    $last_user_id = $database->insert("search", array('tag'=> $title));
  }
  //echo $title;
  $mp3_url = mp3_url($title);
  //die();
  header('Location:' . $mp3_url);


}
else {
  header('Location: ' . $siteurl);
}

?>