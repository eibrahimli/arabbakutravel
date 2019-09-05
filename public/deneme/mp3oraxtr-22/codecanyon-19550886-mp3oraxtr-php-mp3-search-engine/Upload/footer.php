<div class="col-md-12 column">
  <div class="row clearfix">
    <div class="alert alert-info" style="color:black;box-shadow:0 6px 6px -6px #777;">
      <center>
        Powered by:
        <a href="http://Mp3Ora.com/" target="_blank">
          Mp3Ora
        </a>- Copyright &copy;
        <a href="<?php echo home_url(); ?>" title="<?php echo $lang['title_home']; ?>">
          <?php echo $lang['title_home']; ?>
        </a>
      </center>
    </div>
  </div>
</div>
<!--script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pace/0.6.0/pace.min.js"></script//-->
<script src="<?php echo $siteurl; ?>result_files/jquery.js">
</script>
<script type="text/javascript" src="<?php echo $siteurl; ?>result_files/bootstrap.js">
</script>
<script type="text/javascript" src="<?php echo $siteurl; ?>result_files/script.js">
</script>
<?php
if ($install == true) {
  ?>
  <script>
    $('#country1').change(function(){
        var selected_item2 = $(":selected", this).text()
        $('#country1name').val(selected_item2).addClass('hidden');
      });
    $('#country2').change(function(){
        var selected_item1 = $(":selected", this).text()
        $('#country2name').val(selected_item1).addClass('hidden');
      });
    $('#countrytop').change(function(){
        var selected_item3 = $(":selected", this).text()
        $('#countrytopname').val(selected_item3).addClass('hidden');
      });
    $(function() {
        if($("#downloadmanage").val() == 4){
          //alert(("#downloadmanage").val())//I'm supposing the "Other" option value is 0.
          $("#custom_api_show").show();
        } else {
          $("#custom_api_show").hide();
        }
      });
    $('#downloadmanage').change(function() {
        if($("#downloadmanage").val() == 4){
          //alert(("#downloadmanage").val())//I'm supposing the "Other" option value is 0.
          $("#custom_api_show").show();
        } else {
          $("#custom_api_show").hide();
        }
      });

  </script>
  <?php
}
?>
<?php
if ($downloads == true) {
  ?>
  <script>
    $(document).ready(function(){
        $(".download_now").click(function() {
            $(".download_now").hide();
            $("#iframe").show();
          });

        $('#download_button_show').click(function() {
            $('#download_show').toggle('slow');
          });
      });

  </script>
  <?php
}
?>
<script>
  $(function() {
      $("img.lazy").lazyload({
          effect : "fadeIn"
        });
    });
</script>
<?php
if ($li_page == true) {
  ?>
  <script type="text/javascript">
    $(document).ready(function(){  jQuery(function($){ $('ul#items').easyPaginate({ step:25 }); }); });
  </script>
  <?php
}?>
<?php echo $counter_footer; ?>
</body></html>
<?php
/*
$fp = fopen($file, 'w'); // open the cache file for writing
$content_cache=ob_get_contents().'<!-- Cache -->';
fwrite($fp, $content_cache); // save the contents of output buffer to the file
fclose($fp); // close the file
ob_end_flush(); // Send the output to the browser
*/
?>