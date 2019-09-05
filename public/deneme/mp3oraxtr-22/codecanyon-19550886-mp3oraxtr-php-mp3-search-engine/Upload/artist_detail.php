<?php
// $available_langs = array('en','fr','de');

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
*//*
include($file);
exit;
}
ob_start();       //  file_put_contents($file, $data);

*/

?><?php
include 'class/itunes.php';
include 'includes/database.php';
include 'includes/functions.php';

if (in_array($_GET['lang'], $available_langs) or $m_l == 'single') {

}
else {

  header("HTTP/1.0 404 Not Found");
  echo "Language Not found!.\n";
  die();
}
if (isset($_GET['id']) && $_GET['id'] != '') {
  $id_artist = (int) $_GET['id'];
}
else {
  die('Something Wrong');
}
$albums = iTunes::lookup($id_artist, 'id', array(
    'entity'=> 'album',
  ))->results;
$album_songs = iTunes::lookup($id_artist, 'id', array(
    'entity'=> 'song',
  ))->results;
// echo ' < pre > ';
// echo $duration;
//print_r($album_songs);
//    echo '</pre > ';

$artist = array();
$album_list = array();
$track_list = array();
foreach ($albums as $album) {
  if ($album->wrapperType == 'artist') {
    $artist['artist_name'] = toAscii($album->artistName);
    $artist['artist_genre'] = $album->primaryGenreName;
  }
  if ($album->wrapperType == 'collection') {
    $album_list[] = array('title'     => toAscii($album->collectionName),
      'cover'     => cache_image($album->artworkUrl100),
      'artistname'=> toAscii($album->artistName),
      'albumid'   => $album->collectionId,
      'track'     => $album->trackCount,
      'release'   => $album->releaseDate,
      'genre'     => $album->primaryGenreName,
    );
  }

}
foreach ($album_songs as $asongs) {
  if ($asongs->wrapperType == 'track') {
    $track_list[] = array('albumname' => $asongs->collectionName,
      'title'     => toAscii($asongs->trackName),
      'cover'     => cache_image($asongs->artworkUrl100),
      'artistname'=> toAscii($asongs->artistName),
      'track'     => $asongs->trackCount,
      'release'   => $asongs->releaseDate,
      'tracktime' => $asongs->trackTimeMillis,
      'artistid'  => $asongs->artistId,
      'albumid'   => $asongs->collectionId,
      'preview'   => $asongs->previewUrl,
      'genre'     => $asongs->primaryGenreName,
    );

  }
}
if (strpos($artist['artist_name'], ',') === false) {
  //echo 'Not Found';
  $artist_name_fm = $artist['artist_name'];
}
else {
  $artist_name_array = explode(',', $artist['artist_name']);
  $artist_name_fm    = reset($artist_name_array);
}

if (strpos($artist['artist_name'], '&') === false) {
  //  echo 'Not Found';
  $artist_name_fm = $artist['artist_name'];
}
else {
  $artist_name_array = explode('&', $artist['artist_name']);
  $artist_name_fm    = reset($artist_name_array);
}

$artist_details = cache_url('http://www.last.fm/music/' . str_ireplace(' ', '+', $artist_name_fm));
// echo 'http://www.last.fm / music / '.$artist_name_fm;

$artist_detail  = strstr($artist_details, '<div class="wiki-content">');
if ($artist_detail == '') {
  $artist_detail = strstr($artist_details, '<div class="wiki-content" >');
}
$artist_detail = strstr($artist_detail, '<p>');

$artist_detail = @explode('<a href="/music/', $artist_detail);
// var_dump($artist_detail);
$artist_detail = strip_tags($artist_detail[0]);

$artist_cover  = strstr($artist_details, '<div class="expand-image-show-on-focus header-avatar-inner-wrap">');
$artist_cover  = strstr($artist_cover, 'src="');
$artist_cover  = @explode('"', $artist_cover);
$artist_cover  = str_ireplace('avatar170s', '300x300', $artist_cover[1]);
// print_r($artist_cover);
// die();
//echo ' < pre > ';
//print_r($artist);
$duration      = '';
foreach ($track_list as $track) {
  if (isset($track['tracktime'])) {
    $duration += $track['tracktime'];
  }
}

$track_count = count($track_list);
$album_count = count($album_list);

?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>
  <?php echo $lang['artist']; ?>: <?php echo $artist['artist_name']; ?> &raquo; <?php echo $lang['title_result']; ?> - <?php echo $sitename; ?>
</title>
<meta name="description" content="<?php echo $lang['free_artist']; ?>: <?php echo $artist['artist_name']; ?>, <?php echo $lang['genre']; ?>: <?php echo $album_list[0]['genre']; ?>, <?php echo $lang['track_album']; ?>: <?php echo $album_count; ?>,<?php echo $lang['total_track']; ?>: <?php echo $track_count; ?>, <?php echo $lang['duration']; ?>: <?php echo timeprint($duration); ?>, <?php echo $lang['release_date']; ?>: <?php echo release($album_list[0]['release']); ?> - <?php echo $lang['title_result']; ?> .">
<meta property="og:site_name" content="<?php echo $sitename; ?>">
<meta property="og:url" content="<?php echo artist_url($track_list[0]['artistid'], $artist['artist_name']); ?>">
<meta property="og:title" content="Artist: <?php echo $artist['artist_name']; ?> - <?php echo $sitename; ?>">
<meta property="og:description" content="<?php echo $lang['artist']; ?>: <?php echo $artist['artist_name']; ?>, <?php echo $lang['genre']; ?>: <?php echo $album_list[0]['genre']; ?>, <?php echo $lang['track_album']; ?>: <?php echo $album_count; ?>,<?php echo $lang['total_track']; ?>: <?php echo $track_count; ?> - <?php echo $lang['title_result']; ?> .">
<meta property="og:image" content="<?php echo artwork($album_list[0]['cover'], '250x250', '100x100bb'); ?>">
<link rel="canonical" href="<?php echo artist_url($track_list[0]['artistid'], $artist['artist_name']); ?>">
<?php
if ($m_l == 'multi') {
  $permalink = array();
  $lang_codex = $lang_code;
  foreach ($available_langs as $lang_code) {
    ?>
    <link rel="alternate" hreflang="<?php echo $lang_code; ?>" href="<?php echo artist_url($track_list[0]['artistid'], $artist['artist_name']); ?>" />
    <?php
    $permalink[] = array('url'      => artist_url($track_list[0]['artistid'], $artist['artist_name']),'lang'     => $lang[$lang_code],'lang_code'=> $lang_code);
  }
  $lang_code = $lang_codex;
}
?>


