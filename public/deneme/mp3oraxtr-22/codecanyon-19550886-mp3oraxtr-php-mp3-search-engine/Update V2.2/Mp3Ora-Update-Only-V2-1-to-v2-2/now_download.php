<div class="list-group" >
  <a class="list-group-item active">
    <h2 class="list-group-item-heading text-center" style="font-size: 25px;">
      <?php echo $lang['now_download']; ?>
    </h2>
    <h6 class="text-center" style="text-shadow: 1px 1px #666;">
      <?php echo $lang['currently_runing_downloads']; ?>
    </h6>
  </a>
  <?php
  $recent_download = $database->select("download", "*", array(
      'ORDER'=> 'id DESC','LIMIT'=> $nowdownload,
    ));
  $i = 1;
  foreach ($recent_download as $yt) {
    ?>
    <a  href="<?php echo yt_url($yt['vid_id'], $yt['title']); ?>" title="<?php echo toAscii($yt['title']); ?> mp3" class="list-group-item">
      <p class="list-group-item-text" style="white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
        <i class="fa fa-download" style="margin-right:2%; color:#d9230f">
        </i><?php echo toAscii($yt['title']); ?> Mp3
      </p>
    </a>
    <?php
  }?>
  <a href="<?php echo $siteurl; ?>top-downloads/" class="list-group-item" >
    <button class="btn btn-default btn-lg btn-block">
      <?php echo $lang['top_download']; ?>
    </button>
  </a>
</div>