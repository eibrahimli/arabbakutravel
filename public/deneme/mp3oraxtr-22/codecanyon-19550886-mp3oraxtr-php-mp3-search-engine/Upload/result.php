<?php
$data_file = unserialize(base64_decode(file_get_contents('includes/website_setting.conf')));
/*
$skip_cache = false;
if (empty($_SERVER['SCRIPT_URI'])) {
$_SERVER['SCRIPT_URI'] = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $_SERVER['REQUEST_URI'];
}
$file_name= $_SERVER['SCRIPT_URI'];
$cachetime = 604800; //one week
$where = "cache2";
if ( ! is_dir($where)) {
mkdir($where);
}
$hash = md5($file_name);
$where2 = $hash[0];
if ( ! is_dir($where.'/'.$where2)) {
mkdir($where.'/'.$where2);
}
$file = "$where/$where2/$hash.cache";
// check the bloody file.

// if the renewal date is smaller than now, return true; else false (no need for update)
if (file_exists($file) && (time() - $cachetime < filemtime($file))) {
// $data=file_get_contents($url);
/*
Data HERE
*/
/*
include($file);
exit;
}
ob_start();       //  file_put_contents($file, $data);

*/

?><?php

include 'includes/database.php';
include 'includes/functions.php';

if (in_array($_GET['lang'], $available_langs) or $m_l == 'single') {

}
else {

  header("HTTP/1.0 404 Not Found");
  echo "Language Not found!.\n";
  die();
}
include 'class/itunes.php';
$titles = $_GET['title'];
$titles = toAscii($_GET['title'], '', ' ');
$search = urlencode($titles);
$result = $topsearch;
include 'includes/youtube.php';

$replace= array('live','online','mp3','cover','artist','album','song','songs','music','version');
$search = urldecode($search);
$search = urlencode(str_ireplace($replace, '', $search));

//  echo ' < pre > ';
//print_r($final_result);
//echo '</pre > ';
if (isset($titles) && $titles != '') {
  $titles = $titles;
  $count  = $database->count("search", array(
      "tag"=> "{$titles}",
    ));
  if ($count < 1) {
    $titles       = $titles;
    $last_user_id = $database->insert("search", array('tag'=> $titles));
  }
}
$titles = ucwords($titles);
$kw     = "$titles " . $lang['title_result'];
?>
<!DOCTYPE html>
<html  lang="<?php echo $_SESSION['lang']; ?>"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>
  <?php echo $titles; ?> &raquo;  <?php echo $sitename; ?>
</title>
<meta name="keywords" content="<?php echo $kw; ?>">
<meta property="og:site_name" content="<?php echo $sitename; ?>">
<meta property="og:url" content="<?php echo mp3_url($titles); ?>">
<meta property="og:title" content="<?php echo $titles; ?> &raquo; <?php echo $sitename; ?>">
<meta property="og:image" content="<?php echo $siteurl; ?>images/social.png">
<link rel="canonical" href="<?php echo mp3_url($titles); ?>">
<meta name="robots" content="index,follow">
<?php
if ($m_l == 'multi') {
  $permalink = array();
  $lang_codex = $lang_code;
  foreach ($available_langs as $lang_code) {
    ?>
    <link rel="alternate" hreflang="<?php echo $lang_code; ?>" href="<?php echo mp3_url($titles); ?>" />
    <?php
    $permalink[] = array('url'      => mp3_url($titles),'lang'     => $lang[$lang_code],'lang_code'=> $lang_code);
  }
  $lang_code = $lang_codex;
}
?>