<meta name="googlebot" content="index,follow,noodp">
<meta name="robots" content="index,follow,noydir">
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
    background-color: #e6fbff;;
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
    visibility: hidden
  }
  .unmagic{
    visibility: visible
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
    color: #fff.images{position:relative
  }
  h3{
    position: absolute;
    left: 3px;
    bottom: 3px;
    color: #fff;
  }
</style>
<div class="row" style="margin-left: -5px; margin-right: -5px;">
  <div class="col-lg-12">
    <center>
      <h1>
        <?php echo $lang['all_about']; ?> <?php echo $artist['artist_name']; ?>
      </h1>
    </center>
  </div>
</div>
<div class="row" style="margin-left: -5px; margin-right: -5px;">
  <div class="col-lg-9">
    <div  style="padding:10px; margin-left: -10px; margin-right: -10px;">
      <div class="col-md-4">
        <img class="thumbnail img-responsive lazy" data-original="<?php echo $artist_cover; ?>" border="0">
      </div>
      <div class="col-md-8" style="padding-left:10px;">
        <ul class="list-unstyled">
          <li >
            <b>
              <i class="fa fa-user" style="color:#d9230f;">
              </i>
              <span>
                <?php echo $lang['artist']; ?>:
              </span>
            </b>
            <span>
              <?php echo $artist['artist_name']; ?>
            </span>
          </li>
          <li >
            <b>
              <i class="fa fa-tags" style="color:#d9230f;">
              </i>
              <span>
                <?php echo $lang['genre']; ?>:
              </span>
            </b>
            <span>
              <?php echo $artist['artist_genre']; ?>
            </span>
          </li>
          <li >
            <b>
              <i class="fa fa-music" style="color:#d9230f;">
              </i>
              <span>
                <?php echo $lang['track_album']; ?>:
              </span>
            </b>
            <span>
              <?php echo $album_count; ?>
            </span>
          </li>
          <li >
            <b>
              <i class="fa fa-volume-up" style="color:#d9230f;">
              </i>
              <span>
                Total Songs:
              </span>
            </b>
            <span>
              <?php echo $track_count; ?>+
            </span>
          </li>
        </ul>
      </div>
      <div class="col-sm-12">
        <center>
        </center>
      </div>
      <div style="text-decoration: none;" class="col-sm-12">
        <h3>
          <b>
            <?php echo $lang['short_bio']; ?>:
          </b>
        </h3>
        <span>
          <?php echo toAscii($artist_detail, ' '); ?> ...
        </span>
      </div>
      <br>
      <div class="col-sm-12 col-md-12">
        <center>
          <h3>
            <b>
              <?php echo $lang['music_album']; ?> <?php echo $artist['artist_name']; ?>
            </b>
          </h3>
        </center>
        <?php
        foreach ($album_list as $artist_album) {

          ?>

          <div class="col-sm-6 col-lg-6" style="border-radius: 4px;padding:5px;">
            <div class="col-xs-3">
              <img class="img-rounded img-responsive lazy" style="font-size: 5px;" alt="<?php echo $artist_album['title']; ?>" title="<?php echo $artist_album['title']; ?>" data-original="<?php echo $artist_album['cover']; ?>" border="0">
            </div>
            <div class="col-sm-9">
              <ul class="list-unstyled">
                <li style="border-bottom: 1px dotted #D2CFFC;padding-bottom: 2px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
                  <span>
                    <b>
                      <i class="fa fa-check-square" style="color:#d9230f;">
                      </i>
                    </b>
                    <b>
                      <?php echo $artist_album['title']; ?>
                    </b>
                  </span>
                </li>
                <li style="font-size: 13px;border-bottom: 1px dotted #D2CFFC;padding-top: 2px;padding-bottom: 2px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
                  <b>
                    <i class="fa fa-user" style="color:#d9230f;">
                    </i>
                  </b>
                  <span>
                    <?php echo $artist_album['artistname']; ?>
                  </span>
                </li>
                <li style="font-size: 13px;padding-top: 5px;">
                  <div class="mp3-dl">
                    <a href="<?php echo album_url($artist_album['albumid'], $artist_album['title']); ?>">
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

          <?php
        }?>
        <style>
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
        </style>
      </div>
      <br>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="col-sm-12">
      <div class="row" style="margin-left: -25px; margin-right: -25px;">
        <?php include 'now_download.php';?>
        <?php include 'fresh.php';?>
      </div><!--/row-->
    </div>
  </div>
</div>
</div><!--container-->
<?php include 'footer.php';?>