<div class="list-group" >
  <a class="list-group-item active">
    <h2 class="list-group-item-heading text-center" style="font-size: 25px;" >
      <?php echo $lang['fresh_music_by']; ?>  <?php echo $sitename; ?>
    </h2>
    <h6 class="text-center" >
      <?php echo $lang['recent_added_mp3']; ?> <?php echo $sitename; ?>
    </h6>
  </a>
  <?php
  $fresh_song = $database->query('SELECT tag
    FROM search
    ORDER BY id DESC
    LIMIT ' . $freshsong)->fetchAll(PDO::FETCH_ASSOC);
  //var_dump($fresh_song);
  foreach ($fresh_song as $fsong) {
    //   print_r($fsong);
    $fsong = ucwords($fsong['tag']);
    ?>
    <a  href="<?php echo mp3_url($fsong); ?>" title="<?php echo toAscii($fsong); ?> mp3" class="list-group-item">
      <p class="list-group-item-text" style="white-space:nowrap;overflow:hidden;text-overflow: ellipsis;">
        <i class="fa fa-music" style="margin-right:2%; color:#d9230f">
        </i><?php echo toAscii($fsong); ?> Mp3
      </p>
    </a>
    <?php
  }?>
  <a href="<?php echo $siteurl; ?>fresh/" class="list-group-item" >
    <button class="btn btn-default btn-lg btn-block">
      <?php echo $lang['fresh']; ?>
    </button>
  </a>
</div>