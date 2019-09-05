<?php
$data_file       = unserialize(base64_decode(file_get_contents('includes/website_setting.conf')));
include 'includes/database.php';
include 'includes/functions.php';

$recent_download = $database->select("search", "tag", array(
    'ORDER'=> 'id DESC','LIMIT'=> 300,
  ));
?>
<!DOCTYPE html>
<!-- saved from url=(0037)http://www.emp3z.ws/mp3/bop-beat.html -->
<html lang="<?php echo $_SESSION['lang']; ?>"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="content-language" content="en-us">
<title>
  Today TOP Fresh Download - <?php echo $sitename; ?>
</title>
<meta name="keywords" content="<?php echo $sitename; ?>">
<meta property="og:site_name" content="Fresh Top - <?php echo $sitename; ?>">
<meta property="og:url" content="<?php echo $siteurl; ?>fresh/">
<meta property="og:title" content="Today TOP Fresh Download &raquo; <?php echo $sitename; ?>">
<meta property="og:image" content="<?php echo $siteurl; ?>images/social.png">
<link rel="canonical" href="<?php echo $siteurl; ?>fresh/">
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
</style>

<div class="row" style="margin-left: -5px; margin-right: -5px; ">
  <div class="col-lg-12">
    <center>
      <h1>
        Today's Fresh Download
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
          <div class="song-list" style="margin-left: -10px; margin-right: 10px;">
            <div class="col-xs-12" style="padding-bottom: 1%;padding-top: 1%;padding-left: 2%;padding-right: 2%;white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
              <span>
                <b>
                  <?php echo $i; ?>.
                </b>
                <a href="<?php echo mp3_url($yt); ?>">
                  <?php echo toAscii($yt); ?> mp3
                </a>
              </span>
            </div>
            <div style="clear:both;">
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

      </div><!--/row-->
    </div>
  </div>
</div> </div> <!-- /.row -->
<?php include 'footer.php';?>