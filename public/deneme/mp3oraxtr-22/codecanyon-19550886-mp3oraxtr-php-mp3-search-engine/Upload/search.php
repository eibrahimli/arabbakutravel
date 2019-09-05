<?php

$data_file = unserialize(base64_decode(file_get_contents('includes/website_setting.conf')));

include 'includes/database.php';
include 'includes/functions.php';

if (in_array($_GET['lang'], $available_langs) or $m_l == 'single') {

}
else {

  header("HTTP/1.0 404 Not Found");
  echo "Language Not found!.\n";
  die();
}

$title = $_GET['key'];
$title = toAscii($title, '-', ' ');
$search= urlencode($title);
$id    = stripslashes(strip_tags(($_GET['id'])));
$result= 1;
$count = $database->count("download", array(
    "vid_id"=> "{$id}",
  ));
if ($count < 1) {
  include 'includes/youtube.php';

  // echo ' < pre > ';
  //print_r($final_result);
  //echo '</pre > ';
  $yt = $final_result[0];
  if (isset($yt) && is_array($yt) && !empty($yt)) {
    $last_user_id = $database->insert("download", $yt);
  }

}
else {
  $final_result = $database->select("download", "*", array(
      "vid_id"=> "$id",'LIMIT' => 1,
    ));
  $yt = $final_result[0];
  //var_dump($yt);
}
?><!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>
  <?php echo $lang['download']; ?> <?php echo $yt['title']; ?>.mp3 &raquo; <?php echo $sitename; ?>
