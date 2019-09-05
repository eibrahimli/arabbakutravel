<?php
$data_file = unserialize(base64_decode(file_get_contents('includes/website_setting.conf')));

include('includes/functions.php');
include('includes/database.php');

$proxy_list = preg_split("/\r\n|\n|\r/", $proxies);
$proxy_clean=array_filter($proxy_list );
$proxy_id = array_rand($proxy_clean);
$final_proxy = $proxy_clean[$proxy_id];


$vid_id=$_GET['vid_id'];
$direct_download=1;
if ($direct_download==1){
    $ref="https://www.yt2mp3s.me/api-console/mp3/".$vid_id;
 #   $yt2=direct_download("https://www.yt2mp3s.me/api-console/mp3/".$vid_id,true,'',$ref);
 $gzip="gzip, deflate, sdch, br";
    $yt2=direct_download("https://www.yt2mp3s.me/grab?vidID=".$vid_id.'&format=mp3',true,'',$ref,$gzip);
   // print_r($yt2);
   // $yt2 = gzinflate(substr($yt2, 10));
    $yt2=str_ireplace('//','https://',$yt2);
   
    preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $yt2, $match);

  //  print_r($match);
    if (count($match[0]) == 5){
        $mp3= $match[0][2];
    }
    if (isset($mp3) && $mp3!=''){
       // echo $mp3;
       sleep(10); // Very important to wait, otherwise downloading won't start!
        remote_download($mp3,$ref,'',$gzip);
    }
  //  var_dump($match);
}