<?php include 'header.php';?>
</center><br>
<style>
  #preview{
    background-color: #ba0000;
    width: 100%;
    height: auto;
    border-radius: 5px;
    margin: 5px 0;
    padding: 1.666666666666667%;
    overflow: hidden;
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
  .square-box{
    position: relative;
    width: 100%;
    overflow: hidden;
    background: #000;
    max-width: 100px;
    max-height: 100px;
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
</style>

<div class="row" style="margin-left: -5px; margin-right: -5px; ">
  <div class="col-lg-12">
    <center>
      <h1>
        <?php echo $titles; ?> <?php echo $lang['title_mp3_download']; ?>
      </h1>
    </center>
  </div>
</div>
<div class="row" style="margin-left: -5px; margin-right: -5px; ">
  <div class="col-lg-9">
    <ul id="items">
      <?php $i = 1;
      foreach ($final_result as $yt) {
        ?>
        <li>
          <div class="song-list" style="font-size: 16px;margin-left: -10px; margin-right: -10px;-webkit-box-shadow:0 6px 6px -6px #777;-moz-box-shadow:0 6px 6px -6px #777;box-shadow:0 6px 6px -6px #777;">
            <div class="col-xs-12">
              <div class="col-md-2 col-xs-3">
                <div class="square-box">
                  <div class="square-content">
                    <img class="img-rounded img-responsive lazy" style="position:absolute;top:0;bottom:0;margin:auto;font-size: 5px;" border="0" alt="<?php echo $yt['title']; ?> mp3" title="<?php echo $lang['free']; ?> <?php echo $yt['title']; ?> mp3" data-original="<?php echo $yt['cover']; ?>">
                  </div>
                </div>
              </div>
              <div class="col-md-10 col-xs-9">
                <div style="border-bottom: 1px dotted #D2CFFC;padding-bottom: 2px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
                  <span>
                    <?php echo $lang['free']; ?> <?php echo $yt['title']; ?>
                    <b>
                      mp3
                    </b>
                  </span>
                </div>
                <div style="font-size: 13px;margin-left:6px;px dotted #D2CFFC;padding-top: 2px;padding-bottom: 2px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
                  <span>
                    <b>
                      <i class="fa fa-rocket" title="Bitrate" style="color:#d9230f;">
                      </i>
                    </b><?php echo $yt['bits']; ?>
                    <b>
                      <i class="fa fa-hdd-o" title="File Size" style="color:#d9230f;">
                      </i>
                    </b><?php echo $yt['size']; ?>
                    <b>
                      <i class="fa fa-clock-o" title="Song Duration" style="color:#d9230f;">
                      </i>
                    </b><?php echo $yt['duration']; ?>
                    <b>
                      <i class="fa fa-heart" title="<?php echo $lang['add_fav']; ?>" style="color:red;">
                      </i>
                    </b><?php echo $yt['like']; ?>
                  </span>
                </div>
                <div class="col-xs-6">
                  <div class="mp3-dl" style="text-shadow:none;text-decoration: none;">
                    <div id="result_<?php echo $i; ?>">
                      <a href="/yt/<?php echo $yt['vid_id']; ?>" title="<?php echo $lang['free']; ?>  <?php echo $yt['title']; ?>" rel="nofollow" class="player_link <?php echo $i; ?>">
                        <span>
                          <b>
                            <i class='fa fa-play'>
                            </i><?php echo $lang['play']; ?>
                          </b>
                        </span>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="mp3-dl" style="text-shadow:none;text-decoration: none;">
                    <a href="<?php echo yt_url($yt['vid_id'], $yt['title']); ?>" title="Download <?php echo $yt['title']; ?> mp3">
                      <span>
                        <b>
                          <i class="fa fa-download">
                          </i><?php echo $lang['download']; ?>
                        </b>
                      </span>
                    </a>
                  </div>
                </div>
              </div>
              <div id="player<?php echo $i; ?>" class="player" style="padding-right: 10px;">
              </div>
            </div>
          </div><!--song-list-->
        </li>
        <?php $i++;
      }?>

    </ul>
    <?php $li_page = true;?>
    <div class="col-xs-12" style="border-radius: 4px;">
      <div class="alert alert-warning" role="alert" style="text-align: justify;text-shadow: 1px 1px #fff;margin-left: -10px; margin-right: -10px;-webkit-box-shadow:0 6px 6px -6px #777;-moz-box-shadow:0 6px 6px -6px #777;box-shadow:0 6px 6px -6px #777;">
        <span>
          <?php echo $lang['r1']; ?>
          <b>
            <?php echo $titles; ?> MP3
          </b><?php echo $lang['r2']; ?>
          <b>
            1000000
          </b><?php echo $lang['r3']; ?>
          <b>
            <?php echo $final_result[0]['title']; ?> MP3
          </b><?php echo $lang['r4']; ?>
          <b>
            <?php echo $final_result[0]['uploader']; ?>
          </b><?php echo $lang['r5']; ?>
          <b>
            <?php echo $final_result[0]['size']; ?>
          </b>, <?php echo $lang['r6']; ?>
          <b>
            <?php echo timeprint($final_result[0]['milisec']); ?>
          </b><?php echo $lang['r7']; ?>
          <b>
            <?php echo $final_result[0]['bits']; ?>
          </b>.<br><br>
          <b>
            <?php echo $lang['r8']; ?>
          </b><br><?php echo $lang['r9']; ?>
          <b>
            <i class='fa fa-play'>
            </i><?php echo $lang['play']; ?>
          </b><?php echo $lang['r10']; ?>
          <b>
            <i class="fa fa-download">
            </i><?php echo $lang['download']; ?>
          </b><?php echo $lang['r11']; ?>
        </span>
      </div>
    </div>
    <div class="clearfix">
    </div>
  </div><!-- /.col-md-9 -->
  <div class="col-lg-3">
    <div class="col-sm-12">
      <div class="row">
        <!--/div class="list-group">
        </div--><!--/right-->
        <?php include 'fresh.php';?>
      </div><!--/row-->
    </div>
  </div>
</div> </div> <!-- /.row -->
<?php include 'footer.php';?>