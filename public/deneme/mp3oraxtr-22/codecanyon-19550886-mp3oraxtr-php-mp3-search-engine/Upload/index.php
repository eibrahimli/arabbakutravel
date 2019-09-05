<?php
$data_file = unserialize(base64_decode(file_get_contents('includes/website_setting.conf')));
#var_dump($data_file)  ;
?><?php

include 'includes/database.php';
include 'includes/functions.php';
//   echo $lang_default;

if (isset($_GET['lang']) == $lang_default) {
  header('location: ' . $siteurl);
}
$home = true;

$url_us       = 'https://itunes.apple.com/' . $country1 . '/rss/topalbums/limit=' . $list1st . '/explicit=true/json';
$url_in       = 'https://itunes.apple.com/' . $country2 . '/rss/topalbums/limit=' . $list2nd . '/explicit=true/json';

//echo $url_us.' < br><br > '.$url_in;
$top_song_url = 'https://itunes.apple.com/' . $countrytop . '/rss/topsongs/limit=' . $topcsong . '/json';
$itune_us     = cache_url($url_us, false);

$itune_in = cache_url($url_in, false);
$itune_song_top = cache_url($top_song_url, false);

$json_us = json_decode($itune_us, true);

$json_in = json_decode($itune_in, true);

$itune_song_top = json_decode($itune_song_top, true);

$itune_top_song = $itune_song_top['feed']['entry'];
$album_data_us  = array();
foreach ($json_us['feed']['entry'] as $us) {
  // var_dump($us);
  $album_data_us[] = array(
    'album_name' => $us['im:name']['label'],
    'cover'      => artwork($us['im:image'][0]['label'], '100x100', '55x55'),
    'albumid'    => $us['id']['attributes']['im:id'],
    'artist_name'=> $us['im:artist']['label'],
  );
}

$album_data_in = array();
foreach ($json_in['feed']['entry'] as $in) {
  // var_dump($us);
  $album_data_in[] = array(
    'album_name' => $in['im:name']['label'],
    'cover'      => artwork($in['im:image'][0]['label'], '100x100', '55x55'),
    'albumid'    => $in['id']['attributes']['im:id'],
    'artist_name'=> $in['im:artist']['label'],
  );
}

$permalink = array();
?>
<!DOCTYPE html>
<html lang="<?php
if (isset($_SESSION['lang']) && $_SESSION['lang'] != '') {
  echo $_SESSION['lang'];
}
else {
  echo $lang_default;
}?>"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>
  <?php echo $lang['title_home']; ?> - <?php echo $sitename; ?>
