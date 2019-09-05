<?php
//var_dump($_GET);
$data_file = unserialize(base64_decode(file_get_contents('includes/website_setting.conf')));
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
  $id_album = (int) $_GET['id'];
}
else {
  die('Something Wrong');
}
$albums = iTunes::lookup($id_album, 'id', array(
    'entity'=> 'song',
  ))->results;
$duration = '';
//echo ' < pre > ';
//echo $duration;
//print_r($albums);
//echo '</pre > ';
// die();
foreach ($albums as $album) {
  if (isset($album->trackTimeMillis)) {
    $duration += $album->trackTimeMillis;
  }
}
if (!isset($albums[0]->collectionId) and $albums[0]->collectionId == '') {
  $protocol = "HTTP/1.0";
  if ("HTTP/1.1" == $_SERVER["SERVER_PROTOCOL"]) {
    $protocol = "HTTP/1.1";
  }
  header("$protocol 503 Service Unavailable", true, 503);
  // header("Location: $siteurl");
  echo 'Album not Found! You will be redirect to Home Page in a Second!';
  echo ' <meta http-equiv="refresh" content="0;URL=\'' . $siteurl . '\'" /> ';
  die();
}
?><!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>
  <?php echo $lang['album']; ?>: <?php echo toAscii($albums[0]->collectionName); ?> by <?php echo toAscii($albums[0]->artistName); ?> - <?php echo $lang['title_result']; ?> - <?php echo $sitename; ?>
