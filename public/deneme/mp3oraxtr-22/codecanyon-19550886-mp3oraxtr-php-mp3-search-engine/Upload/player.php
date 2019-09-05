<?php
$data_file = unserialize(base64_decode(file_get_contents('includes/website_setting.conf')));
include 'includes/database.php';
include 'includes/functions.php';
if (isset($_GET['mp3id'])) {
  $title = toAscii(rawurldecode($_GET['title']));
  $ref   = base64_decode($_GET['ref']);
}
else {
  die();
}
//  echo $ref;
?>
<div class="player">
  <style>
    audio {
      width: 0;
      height: 0;
    }
    #playerHtml5 {
      background: #0086CE url('<?php echo $siteurl; ?>images/player_bknd.png') 0px -4px repeat-x;
      width: 100%;
      height: 20px;
      color: #fff;
      text-shadow: 1px 1px #000;
      border-radius: 3px;
      -moz-border-radius: 3px;
      -webkit-border-radius: 3px;
      border: 1px #0086CE solid;
    }
    #songPlayPause {
      float: left;
      background: url('<?php echo $siteurl; ?>images/player_sprite.png') 0px 0px no-repeat;
      width: 11px;
      height: 20px;
      margin: 0 5px 0;
      cursor: pointer;
    }
    #songPlayPause.playing {
      background: url('<?php echo $siteurl; ?>images/player_sprite.png') -20px 0px no-repeat;
    }
    #songTime {
      float: left;
      width: 28px;
      height: 20px;
      margin: 0 5px 0 0;
      line-height: 20px;
      font-family: Arial, Tahoma, Verdana;
      font-size: 12px;
      text-align: center;
      cursor: default;
    }
    #songSlider {
      float: left;
      background: #305891;
      background: rgba(0, 0, 0, 0.3);
      width: 50%;
      height: 10px;
      margin: 5px 0 0 0;
    }
    #trackProgress {
      background: #fff;
      background: rgba(0, 0, 0, 0.3);
      width: 0px;
      height: 10px;
    }
    #volIcon {
      float: right;
      background: url('<?php echo $siteurl; ?>images/player_sprite.png') -39px 0px no-repeat;
      width: 8px;
      height: 20px;
      margin: 0 5px 0 0;
    }
    #volumeMeter {
      float: right;
      background: #305891;
      background: rgba(0, 0, 0, 0.3);
      width: 35px;
      height: 10px;
      margin: 5px 5px 0 0;
    }
    #volumeStatus{
      height: 10px;
      background: #fff;
      background: rgba(0, 0, 0, 0.3);
    }
  </style>
  <p>
    <?php echo $lang['full_download'] ?>
    <a href="<?php echo mp3_url($title); ?>">
      <i class="fa fa-download">
      </i>
      <b>
        <?php echo $lang['download_here'] ?>
      </b>
    </a>
  </p>
  <div id="playerHtml5">
    <input id="download_url_<?php echo $_GET['mp3id']; ?>" type="hidden" value="<?php echo $ref; ?>">
    <div id="songPlayPause" onclick="playPause('song')">
    </div>
    <div id="songTime">
      0:00
    </div>
    <div id="songSlider" onclick="setSongPosition(this,event)">
      <div id="trackProgress">
      </div>
    </div>
    <div id="volumeMeter" onclick="setNewVolume(this,event)">
      <div id="volumeStatus">
      </div>
    </div>
    <div id="volIcon">
    </div>
  </div>
</div>