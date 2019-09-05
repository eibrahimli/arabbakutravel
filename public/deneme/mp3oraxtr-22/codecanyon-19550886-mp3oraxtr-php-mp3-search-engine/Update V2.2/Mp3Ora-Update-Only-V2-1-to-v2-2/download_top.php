<?php $data_file       = unserialize(base64_decode(file_get_contents('includes/website_setting.conf')));
include 'includes/database.php';
include 'includes/functions.php';
$recent_download = $database->
select("download", "*", array('ORDER'=> 'id DESC','LIMIT'=> 300));?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="content-language" content="en-us">
<title>
  <?php echo $lang['top_mp3_download']; ?> -
  <?php echo $sitename; ?>
</title>
<meta name="keywords" content="<?php echo $sitename; ?>">
<meta property="og:site_name" content="<?php echo $lang['top_mp3']; ?> - <?php echo $sitename; ?>">
<meta property="og:url" content="<?php echo $siteurl; ?>top-download/">
<meta property="og:title" content="<?php echo $lang['top_mp3_download']; ?> &raquo;  <?php echo $sitename; ?>">
<meta property="og:image" content="<?php echo $siteurl; ?>images/social.png">
<link rel="canonical" href="<?php echo $siteurl; ?>top-downloads/">
<meta name="robots" content="index,follow">
<?php include 'header.php';?>
</center>
<br>
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
        <?php echo $lang['today_top_download']; ?>
      </h1>
    </center>
  </div>
</div>
<div class="row" style="margin-left: -5px; margin-right: -5px; ">
  <div class="col-lg-9">
    <ul id="items">
      <?php $i = 1;
      foreach ($recent_download as $yt) {
        ?>
        <li>
          <div class="song-list" style="margin-left: -10px; margin-right: 10px;-webkit-box-shadow:0 6px 6px -6px #777;-moz-box-shadow:0 6px 6px -6px #777;box-shadow:0 6px 6px -6px #777;">
            <div class="col-xs-12">
              <div class="col-md-2 col-xs-3">
                <div class="square-box">
                  <div class="square-content">
                    <img class="img-rounded img-responsive" style="position:absolute;top:0;bottom:0;margin:auto;font-size: 5px;" border="0" alt="<?php echo ucfirst(strtolower($yt['title'])); ?> mp3" title="Free <?php echo $yt['title']; ?> mp3"
                    src="<?php echo $yt['cover']; ?>">
                  </div>
                </div>
              </div>
              <div class="col-md-10 col-xs-9">
                <div style="border-bottom: 1px dotted #D2CFFC;padding-bottom: 2px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
                  <span>
                    Free
                    <?php echo $yt['title']; ?>
                    <b>
                      mp3
                    </b>
                  </span>
                </div>
                <div style="font-size: 13px;border-bottom: 1px dotted #D2CFFC;padding-top: 2px;padding-bottom: 2px;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
                  <span>
                    <b>
                      <i class="fa fa-rocket" title="Bitrate" style="color:#d9230f;">
                      </i>
                    </b>
                    <?php echo $yt['bits']; ?>
                    <b>
                      <i class="fa fa-hdd-o" title="File Size" style="color:#d9230f;">
                      </i>
                    </b>
                    <?php echo $yt['size']; ?>
                    <b>
                      <i class="fa fa-clock-o" title="Song Duration" style="color:#d9230f;">
                      </i>
                    </b>
                    <?php echo $yt['duration']; ?>
                    <b>
                      <i class="fa fa-heart" title="Added to Favorite" style="color:red;">
                      </i>
                    </b>
                    <?php echo $yt['like']; ?>
                  </span>
                </div>
                <div class="col-xs-6" style="padding-left: 0;">
                  <div class="mp3-dl" style="text-shadow:none;text-decoration: none;">
                    <div id="result_<?php echo $i; ?>">
                      <a href="/yt/<?php echo $yt['vid_id']; ?>" title="free <?php echo $yt['title']; ?>" rel="nofollow" class="player_link <?php echo $i; ?>">
                        <span>
                          <b>
                            <i class="fa fa-play">
                            </i>&nbsp;<?php echo $lang['play']; ?>
                          </b>
                        </span>
                      </a>
                    </div>
                  </div>
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
          </div>
          <!--song-list-->
        </li>
        <?php $i++;
      }?>
    </ul>
    <?php $li_page = true;?>
    <div class="clearfix">
    </div>
  </div>
  <!-- /.col-md-9 -->
  <div class="col-lg-3">
    <div class="col-sm-12">
      <div class="row">
        <!--/div class="list-group">
        </div-->
        <!--/right-->
        <?php include 'now_download.php';?>
        <?php include 'fresh.php';?>
      </div>
      <!--/row-->
    </div>
  </div>
</div>
</div>
<!-- /.row -->
<?php include 'footer.php';?>