</title>
<meta property="og:site_name" content="<?php echo $title_name; ?> - <?php echo $sitename; ?>">
<meta property="og:url" content="<?php echo $siteurl; ?>">
<meta property="og:title" content="<?php echo $title_name; ?> - <?php echo $sitename; ?>">
<meta property="og:image" content="<?php echo $siteurl; ?>images/social.png">
<meta property="og:description" content="<?php echo $lang['title_home']; ?>!">
<link rel="canonical" href="<?php echo $siteurl; ?>">
<meta name="robots" content="index,follow">
<?php
if ($m_l == 'multi') {
  ?>
  <link rel="alternate" hreflang="en" href="<?php echo $siteurl; ?>" />
  <link rel="alternate" hreflang="fr" href="<?php echo $siteurl . 'fr/'; ?>" />
  <link rel="alternate" hreflang="de" href="<?php echo $siteurl . 'de/'; ?>" />
  <link rel="alternate" hreflang="br" href="<?php echo $siteurl . 'br/'; ?>" />
  <?php
} ?>
<?php include 'header.php';?>
</center>
<div class="tabbable">
  <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <?php
    if (isset($hide1) && $hide1 == 'hide') {
    } else {
      ?>
      <li class="active">
        <a href="#tab1" data-toggle="tab">
          <span>
            <b>
              <?php echo sprintf($lang['top_album'], $country1name); ?>
            </b>
          </span>
        </a>
      </li>
      <?php
    } ?>
    <?php
    if (isset($hide2) && $hide2 == 'hide') {
    } else {
      ?>
      <li>
        <a href="#tab2" data-toggle="tab">
          <span>
            <b>
              <?php echo sprintf($lang['top_album'], $country2name); ?>
            </b>
          </span>
        </a>
      </li>
      <?php
    } ?>
  </ul>
  <div class="tab-content">
    <?php
    if (isset($hide1) && $hide1 == 'hide') {
    } else {
      ?>
      <div class="tab-pane active" id="tab1">
        <center>
          <h1>
            <?php echo sprintf($lang['top_album_heading'], $country1name, $sitename); ?>
          </h1>
        </center>
        <?php
        foreach ($album_data_us as $usalbum) {
          ?>
          <div class="col-md-4 col-sm-6" style="padding-left: 5px; padding-bottom: 10px;">
            <div class="col-lg-12" >
              <div class="col-xs-3">
                <img class="img-rounded img-responsive lazy" border="0" style="font-size: 5px;" alt="<?php echo $usalbum['album_name']; ?>" title="<?php echo $usalbum['album_name']; ?>" data-original="<?php echo $usalbum['cover']; ?>">
              </div>
              <div class="col-sm-9">
                <ul class="list-unstyled">
                  <li style="border-bottom: 1px dotted #D2CFFC;padding-bottom: 2px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
                    <span>
                      <b>
                        <i class="fa fa-check-square">
                        </i>
                      </b>
                      <b>
                        <?php echo $usalbum['album_name']; ?>
                      </b>
                    </span>
                  </li>
                  <li style="font-size: 13px;text-shadow: 1px 1px #fff;border-bottom: 1px dotted #D2CFFC;padding-top: 2px;padding-bottom: 2px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;" >
                    <b>
                      <i class="fa fa-user">
                      </i>
                    </b>
                    <span>
                      <?php echo $usalbum['artist_name']; ?>
                    </span>
                  </li>
                  <li style="font-size: 13px;padding-top: 5px;">
                    <div class="mp3-dl">
                      <a href="<?php echo album_url($usalbum['albumid'], $usalbum['album_name']); ?>">
                        <span>
                          <b>
                            <i class="fa fa-download">
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
          <?php
        }?>
      </div>
      <?php
    }?>
    <?php
    if (isset($hide1) && $hide1 == 'hide') {
    } else {
      ?>
      <div class="tab-pane" id="tab2">
        <center>
          <h1>
            <?php echo sprintf($lang['top_album_heading'], $country2name, $sitename); ?>
          </h1>
        </center>
        <?php
        foreach ($album_data_in as $inalbum) {
          ?>
          <div class="col-md-4 col-sm-6" style="padding-left: 5px;">
            <div class="col-sm-12" style="border-radius: 4px;padding:5px;background-color:#F3F3F3;">
              <div class="col-xs-3">
                <img class="img-rounded img-responsive lazy" border="0" style="font-size: 5px;" alt="<?php echo $inalbum['album_name']; ?>" title="<?php echo $inalbum['album_name']; ?>" data-original="<?php echo $inalbum['cover']; ?>">
              </div>
              <div class="col-sm-9">
                <ul class="list-unstyled">
                  <li style="border-bottom: 1px dotted #D2CFFC;padding-bottom: 2px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
                    <span>
                      <b>
                        <i class="fa fa-check-square">
                        </i>
                      </b>
                      <b>
                        <?php echo $inalbum['album_name']; ?>
                      </b>
                    </span>
                  </li>
                  <li style="font-size: 13px;text-shadow: 1px 1px #fff;border-bottom: 1px dotted #D2CFFC;padding-top: 2px;padding-bottom: 2px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;" >
                    <b>
                      <i class="fa fa-user">
                      </i>
                    </b>
                    <span>
                      <?php echo $inalbum['artist_name']; ?>
                    </span>
                  </li>
                  <li style="font-size: 13px;padding-top: 5px;">
                    <div class="mp3-dl">
                      <a href="<?php echo album_url($inalbum['albumid'], $inalbum['album_name']); ?>">
                        <span>
                          <b>
                            <i class="fa fa-download">
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
          <?php
        }?>
      </div>
      <?php
    }?>
  </div>
</div>
<div class="row clearfix" style="margin-left: -8px; margin-right: -8px;">
  <section class="container-fluid" id="section1">
    <div class="col-sm-12">
      <div class="row" style="margin-left: -23px; margin-right: -23px;">
        <div class="col-md-4 col-sm-12">
          <?php include 'fresh.php';?>
        </div><!--/left-->
        <div class="col-md-4 col-sm-12">
          <?php include 'now_download.php';?>
        </div>
        <!--/middle-->
        <div class="col-md-4 col-sm-12">
          <div class="list-group">
            <a class="list-group-item active">
              <h2 class="list-group-item-heading text-center">
                <?php echo $lang['top_song']; ?> <?php echo $sitename; ?>
              </h2>
              <h6 class="text-center">
                <?php echo $countrytopname; ?> <?php echo $lang['top_chart']; ?>..
              </h6>
            </a>
            <?php
            foreach ($itune_top_song as $top_song) {
              ?>
              <a  href="<?php echo mp3_url($top_song['title']['label']); ?>" title="<?php echo $top_song['title']['label']; ?> mp3" class="list-group-item">
                <p class="list-group-item-text" style="white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
                  <i class="fa fa-line-chart" style="margin-right:2%; color:#d9230f">
                  </i><?php echo $top_song['im:name']['label']; ?> by
                  <b>
                    <?php echo $top_song['im:artist']['label']; ?>
                  </b>
                </p>
              </a>
              <?php
            }?>
            <a  href="<?php echo $siteurl; ?>top-world/" class="list-group-item">
              <button class="btn btn-default btn-lg btn-block">
                <?php echo $lang['more_button']; ?>
              </button>
            </a>
          </div>
        </div><!--/right-->
      </div><!--/row-->
    </div>
  </section>
</div></div>
<?php include 'footer.php';?>
