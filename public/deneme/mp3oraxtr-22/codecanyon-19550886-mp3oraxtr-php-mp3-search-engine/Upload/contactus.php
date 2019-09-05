<?php
//session_start();
$data_file = unserialize(base64_decode(file_get_contents('includes/website_setting.conf')));
include 'includes/database.php';
include 'includes/functions.php';
// include('includes / config.php');

?><!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>
  Contact us
</title>
<meta name="description" content="We appreciate any feedback about your overall experience on our site or how to make it even better.">
<meta property="og:site_name" content="Contact Us - <?php echo $sitename; ?>">
<meta property="og:url" content="<?php echo $siteurl; ?>contctus.php">
<meta property="og:title" content="Contact Us -  - <?php echo $sitename; ?>">
<meta property="og:description" content="Contact Us">
<meta property="og:image" content="<?php echo $siteurl; ?>images/social.png">
<link rel="canonical" href="<?php echo $siteurl; ?>contactus.php">
<meta name="googlebot" content="index,follow,noodp">
<meta name="robots" content="index,follow,noydir">
<?php include 'header.php';?>
</center><br>
<?php
if (isset($_POST['submit']) && $_POST['submit'] != '') {


  try {
    // Run CSRF check, on POST data, in exception mode, for 10 minutes, in one - time mode.
    NoCSRF::check( 'csrf_token_contact', $_POST, true, 60 * 10, false );

    $client_captcha_response = $_POST['g-recaptcha-response'];
    $user_ip                 = $_SERVER['REMOTE_ADDR'];
    $captcha_verify          = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$gsecret&response=$client_captcha_response&remoteip=$user_ip");
    $captcha_verify_decoded  = json_decode($captcha_verify);
    if (!$captcha_verify_decoded->success) {
      die('DIRTY ROBOT');
    }
    $name        = $_POST['name'];
    $emails      = $_POST['email'];
    $message     = $_POST['message'];
    $reason      = $_POST['reason'];
    $from        = 'From: ' . $sitename;
    $to          = $email;
    $subject     = 'Request Form';
    $message_err = '';
    $body        = "Name: $name \n E-Mail: $emails \nMessage:\n$message \nReason:\n$reason";
    if ($_POST['submit']) {
      if ($emails != '') {
        if (mail($to, $subject, $body, $from)) {
          $message_err .= '<div class="alert alert-success"> You have successfully submitted your Contact US!</div>';
        }
        else {
          $message_err .= '<div class="alert alert-danger"> Something went wrong, Please try again in few minute!!</div>';
        }
      }
      else {
        $message_err .= '<div class="alert alert-danger">You need to fill in all required fields!!</div>';
      }
    }

  }
  catch ( Exception $e ) {
    // CSRF attack detected
    $result = $e->getMessage() . ' Form ignored.';
    die($result);
  }
}
?>
<div class="row" style="margin-left: -5px; margin-right: -5px;">
  <div class="col-lg-12">
    <center>
      <h1>
        Disclaimer
      </h1>
    </center>
  </div>
</div>
<div class="row" style="margin-left: -5px; margin-right: -5px;">
  <div class="col-lg-9">
    <div class="song-list" style="margin-left: -10px; margin-right: 10px;">
      <div style="padding: 10px;" id="contact_form" class="row">
        <div class="col-12 col-sm-12 col-lg-12">
          <h2>
            Contact Us
          </h2>
          <?php
          if (isset($message_err) && $message_err != '') {
            echo $message_err;
          }
          ?>
          <form role="form" id="feedbackForm" action="contactus.php" method="post"  data-toggle="validator" data-disable="false">
            <div class="form-group">
              <label class="control-label" for="name">
                Name *
              </label>
              <div class="input-group">
                <?php $token_contact = NoCSRF::generate( 'csrf_token_contact' );?>
                <input type="hidden" name="csrf_token_contact" value="<?php echo $token_contact;?>">
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required/>
                <span class="input-group-addon">
                  <i class="fa fa-user">
                  </i>
                </span>
              </div>
              <span class="help-block" style="display: none;">
                Please enter your name.
              </span>
            </div>
            <div class="form-group">
              <label class="control-label" for="email">
                Reason for Contact *
              </label>
              <select name="reason" class="form-control" required>
                <option value="DMCA">
                  Copyright Infringement
                </option>
                <option value="General" selected="">
                  General
                </option>
                <option value="Advertisment">
                  Advertisment
                </option>
              </select>
              <span class="help-block" style="display: none;">
                Please enter a valid e-mail address.
              </span>
            </div>
            <div class="form-group">
              <label class="control-label" for="email">
                Email Address *
              </label>
              <div class="input-group">
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required/>
                <span class="input-group-addon">
                  <i class="fa fa-envelope">
                  </i>
                </span>
              </div>
              <span class="help-block" style="display: none;">
                Please enter a valid e-mail address.
              </span>
            </div>
            <div class="form-group">
              <label class="control-label" for="message">
                Message *
              </label>
              <div class="input-group">
                <textarea rows="5" cols="30" class="form-control" id="message" name="message" placeholder="Enter your message" required>
                </textarea>
                <span class="input-group-addon">
                  <i class="fa fa-pencil">
                  </i>
                </span>
              </div>
              <span class="help-block" style="display: none;">
                Please enter a message.
              </span>
            </div>
            <div class="form-group">
              <div class="g-recaptcha" data-sitekey="<?php echo $gkey; ?>">
              </div>
              <span class="help-block" style="display: none;">
                Please check that you are not a robot.
              </span>
            </div>
            <span class="help-block" style="display: none;">
              Please enter a the security code.
            </span>
            <button type="submit" name="submit" value="submit" id="feedbackSubmit" class="btn btn-primary btn-lg" data-loading-text="Sending..." style="display: block; margin-top: 10px;">
              <i class="fa fa-send">
              </i>Send Feedback
            </button>
          </form>
          <script src='https://www.google.com/recaptcha/api.js'>
          </script>
        </div><!--/span-->
      </div><!--/row-->
    </div><!--song-list-->
  </div><!-- /.col-md-9 -->
  <div class="col-lg-3">
    <div class="col-sm-12">
      <div class="row">
        <!--/div class="list-group">
        </div--><!--/right-->
        <div class="fb-like" data-href="https://www.facebook.com/oMp3x/" data-layout="button_count" data-action="like" data-size="large" data-show-faces="false" data-share="false">
        </div> <br><br>
        <?php include 'now_download.php';?>
        <?php include 'fresh.php';?>
      </div><!--/row-->
    </div>
  </div>
</div>
</div>
<?php include 'footer.php';?>