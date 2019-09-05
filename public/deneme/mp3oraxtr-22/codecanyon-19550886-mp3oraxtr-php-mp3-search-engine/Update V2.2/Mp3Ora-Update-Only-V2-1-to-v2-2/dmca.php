<?php
//session_start();
$data_file = unserialize(base64_decode(file_get_contents('includes/website_setting.conf')));
include 'includes/database.php';
include 'includes/functions.php';
// include('includes / config.php');
?><!DOCTYPE html>
<html  lang="<?php echo $_SESSION['lang']; ?>"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>
  Copyright Complaint Form
</title>
<meta name="description" content="On this website if you find links that lead to audio files. These files are stored somewhere else on the internet and are NOT a part of this website.">
<meta property="og:site_name" content="DMCA - <?php echo $sitename; ?>">
<meta property="og:url" content="<?php echo $siteurl; ?>dmca.php">
<meta property="og:title" content="DMCA - <?php echo $sitename; ?>">
<meta property="og:description" content="Copyright Complaint Form">
<meta property="og:image" content="<?php echo $siteurl; ?>images/social.png">
<link rel="canonical" href="<?php echo $siteurl; ?>dmca.php">
<meta name="googlebot" content="index,follow,noodp">
<meta name="robots" content="index,follow,noydir">
<?php include 'header.php';


if (isset($_POST['submit']) && $_POST['submit'] != '') {

  try {
    // Run CSRF check, on POST data, in exception mode, for 10 minutes, in one - time mode.
    NoCSRF::check( 'csrf_token_dmca', $_POST, true, 60 * 10, false );

    $client_captcha_response = $_POST['g-recaptcha-response'];
    $user_ip                 = $_SERVER['REMOTE_ADDR'];
    $captcha_verify          = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$gsecret&response=$client_captcha_response&remoteip=$user_ip");
    $captcha_verify_decoded  = json_decode($captcha_verify);
    if (!$captcha_verify_decoded->success) {
      die('DIRTY ROBOT');
    }
    $name        = $_POST['name'];
    $email       = $_POST['email'];
    $message     = $_POST['message'];
    $reason      = $_POST['reason'];
    $from        = 'From: ' . $sitename;
    $to          = $dmca;
    $subject     = 'DMCA Form';
    $message_err = '';
    $body        = "Name: $name \n E-Mail: $email \nMessage:\n$message \nReason:\n$reason";
    if ($_POST['submit']) {
      if ($email != '') {
        if (mail($to, $subject, $body, $from)) {
          $message_err .= '<div class="alert alert-success"> You have successfully submitted your DMCA/Complaint!</div>';
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
</center><br>
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
          <span>
            <b>
              1.
            </b>We does not host any of the music files displayed on this site.<br>
            <b>
              2.
            </b>We indexes these files which are located on remote servers which
            neither we nor it's affiliates have any connection with / control of /
            association with.<br>
            <b>
              3.
            </b>You download mp3 files from another host service. (not from our server)<br>
            <b>
              4.
            </b>All music on is presented only for fact-finding listening.<br>
            <b>
              5.
            </b>You must remove a song from the computer after listening.<br>
            <b>
              6.
            </b>If You won't delete files from the computer, You'll break the copyrights
            protection laws.<br>
            <b>
              7.
            </b>All the rights on the songs are the property of their respective owners.<br>
            <b>
              8.
            </b>We are a Music Search Engine, so we do not store or host any mp3 file and other copyright material at our server, but we respect Copyright Laws. So if You have found a search result to an illegal mp3 file please use the form below.<br><br>
            As a general matter, we respect the rights of artists and
            creators, and hope you will work with us to keep our community a creative,
            legal and positive experience for everyone, including artists and creators.
            Please note that under Section 512(f) any person who knowingly materially
            misrepresents that material or activity is infringing may be subject to
            liability for damages.
            <font color="#FF0000">
              <strong>
                Don't
                make false claims!
              </strong>
            </font><br><br>
            Please also note that the information provided in this legal notice may
            be forwarded to the person who provided the allegedly infringing content.<br><br>
            <div class="alert alert-danger" role="alert" style="color:black;text-shadow: 1px 1px #fff;">
              <span>
                <b>
                  <i class="fa fa-info-circle">
                  </i>How to file removal request:
                </b>
                <ol>
                  <li>
                    Please note that we only accept request to remove our search result pages
                    <b style="background-color: #66FF66;">
                      (Example : <?php echo mp3_url('your-removal-request-query'); ?>)
                    </b>(
                    <font color="#FF0000">
                      Other pages removal requests will be ignored
                    </font>).
                  </li>
                  <li>
                    Put each link in separate line in Complaint Form.
                  </li>
                  <li>
                    Don't request to remove links from
                    <b style="background-color: #66FF66">
                      /ydls.php/
                    </b>,
                    <b style="background-color: #66FF66">
                      /download.php/
                    </b>directories because users don't have direct access to these links and we have already blocked them from search engines (
                    <a href="<?php echo $siteurl; ?>robots.txt">
                      robots.txt
                    </a>).
                  </li>
                  <li>
                    Again...
                    <b style="background-color: #66FF66">
                      /download.php/
                    </b>,
                    <b style="background-color: #66FF66">
                      /ydls.php/
                    </b>are only virtual and redirect (302) directories (URL shortcut).
                  </li>
                  <li>
                    Please don't send us more then 20 links in a day so that we can examine & block them properly.
                  </li>
                  <li>
                    Once again.. Please note that we are only a Music Search Engine, so we do not store or host any mp3 file and other copyright material at our server.
                  </li>
                </ol>
              </span>
            </div>
            <b>
              Please allow 6-7 business days for an email response. Note that emailing your complaint to other parties such as our Internet Service Provider will not expedite your request and may result in a delayed response due the complaint not properly being filed.
            </b>
          </span><br><br>
          <h2>
            Copyright Complaint Form
          </h2>
          <?php
          if (isset($message_err) && $message_err != '') {
            echo $message_err;
          }
          ?>
          <form role="form" id="feedbackForm" action="dmca.php" method="post"  data-toggle="validator" data-disable="false">
            <div class="form-group">
              <label class="control-label" for="name">
                Name *
              </label>
              <div class="input-group">
                <?php $token_dmca = NoCSRF::generate( 'csrf_token_dmca' );?>
                <input type="hidden" name="csrf_token_dmca" value="<?php echo $token_dmca;?>">
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
      <div class="row" >
        <!--/div class="list-group">
        </div--><!--/right-->
        <div class="fb-like" data-href="https://www.facebook.com/oMp3x/" data-layout="button_count" data-action="like" data-size="large" data-show-faces="false" data-share="false">
        </div><br><br>
        <?php include 'now_download.php';?>
        <?php include 'fresh.php';?>
      </div><!--/row-->
    </div>
  </div>
</div>
</div>
<?php include 'footer.php';?>