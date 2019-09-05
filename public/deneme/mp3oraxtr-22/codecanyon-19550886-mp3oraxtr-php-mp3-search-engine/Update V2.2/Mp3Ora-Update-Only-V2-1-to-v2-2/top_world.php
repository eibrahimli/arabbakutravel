<?php
$data_file = unserialize(base64_decode(file_get_contents('includes/website_setting.conf')));

include 'includes/database.php';
include 'includes/functions.php';
//  var_dump($_GET);

if (isset($_GET['top']) && $_GET['top'] == 'india') {
  $top_song_url = 'https://itunes.apple.com/in/rss/topsongs/limit=' . $topchart . '/json';
  $title_web    = 'Top ' . $topchart . ' Songs in India';
  $title_web    = sprintf($lang['top_country_songs'], $topchart, 'India');
  $permalink    = 'top-india';
}
elseif (isset($_GET['top']) && $_GET['top'] == 'uk') {
  $title_web    = sprintf($lang['top_country_songs'], $topchart, 'UK');
  $top_song_url = 'https://itunes.apple.com/gb/rss/topsongs/limit=' . $topchart . '/json';
  $permalink    = 'top-world';
}
elseif (isset($_GET['top']) && $_GET['top'] == 'france') {
  $title_web    = sprintf($lang['top_country_songs'], $topchart, 'France');
  $top_song_url = 'https://itunes.apple.com/fr/rss/topsongs/limit=' . $topchart . '/json';
  $permalink    = 'top-france';
}
elseif (isset($_GET['top']) && $_GET['top'] == 'arabic') {
  $title_web    = sprintf($lang['top_country_songs'], $topchart, 'Arabic');
  $top_song_url = 'https://itunes.apple.com/sa/rss/topsongs/limit=' . $topchart . '/json';
  $permalink    = 'top-arabic';
}
elseif (isset($_GET['top']) && $_GET['top'] == 'brazil') {
  $title_web    = sprintf($lang['top_country_songs'], $topchart, 'Brasil');
  $top_song_url = 'https://itunes.apple.com/br/rss/topsongs/limit=' . $topchart . '/json';
  $permalink    = 'top-brazil';
}
else {
  $title_web    = sprintf($lang['top_country_songs'], $topchart, 'World');
  $top_song_url = 'https://itunes.apple.com/us/rss/topsongs/limit=' . $topchart . '/json';
  $permalink    = 'top-world';
}
$itune_song_top = cache_url($top_song_url);
$itune_song_top = json_decode($itune_song_top, true);
$itune_top_song = $itune_song_top['feed']['entry'];

//  echo ' < pre > ';
//  print_r($itune_top_song);
//  echo '</pre > ';

$top_song       = array();
foreach ($itune_top_song as $song) {
  $artist_id = explode('/', $song['im:artist']['attributes']['href']);
  $artist_id = end($artist_id);
  $artist_id = explode('?', $artist_id);
  $artist_id = reset($artist_id);
  $artist_id = str_ireplace('id', '', $artist_id);
  $top_song[] = array(
    'cover'     => artwork($song['im:image'][0]['label'], '100x100', '55x55'),
    'albumname' => toAscii($song['im:collection']['im:name']['label']),
    'albumid'   => $song['id']['attributes']['im:id'],
    'artistname'=> $song['im:artist']['label'],
    'artistid'  => $artist_id,
    'preview'   => base64_encode($song['link'][1]['attributes']['href']),
    'title'     => toAscii($song['im:name']['label']),
  );
}

/*
# Songs Name
# Album Name
# Album ID
# Artist Name
# Artist ID
# Cover Image

*/
// echo ' < pre > ';
// print_r($json_us['feed']['entry']);

/// print_r($itune_top_song);
///  echo ' < h1 > INDIA</h1 > ';
// print_r($album_data_in);

// echo '</pre > ';

?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>
  <?php echo $title_web; ?> - <?php echo $sitename; ?>