</title>
<meta name="description" content="<?php echo $lang['free_album']; ?> <?php echo toAscii($albums[0]->collectionName); ?>, <?php echo $lang['artist']; ?>: <?php echo toAscii($albums[0]->artistName); ?>, <?php echo $lang['genre']; ?>: <?php echo $albums[0]->primaryGenreName; ?>, <?php echo $lang['total_track']; ?>: <?php echo $albums[0]->trackCount; ?>, <?php echo $lang['duration']; ?>: <?php echo timeprint($duration); ?>, <?php echo $lang['release_date']; ?>: <?php echo release($albums[0]->releaseDate); ?>.">
<meta property="og:site_name" content="<?php echo $lang['title_result']; ?> - <?php echo $sitename; ?>">
<meta property="og:url" content="<?php echo album_url($albums[0]->collectionId, $albums[0]->collectionName); ?>">
<meta property="og:title" content="<?php echo $lang['album']; ?>: <?php echo toAscii($albums[0]->collectionName); ?> by <?php echo toAscii($albums[0]->artistName); ?> <?php echo $sitename; ?>">
<meta property="og:description" content="<?php echo $lang['free_album']; ?> <?php echo toAscii($albums[0]->collectionName); ?>, Artist: <?php echo toAscii($albums[0]->artistName); ?>, <?php echo $lang['genre']; ?>:<?php echo $albums[0]->primaryGenreName; ?>, <?php echo $lang['total_track']; ?>: <?php echo $albums[0]->trackCount; ?>.">
<meta property="og:image" content="<?php echo artwork($albums[0]->artworkUrl100, '250x250', '100x100bb'); ?>">
<link rel="canonical" href="<?php echo album_url($albums[0]->collectionId, $albums[0]->collectionName); ?>">
<?php
if ($m_l == 'multi') {
  $permalink = array();
  $lang_codex = $lang_code;
  foreach ($available_langs as $lang_code) {
    ?>
    <link rel="alternate" hreflang="<?php echo $lang_code; ?>" href="<?php echo album_url($albums[0]->collectionId, $albums[0]->collectionName); ?>" />
    <?php
    $permalink[] = array('url'      => album_url($albums[0]->collectionId, $albums[0]->collectionName),'lang'     => $lang[$lang_code],'lang_code'=> $lang_code);
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
    text-shadow: 1px 1px #000;
  }
</style>
<div class="row" style="margin-left: -5px; margin-right: -5px;">
  <div class="col-lg-12">
    <center>
      <h1>
        <?php echo toAscii($albums[0]->collectionName); ?> <?php echo $lang['album_free_download']; ?>
      </h1>
    </center>
  </div>
</div>
<div class="row" style="margin-left: -5px; margin-right: -5px;">
  <div class="col-lg-9">
    <div style="padding:10px; margin-left: -10px; margin-right: -10px;">
      <div class="col-md-4">
        <img class="thumbnail img-responsive lazy" data-original="<?php echo artwork($albums[0]->artworkUrl100, '250x250', '100x100bb'); ?>" border="0">
      </div>
      <div class="col-md-8" style="padding-left:10px;">
        <ul class="list-unstyled">
          <li >
            <b>
              <i class="fa fa-check-square" style="color:#d9230f;">
              </i>
              <span>
                <?php echo $lang['title']; ?>:
              </span>
            </b>
            <span>
              <b>
                <?php echo toAscii($albums[0]->collectionName); ?>
              </b>
            </span>
          </li>
          <li >
            <b>
              <i class="fa fa-user" style="color:#d9230f;">
              </i>
              <span>
                <?php echo $lang['artist']; ?>:
              </span>
            </b>
            <span>
              <?php echo $albums[0]->artistName; ?>
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
              <?php echo $albums[0]->primaryGenreName; ?>
            </span>
          </li>
          <li >
            <b>
              <i class="fa fa-music" style="color:#d9230f;">
              </i>
              <span>
                <?php echo $lang['total_track']; ?>:
              </span>
            </b>
            <span>
              <?php echo $albums[0]->trackCount; ?>
            </span>
          </li>
          <li >
            <b>
              <i class="fa fa-clock-o" style="color:#d9230f;">
              </i>
              <span>
                <?php echo $lang['release_date']; ?>:
              </span>
            </b>
            <span>
              <?php echo release($albums[0]->releaseDate); ?>
            </span>
          </li>
          <li style="padding-top: 5px;padding-bottom: 5px;">
            <div id="download_link">
              <a target="_blank" href="<?php echo $albums[0]->collectionViewUrl; ?>" rel="nofollow" download="<?php echo toAscii($albums[0]->collectionName); ?>">
                <span>
                  <i class="fa fa-apple">
                  </i><?php echo $lang['download_itunes']; ?>
                </span>
              </a>
            </div>
          </li>
        </ul>
      </div>
      <div class="col-sm-12">
        <center>
        </center>
        <div class="alert alert-warning" role="alert">
          <span>
            <b>
              <?php echo toAscii($albums[0]->collectionName); ?>
            </b><?php echo $lang['v1']; ?>
            <b>
              <?php echo toAscii($albums[0]->artistName); ?>
            </b>.  <?php echo $lang['v2']; ?>
            <b>
              <?php echo $albums[0]->primaryGenreName; ?>
            </b>, <?php echo $lang['v3']; ?>
            <b>
              <?php echo release($albums[0]->releaseDate); ?>
            </b><?php echo $lang['v4']; ?>
            <b>
              <?php echo $albums[0]->trackCount; ?> tracks
            </b><?php echo $lang['v5']; ?>
            <b>
              <?php echo timeprint($duration); ?>
            </b><?php echo $lang['v6']; ?>.<br><br><?php echo $lang['v7']; ?>
            <b>
              <i class="fa fa-play">
              </i><?php echo $lang['play']; ?>
            </b><?php echo $lang['v8']; ?>
            <b>
              <i class="fa fa-download">
              </i><?php echo $lang['download']; ?>
            </b><?php echo $lang['v9']; ?>.
          </span>
        </div>
      </div>
      <div style="text-shadow: 1px 1px #fff;text-decoration: none;" class="col-xs-12">
        <h3>
          <b>
            <?php echo $lang['track_list']; ?>:
          </b>
        </h3>
      </div>
      <div class="col-sm-12">
        <center>
        </center>
      </div>
      <style>
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
      </style>
      <?php $i = 1;
      foreach ($albums as $album) {
        if (isset($album->previewUrl)) {
          if (isset($album->artistId) && $album->artistId != '') {
            if (isset($album->artistName) && $album->artistName != '') {
              ?>
              <div class="col-sm-12">
                <div class="song-list" style="-webkit-box-shadow:0 6px 6px -6px #777;-moz-box-shadow:0 6px 6px -6px #777;box-shadow:0 6px 6px -6px #777;">
                  <div class="col-xs-1">
                    <center>
                      <h2>
                        <?php echo $i; ?>
                      </h2>
                    </center>
                  </div>
                  <div class="col-xs-11">
                    <div style="border-bottom: 1px dotted #D2CFFC;padding-bottom: 2px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
                      <span>
                        <b>
                          <?php echo toAscii($album->trackName); ?> by
                          <a target="_blank" href="<?php echo artist_url($album->artistId, $album->artistName); ?>">
                            <?php echo toAscii($album->artistName); ?>
                          </a>
                        </b>
                      </span>
                    </div>
                    <div class="col-xs-6">
                      <div class="mp3-dl" style="text-shadow:none;text-decoration: none;">
                        <a href="javascript:void(0)" onclick="showPlayer_new('<?php echo $i; ?>','<?php echo base64_encode($album->previewUrl); ?>', '<?php echo rawurlencode(toAscii($album->artistName)); ?>', '<?php echo rawurlencode(toAscii($album->trackName)); ?>')" rel="nofollow" id="lk<?php echo $i; ?>" class="play_now">
                          <span>
                            <b>
                              <i class='fa fa-play'>
                              </i><?php echo $lang['play']; ?>
                            </b>
                          </span>
                        </a>
                      </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="mp3-dl" style="text-shadow:none;text-decoration: none;">
                        <a target="_blank" href="<?php echo mp3_url($album->trackName); ?>">
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
                  <div class="col-xs-12">
                    <div id="player<?php echo $i; ?>" class="player" style="padding-right: 0px;">
                    </div>
                  </div>
                </div>
              </div>
              <?php
              $i++;
            }
          }
        }
      }
      ?>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="col-sm-12">
      <div class="row">
        <?php include 'now_download.php';?>
        <?php include 'fresh.php';?>
      </div><!--/row-->
    </div>
  </div>
</div>
</div><!--container-->
<?php include 'footer.php';?>