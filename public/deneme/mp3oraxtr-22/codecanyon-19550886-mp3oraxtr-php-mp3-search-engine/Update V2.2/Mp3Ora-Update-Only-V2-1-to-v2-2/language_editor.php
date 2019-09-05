<?php
header('Content-Type: text/html; charset=utf-8');
$data_file = unserialize(base64_decode(file_get_contents('includes/website_setting.conf')));
include 'includes/database.php';
#include('class / nocsrf.php');

if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
  if ($_POST) {

    # NoCSRF::check( 'csrf_token', $_POST, true, 60 * 10, false );
    //echo $lang_default;
    $input_lang = strip_tags($_POST['language']);
    $clean      = preg_match('/^[a-zA-Z\s]+$/', $input_lang, $return);
    $lang_get   = strtolower($return[0]);
    if (isset($lang_get) && $lang_get != '') {
      $lang_set = true;
    }
    else {
      die('Language not selected');
    }
    //echo $lang;
    if ($lang_set == true) {
      foreach ($available_langs as $lang_avail) {
        if ($lang_avail == $lang_get) {
          // echo 'language availagle';
          $lang_find = true;
          break;
        }
        else {
          $lang_find = false;
        }
      }
    }
    if ($lang_find == true) {
      $lang_file          = 'lang/lang.' . $input_lang . '.php';
      $lang_text_creating = '<?php ' . "\n";
      foreach ($_POST as $val1 => $text1) {
        $text1 = stripslashes($text1);
        $text1 = addslashes($text1);
        if ($val1 != 'language') {
          $lang_text_creating .= '$lang[\'' . $val1 . '\']=\'' . $text1 . '\';' . "\n";
        }
      }
      @chmod($lang_file, 0777);
      $f = fopen($lang_file, 'w+');
      if (!fwrite($f, $lang_text_creating) > 0) {
        $error_msg = 'Unable to Edit Language File, Please provide write permission to "/lang/" directory and all files inside';
      }
      else {
        $error_msg = 'Language Updated succesfully';
      }
      fclose($f);
      @chmod($lang_file, 0644);
      //echo $lang_text_creating;
    }
    else {
      die('No language Selected, while submiting language file');
    }

  }
  else {
    if (isset($_GET['l']) && $_GET['l'] != '') {
      $input_lang = strip_tags($_GET['l']);
      $clean      = preg_match('/^[a-zA-Z\s]+$/', $input_lang, $return);
      $lang_get   = strtolower($return[0]);
      if (isset($lang_get) && $lang_get != '') {
        $lang_set = true;
      }
      else {
        die('Language not selected');
      }
      //echo $lang;
      if ($lang_set == true) {
        foreach ($available_langs as $lang_avail) {
          if ($lang_avail == $lang_get) {
            // echo 'language availagle';
            $lang_find = true;
            break;
          }
          else {
            $lang_find = false;
          }
        }
      }
    }
    else {
      die("Language not selected");
    }
  }
  if ($lang_find == true) {
    ?>
    <!DOCTYPE html>
    <html>
      <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="content-language" content="en-us">
        <title>
          Language Editor
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
                <form class="form-horizontal" method="post" action="language_editor.php">
                  <fieldset>
                    <!-- Form Name -->
                    <legend>
                      Language Editor
                    </legend>
                    <?php
                    if (isset($error_msg) && $error_msg != '') {
                      ?>
                      <div class="alert alert-info">
                        <?php echo $error_msg; ?>
                      </div>
                      <?php
                    }?>
                    <!-- Text input-->
                    <!-- Text input-->
                    <?php #$token = NoCSRF::generate( 'csrf_token' );?>

                    <input type="hidden" name="language" value="<?php echo $lang_get; ?>">
                    <?php include 'lang/lang.' . $lang_get . '.php';
                    //var_dump($lang);
                    foreach ($lang as $var => $text) {
                      ?>
                      <div class="form-group">
                        <label class="col-md-3 control-label" for="<?php echo $var; ?>">
                          <?php echo $var; ?>
                        </label>
                        <div class="col-md-6">
                          <input id="<?php echo $var; ?>" required="true" name="<?php echo $var; ?>" value="<?php echo $text; ?>" placeholder="<?php echo $text; ?>" class="form-control input-md" required="" type="text">
                        </div>
                      </div>
                      <?php
                    }
                    ?>
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="savelang">
                        Save Language
                      </label>
                      <div class="col-md-4">
                        <input type="submit" id="savelang" value="Save Language" class="btn btn-primary">
                      </div>
                    </div>
                  </fieldset>
                </form>
              </div>
              <div class="row"  style="margin-left: -25px; margin-right: -25px;">
                <div class="col-md-3">
                  <div class="col-md-12">
                    <h3>
                      Select Language to edit
                    </h3>
                    <?php
                    foreach ($available_langs as $lang_text) {
                      ?>
                      <a class="btn btn-primary " style="margin-bottom: 5px; margin-top: 5px;" href="language_editor.php?l=<?php echo $lang_text; ?>">
                        Edit (<?php echo $lang_text; ?>) Language
                      </a>
                      <?php
                    }?>
                  </div>
                </div>
              </div>
            </div>
            <!-- well Div -->
          </div>
          <!-- Container Div -->
        </div>
      </body>
    </html>
    <?php
  }
  else {
    die('Langauge File is not existed');
  }
}
else {
  header('Location: ' . $config_url);
}