</title>
<meta property="og:site_name" content="<?php echo $title_web; ?> -<?php echo $sitename; ?>">
<meta property="og:url" content="<?php echo $siteurl; ?><?php echo $permalink; ?>">
<meta property="og:title" content="<?php echo $title_web; ?> &raquo; <?php echo $sitename; ?>">
<meta property="og:image" content="<?php echo $siteurl; ?>images/social.png">
<link rel="canonical" href="<?php echo $siteurl; ?><?php echo $permalink; ?>">
<meta name="robots" content="index,follow">
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
  h3 {
    position: absolute;
    left: 3px;
    bottom: 3px;
    color: #fff;
  }
</style>

<div class="row" style="margin-left: -5px; margin-right: -5px; ">
  <div class="col-lg-12">
    <center>
      <h1>
        <?php echo $title_web; ?>
      </h1>
    </center>
  </div>
</div>
<div class="row" style="margin-left: -5px; margin-right: -5px; ">
  <div class="col-lg-9">
    <ul id="items">
      <?php $i = 1;
      foreach ($top_song as $yt) {
        ?>
        <li>
          <div class="song-list" style="margin-left: -10px; margin-right: 10px;-webkit-box-shadow:0 6px 6px -6px #777;-moz-box-shadow:0 6px 6px -6px #777;box-shadow:0 6px 6px -6px #777;">
            <div class="col-xs-12">
              <div class="col-md-2 col-xs-3">
                <div class="image">
                  <div class="square-box">
                    <div class="square-content">
                      <img class="img-rounded img-responsive" style="position:absolute;top:0;bottom:0;margin:auto;font-size: 5px;" border="0" alt="<?php echo $yt['title']; ?> - <?php echo $yt['artistname']; ?> mp3" title="<?php echo $yt['title']; ?> - <?php echo $yt['artistname']; ?> mp3" src="<?php echo $yt['cover']; ?>">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-10 col-xs-9">
                <div style="border-bottom: 1px dotted #D2CFFC;padding-bottom: 2px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
                  <span>
                    <b>
                      <i class="fa fa-music" style="color:#d9230f;">
                      </i><?php echo $yt['title']; ?> mp3
                    </b>
                  </span>
                </div>
                <div style="font-size: 13px;border-bottom: 1px dotted #D2CFFC;padding-top: 2px;padding-bottom: 2px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
                  <span>
                    <b>
                      <i class="fa fa-user" title="Artist" style="color:#d9230f;">
                      </i>
                    </b><?php echo $lang['artist']; ?>:
                    <a href="<?php echo artist_url($yt['artistid'], $yt['artistname']); ?>">
                      <?php echo $yt['artistname']; ?>
                    </a>
                    <b>
                      <i class="fa fa-folder-open" title="Album" style="color:#d9230f;">
                      </i>
                    </b><?php echo $lang['album']; ?>:
                    <a href="<?php echo album_url($yt['albumid'], $yt['albumname']); ?>">
                      <?php echo $yt['albumname']; ?>
                    </a>
                  </span>
                </div>
                <div class="col-xs-6">
                  <div class='mp3-dl' style='text-shadow:none;text-decoration: none;'>
                    <a href='javascript:void(0)'  onclick="showPlayer_new('<?php echo $i; ?>','<?php echo $yt['preview']; ?>', '<?php echo rawurlencode($yt['artistname']); ?>', '<?php echo rawurlencode($yt['title'] . ' ' . $yt['artistname']); ?>')" rel='nofollow' id='lk<?php echo $i; ?>' class='play_now'>
                      <span>
                        <b>
                          <i class="fa fa-play">
                          </i><?php echo $lang['play']; ?>
                        </b>
                      </span>
                    </a>
                  </div>
                  <div class="mp3-dl" style="text-shadow:none;text-decoration: none;">
                    <a href="<?php echo mp3_url($yt['title'] . ' ' . $yt['artistname']); ?>">
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
                <div id="player<?php echo $i; ?>" class="player">
                </div>
              </div>
            </div>
          </div><!--song-list-->
        </li>
        <?php $i++;
      }?>
    </ul>
    <?php $li_page = true;?>
    <div class="clearfix">
    </div>
  </div><!-- /.col-md-9 -->
  <div class="col-lg-3">
    <div class="col-sm-12">
      <div class="row" >
        <!--/div class="list-group">
        </div--><!--/right-->
        <?php include 'now_download.php';?>
        <?php include 'fresh.php';?>
      </div><!--/row-->
    </div>
  </div>
</div> </div> <!-- /.row -->
<?php include 'footer.php';?>