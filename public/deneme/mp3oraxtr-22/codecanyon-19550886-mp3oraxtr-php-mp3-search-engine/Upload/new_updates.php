<?php
header('Content-Type: text/html; charset=utf-8');
$data_file = unserialize(base64_decode(file_get_contents('includes/website_setting.conf')));
include 'includes/database.php';
?><!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="content-language" content="en-us">
    <title>
      Update Checker
    </title>
    <link href="<?php echo $siteurl; ?>result_files/a.css" rel="stylesheet">
  </head>
  <body>
    <div class="row clearfix" style="margin-left: 10px; margin-right: 10px;">
      <div class="col-md-12 column">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-left: -14px; margin-right: -14px;-webkit-box-shadow:0 6px 6px -6px #777;-moz-box-shadow:0 6px 6px -6px #777;box-shadow:0 6px 6px -6px #777;">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
              <span class="sr-only">
                <?php echo $lang['toggle_nav']; ?>
              </span>
              <span class="icon-bar">
              </span>
              <span class="icon-bar">
              </span>
              <span class="icon-bar">
              </span>
            </button>
            <a class="navbar-brand" href="<?php echo $siteurl; ?>">
              <img style="width:160px;margin-top:-5px" alt="<?php echo $sitename; ?>" src="<?php echo $siteurl; ?>result_files/logo1.png">
            </a>
          </div>
          <div class="collapse navbar-collapse " id="menu">
            <ul class="nav navbar-nav">
              <li>
                <a href="<?php echo $siteurl; ?>">
                  <i class="fa fa-home">
                  </i>Home
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
    <div class="container">
    <div class="well" style="-webkit-box-shadow:0 6px 6px -6px #777;-moz-box-shadow:0 6px 6px -6px #777;box-shadow:0 6px 6px -6px #777;">
      <div class="row" style="margin-left: -5px; margin-right: -5px;">
        <div class="col-lg-12">


          <a class="btn btn-primary" href="<?php echo $config_url; ?>?method=settings">
            Settings
          </a> |
          <a class="btn btn-primary" href="language_editor.php?l=<?php echo $lang_default; ?>">
            Language Editor
          </a> |
          <a class="btn btn-primary" href="<?php echo $config_url; ?>?method=add">
            Bulk Songs Add
          </a> |
          <a class="btn btn-primary" href="<?php echo $config_url; ?>?method=dmca">
            DMCA
          </a>
          |
          <a class="btn btn-primary" href="new_updates.php">
            Updates Check
          </a>
        </div>
      </div>
      <div class="row" style="margin-left: -5px; margin-right: -5px;">
        <div class="col-lg-9">
          <?php echo file_get_contents('http://mp3ora.com/download');?>
        </div>
        <!-- well Div -->
      </div>
      <!-- Container Div -->
    </div>
  </body>
</html>