</title>
<meta name="description" content="<?php echo $lang['free_download']; ?> <?php echo $yt['title']; ?>.mp3, <?php echo $lang['upload_by']; ?>: <?php echo $yt['uploader']; ?>, <?php echo $lang['size']; ?>: <?php echo $yt['size']; ?>, <?php echo $lang['duration']; ?>: <?php echo timeprint($yt['milisec']); ?>, <?php echo $lang['bitrate']; ?>: <?php echo timeprint($yt['bits']); ?>.">
<meta property="og:site_name" content="<?php echo $yt['title']; ?> - <?php echo $sitename; ?>">
<meta property="og:url" content="<?php echo yt_url($yt['vid_id'], $yt['title']); ?>">
<meta property="og:title" content="<?php echo $lang['download']; ?> <?php echo $yt['title']; ?>.mp3 &raquo; <?php echo $sitename; ?>">
<meta property="og:description" content="<?php echo $lang['free_download']; ?> <?php echo $yt['title']; ?>.mp3, <?php echo $lang['upload_by']; ?>: <?php echo $yt['uploader']; ?>, <?php echo $lang['size']; ?>: <?php echo $yt['size']; ?>, <?php echo $lang['duration']; ?>: <?php echo timeprint($yt['milisec']); ?>, <?php echo $lang['bitrate']; ?>: <?php echo $yt['bits']; ?>.">
<meta property="og:image" content="https://i.ytimg.com/vi/<?php echo $yt['vid_id']; ?>/hqdefault.jpg">
<link rel="canonical" href="<?php echo yt_url($yt['vid_id'], $yt['title']); ?>">
<meta name="googlebot" content="index,follow,noodp">
<meta name="robots" content="index,follow,noydir">
<?php
if ($m_l == 'multi') {
  $permalink = array();
  $lang_codex = $lang_code;
  foreach ($available_langs as $lang_code) {
    ?>
    <link rel="alternate" hreflang="<?php echo $lang_code; ?>" href="<?php echo yt_url($yt['vid_id'], $yt['title']); ?>" />
    <?php
    $permalink[] = array('url'      => yt_url($yt['vid_id'], $yt['title']),'lang'     => $lang[$lang_code],'lang_code'=> $lang_code);
  }
  $lang_code = $lang_codex;
}
?>
<?php include 'header.php';?>
</center><br>
<style>
  #download_link a{
    display: inline-block;
    border: 2px solid #008000;
    padding: 3px 8px;
    text-align: center;
    border-radius: 4px;
    margin: 5px 0 0;
    font-family: arial,helvetica,sans-serif;
    color: #fff
  }
  #download_link a{
    color: #008000;
    font-weight: 700;
    background-color: #f7fffe;
  }
  #download_link a:hover{
    border-color: red;
    color: red;
    font-weight: 700;
    text-decoration: none
  }
  #download_link1 a{
    background-color: #e6fbff;
    display: inline-block;
    border: 2px solid #414BAF;
    padding: 3px 8px;
    text-align: center;
    border-radius: 4px;
    margin: 5px 0 0;
    font-family: arial,helvetica,sans-serif;
    color: #414BAF;
    font-weight: 700
  }
  #download_link1 a:hover{
    border-color: red;
    color: red;
    font-weight: 700;
    text-decoration: none
  }
  #preview{
    background-color: #ba0000;
    width: 100%;
    height: auto;
    border-radius: 5px;
    margin: 5px 0;
    padding: 1.666666666666667%;
    overflow: hidden;
  }
  .magic{
    display: none
  }
  .unmagic{
    display
  }
  .square-box{
    position: relative;
    width: 100%;
    overflow: hidden;
    background: #000;
    max-width: 260px;
    max-height: 260px;
    border-radius: 6px
  }
  .square-box:before{
    content: "";
    display: block;
    padding-top: 100%
  }
  .square-content{
    border: solid 4px #ff0808;
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    color: #fff
  }
  .square-content div{
    display: table;
    width: 100%;
    height: 100%
  }
  .square-content span{
    display: table-cell;
    text-align: center;
    vertical-align: middle;
    color: #fff
  }
  .effect{
    -webkit-box-shadow: 0 6px 6px -6px #777;
    -moz-box-shadow: 0 6px 6px -6px #777;
    box-shadow: 0 6px 6px -6px #777
  }
  .effect:hover{
    -webkit-box-shadow: 0 6px 6px -6px blue;
    -moz-box-shadow: 0 6px 6px -6px blue;
    box-shadow: 0 6px 6px -6px blue
  }
  .mp3-dl{
    display: inline-block;
    width: auto;
    float: none;
    overflow: hidden
  }
  .mp3-dl a{
    display: block;
    padding: 2px 8px;
    border: 1px solid #ccc;
    background: #fff;
    border-radius: 2px;
    color: #d9230f;
    text-transform: uppercase
  }
  .mp3-dl a:hover{
    border-color: #d9230f;
    background: #d9230f;
    color: #fff
  }
  .square-boxx{
    position: relative;
    width: 100%;
    overflow: hidden;
    background: #000;
    max-width: 100px;
    max-height: 100px;
    border-radius: 6px
  }
  .square-boxx:before{
    content: "";
    display: block;
    padding-top: 100%
  }
  .square-contents{
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    color: #fff
  }
  .square-contents div{
    display: table;
    width: 100%;
    height: 100%
  }
  .square-contents span{
    display: table-cell;
    text-align: center;
    vertical-align: middle;
    color: #fff
  }
</style>
<div class="row" style="margin-left: -5px; margin-right: -5px;">
  <div class="col-lg-12">
    <center>
      <h1>
        <?php echo $lang['download']; ?> <?php echo $title; ?> MP3
      </h1>
    </center>
  </div>
</div>
<div class="row" style="margin-left: -5px; margin-right: -5px;">
  <div class="col-lg-9">
    <div style="padding:10px; margin-left: -10px; margin-right: -10px;">
      <div class="col-md-4">
        <center>
          <div class="square-box">
            <div class="square-content">
              <img class="img-rounded img-responsive lazy" style="position:absolute;top:0;bottom:0;margin:auto;" data-original="<?php echo $yt['cover_large']; ?>" border="0">
            </div>
          </div>
        </center>
      </div>
      <?php $downloads = true;?>
      <div class="ytid" style="display:none;">
        <?php echo $yt['vid_id']; ?>
      </div>
      <div class="col-md-8" style="padding-left:10px;">
        <ul class="list-unstyled">
          <li style="border-bottom: 1px dotted #D2CFFC;padding-top: 3px;padding-bottom: 3px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
            <b>
              <i class="fa fa-check-square"  style="color:#d9230f">
              </i>
              <span>
                <?php echo $lang['title']; ?>:
              </span>
            </b>
            <span>
              <b>
                <?php echo $yt['title']; ?>
              </b>
            </span>
          </li>
          <li style="border-bottom: 1px dotted #D2CFFC;padding-top: 3px;padding-bottom: 3px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
            <b>
              <i class="fa fa-user"  style="color:#d9230f">
              </i>
              <span>
                <?php echo $lang['uploader']; ?>:
              </span>
            </b>
            <span>
              <?php echo $yt['uploader']; ?>
            </span>
          </li>
          <li style="border-bottom: 1px dotted #D2CFFC;padding-top: 3px;padding-bottom: 3px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
            <b>
              <i class="fa fa-clock-o"  style="color:#d9230f">
              </i>
              <span>
                <?php echo $lang['duration']; ?>:
              </span>
            </b>
            <span>
              <?php echo timeprint($yt['milisec']); ?>
            </span>
          </li>
          <li style="border-bottom: 1px dotted #D2CFFC;padding-top: 3px;padding-bottom: 3px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
            <b>
              <i class="fa fa-hdd-o"  style="color:#d9230f">
              </i>
              <span>
                <?php echo $lang['size']; ?>:
              </span>
            </b>
            <span>
              <?php echo $yt['size']; ?>
            </span>
          </li>
          <li style="border-bottom: 1px dotted #D2CFFC;padding-top: 3px;padding-bottom: 3px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
            <b>
              <i class="fa fa-rocket"  style="color:#d9230f">
              </i>
              <span>
                <?php echo $lang['bitrate']; ?>:
              </span>
            </b>
            <span>
              <?php echo $yt['bits']; ?>
            </span>
          </li>
          <li style="border-bottom: 1px dotted #D2CFFC;padding-top: 3px;padding-bottom: 3px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
            <b>
              <i class="fa fa-external-link"  style="color:#d9230f">
              </i>
              <span>
                <?php echo $lang['source']; ?>:
              </span>
            </b>
            <span>
              Downloads
            </span>
          </li>
          <li style="padding-bottom: 5px;">
            <div id="download_link">
              <?php
              if ($downloadmanage == 0) {
                ?>
                <a href="javascript:void(0)" onclick="showDownload('1','<?php echo $yt['vid_id']; ?>', '<?php echo rawurlencode($yt['title']); ?>')" rel="nofollow" id="dl1" class="download_now">
                  <span>
                    <i class="fa fa-download">
                    </i><?php echo $lang['download_mp3']; ?>
                  </span>
                </a>
                <?php
              }
              elseif ($downloadmanage == 1) {
                ?>
                <iframe style="width:230px;height:60px;border:0;overflow:hidden;" scrolling="no" src="//www.youtubeinmp3.com/widget/button/?video=https://www.youtube.com/watch?v=<?php echo $yt['vid_id']; ?>&color=008000">
                </iframe>
                <?php
              }
              elseif ($downloadmanage == 2) {
                ?>
                <iframe
                  src="https://www.youtube2mp3.cc/button-api/#<?php echo $yt['vid_id']; ?>|mp3" width="128" height="32" scrolling="no" style="border:none";>
                </iframe><br>
                <iframe
                  src="https://www.youtube2mp3.cc/button-api/#<?php echo $yt['vid_id']; ?>|mp4" width="128" height="32" scrolling="no" style="border:none";>
                </iframe>
                <?php
              }
              elseif ($downloadmanage == 3) {
                ?>
                <style>@media screen and (min-width: 651px) {#myframe{height:100px!important;}}@media (min-width: 400px) and (max-width: 650px) {#myframe{height:200px!important;}}@media (min-width: 200px) and (max-width: 399px) {#myframe{height:300px!important;}}
                </style>

                <iframe id="myframe" src="https://www.yt2mp3s.me/api-console/mp3/<?php echo $yt['vid_id']; ?>" width="100%" height="100px" scrolling="no" style="border:none;"></iframe>
                
                <?php
              }
              elseif ($downloadmanage == 4) {
                ?>
                <style>
                  .button-mp3-hd{
                    background-color: #ba0000;
                    border: none;
                    color: #fff;
                    padding: 9px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 4px 2px;
                    cursor: pointer
                  }
                  .bulk-button:hover{
                    color: #FFF
                  }
                </style>
                <button class="button-mp3-hd" type="button" id="download_button_show">
                  Download Mp3 (HD)
                </button>
                <div id="download_show" class="button_show" style="display: none;">
                  <?php
                  if (isset($custom_api) && $custom_api != '') {
                    echo str_ireplace('<YOUTUBE_ID>',$yt['vid_id'],$custom_api);
                  }
                  ?>


                </div>

                <?php
              }
              ?>
            </div>
          </li>
          <div id="download1" class="download">
          </div>
          <li style="padding-bottom: 5px;">
            <div id="download_link">
              <a target="_blank" href="<?php echo $adlink; ?>" rel="nofollow" title="Fast Download <?php echo $yt['title']; ?>.mp3">
                <span>
                  <i style="color:red;" class="fa fa-rocket">
                  </i><?php echo $lang['fast_download']; ?>
                </span>
              </a>
            </div>
          </li>
          <li>
            <div id="download_link1">
              <div id="result_1">
                <a href="/yt/<?php echo $yt['vid_id']; ?>" title="<?php echo $yt['title']; ?>" rel="nofollow" class="player_link 1">
                  <span>
                    <i class="fa fa-play">
                    </i><?php echo $lang['play']; ?>
                  </span>
                </a>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="col-sm-12">
        <div id="player1" class="player">
        </div>
      </div>
      <div class="col-sm-12" style="border-radius: 4px;padding:5px;">
        <center>
          <h1>
            <?php echo $lang['now_download']; ?>
          </h1>
          <span>
            <?php echo $lang['currently_runing_downloads']; ?>
          </span>
        </center>
        <?php $recent_download = $database->select("download", "*", array(
            'ORDER'=> 'id DESC','LIMIT'=> 22,
          ));
        $ix = 1;
        foreach ($recent_download as $rd) {
          /// var_dump($rd);
          if ($rd['vid_id'] != $yt['vid_id']) {

            ?>
            <div class="col-sm-6 col-lg-6">
              <div class="col-sm-12 effect" style="border-radius: 4px;padding:5px;">
                <div class="col-xs-3 ">
                  <div class="square-boxx">
                    <div class="square-contents">
                      <img class="img-rounded img-responsive lazy" style="font-size: 5px;position:absolute;top:0;bottom:0;margin:auto;" alt="<?php echo $rd['title']; ?> mp3" title="<?php echo $rd['title']; ?> mp3" data-original="<?php echo $rd['cover']; ?>" border="0">
                    </div>
                  </div>
                </div>
                <div class="col-sm-9">
                  <ul class="list-unstyled">
                    <li style="border-bottom: 1px dotted #D2CFFC;padding-bottom: 2px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
                      <span>
                        <b>
                          <i class="fa fa-search">
                          </i>
                        </b>
                        <a href="<?php echo mp3_url($rd['title']); ?>">
                          <b>
                            <?php echo $rd['title']; ?>
                          </b>
                        </a>
                      </span>
                    </li>
                    <li style="font-size: 13px;border-bottom: 1px dotted #D2CFFC;padding-top: 2px;padding-bottom: 2px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
                      <b>
                        <i class="fa fa-clock-o" style="color:#d9230f">
                        </i>
                      </b>
                      <span>
                        <?php echo $rd['duration']; ?> min
                        <b>
                          <i class="fa fa-hdd-o"  style="color:#d9230f">
                          </i>
                        </b><?php echo $rd['size']; ?>
                        <b>
                          <i class="fa fa-rocket"  style="color:#d9230f">
                          </i>
                        </b><?php echo $rd['bits']; ?>
                      </span>
                    </li>
                    <li style="font-size: 13px;padding-top: 5px;">
                      <div class="mp3-dl">
                        <a href="<?php echo yt_url($rd['vid_id'], $rd['title']); ?>">
                          <span>
                            <b>
                              <i class="fa fa-download"  style="color:red">
                              </i><?php echo $lang['download']; ?>
                            </b>
                          </span>
                        </a>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <?php $ix++;
            if ($ix == 21) {
              break;
            }
          }
        }
        ?>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="col-sm-12">
      <div class="row">
        <!--/div class="list-group">
        </div--><!--/right-->
        <?php include 'now_download.php';?>
        <?php include 'fresh.php';?>
      </div><!--/row-->
    </div>
  </div>
</div>
</div><!--container-->
<?php include 'footer.php';?>
