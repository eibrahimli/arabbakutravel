<?php
        // checking $protocol in HTTP or HTTPS
function protocol()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
   
    return $protocol;
}
$installFile = "../Mp3Ora";
$indexFile = "../index.php";
$configFolder = "../includes";
$cache = "../cache";
$configFile = "../includes/config.php";
$sampleConfig = "sampleconfig";

function import_db($dbdata) {

	$mysqli = new mysqli($dbdata['host'], $dbdata['user'], $dbdata['pass'], $dbdata['db']);
    
    $site_title=$dbdata['site_title'];
    $phone=$dbdata['phone'];
    $email=$dbdata['email'];
    $sendmail=$dbdata['sendmail'];
    $grcsite=$dbdata['grcsite'];
    $grcsecret=$dbdata['grcsecret'];

	if (mysqli_connect_errno()) return false;

	$query = $dbdata['query'];

    $query .= "INSERT INTO `search` (`tag`) VALUES ('test')";

	$mysqli->multi_query($query);

    if($mysqli->errno) die($mysqli->error);
    
	$mysqli->close();

	return true;
}

if (is_file($installFile)) {
	$step = isset($_GET['step']) ? $_GET['step'] : '';

	if ($step == '') {
		if (!is_file($configFile)) {
			@touch($configFile);
			@chmod($configFile, 0777);
		}

?>   
    <ul class="steps">
      <li class="active pk">Checklist</li>
      <li>Verify</li>
      <li>Database</li>
      <li>Site Config</li>
      <li class="last">Done!</li>
    </ul>
    <h3>Pre-Install Checklist</h3>
    <?php

		$error = FALSE;
		if (!is_writeable($configFolder)) {
			$error = TRUE;
			echo "<div class='alert alert-error'><i class='icon-remove'></i> Config Folder (includes/) is not writeable!</div>";
		}
		if (!is_writeable($cache)) {
			$error = TRUE;
			echo "<div class='alert alert-error'><i class='icon-remove'></i> Cache Folder (cache/) is not writeable!</div>";
		}
		if (!is_writeable($configFile)) {
			$error = TRUE;
			echo "<div class='alert alert-error'><i class='icon-remove'></i> Config File (includes/config.php) is not writeable!</div>";
		}
		if (phpversion() < "5.4") {
			$error = TRUE;
			echo "<div class='alert alert-error'><i class='icon-remove'></i> Your PHP version is " .
				phpversion() . "! PHP 5.4 or higher required!</div>";
		} else {
			echo "<div class='alert alert-success'><i class='icon-ok'></i> You are running PHP " .
				phpversion() . "</div>";
		}
		if (!extension_loaded('mcrypt')) {
			$error = TRUE;
			echo "<div class='alert alert-error'><i class='icon-remove'></i> Mcrypt PHP extension missing!</div>";
		} else {
			echo "<div class='alert alert-success'><i class='icon-ok'></i> Mcrypt PHP extension loaded!</div>";
		}
		if (!extension_loaded('mysqli')) {
			$error = TRUE;
			echo "<div class='alert alert-error'><i class='icon-remove'></i> Mysqli PHP extension missing!</div>";
		} else {
			echo "<div class='alert alert-success'><i class='icon-ok'></i> Mysqli PHP extension loaded!</div>";
		}
		if (!extension_loaded('mbstring')) {
			$error = TRUE;
			echo "<div class='alert alert-error'><i class='icon-remove'></i> MBString PHP extension missing!</div>";
		} else {
			echo "<div class='alert alert-success'><i class='icon-ok'></i> MBString PHP extension loaded!</div>";
		}
		if (!extension_loaded('gd')) {
			$error = TRUE;
			echo "<div class='alert alert-error'><i class='icon-remove'></i> GD PHP extension missing!</div>";
		} else {
			echo "<div class='alert alert-success'><i class='icon-ok'></i> GD PHP extension loaded!</div>";
		}
		if (!extension_loaded('curl')) {
			$error = TRUE;
			echo "<div class='alert alert-error'><i class='icon-remove'></i> CURL PHP extension missing!</div>";
		} else {
			echo "<div class='alert alert-success'><i class='icon-ok'></i> CURL PHP extension loaded!</div>";
		}

?>
    <div class="bottom">
      <?php

		if ($error) {

?>
      <a href="#" class="btn btn-primary disabled">Next Step</a>
      <?php

		} else {

?>
      <a href="index.php?step=0" class="btn btn-primary">Next Step</a>
      <?php

		}

?>
    </div>      


<?php

	} elseif ($step == '0') {

?>
         <ul class="steps">
      <li class="ok"><i class="icon icon-ok"></i>Checklist</li>
      <li class="active">Verify</li>
      <li>Database</li>
      <li>Site Config</li>
      <li class="last">Done!</li>
    </ul>
    <h3>Verify your purchase</h3>
    
       <?php

		if ($_POST) {
			$code = $_POST["code"];
			$username = $_POST["username"];

			$curl_handle = curl_init();
			curl_setopt($curl_handle, CURLOPT_URL, 'http://mp3ora.com/api_license/');
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle, CURLOPT_POST, 1);
			$referer = protocol() . $_SERVER["SERVER_NAME"] . substr($_SERVER["REQUEST_URI"],
				0, -24);
			$path = substr(realpath(dirname(__FILE__)), 0, -8);
			curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
				'username' => $_POST["username"],
				'code' => $_POST["code"],
				'id' => '5580519',
				'ip' => $_SERVER['REMOTE_ADDR'],
				'referer' => $referer,
				'path' => $path,
				'type' => 'check'));

			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);

			if (!(is_object(json_decode($buffer)))) {
				$cfc = strip_tags($buffer);
			} else {
				$cfc = NULL;
			}
			$object = json_decode($buffer);

			if ($object->status == 'success') {

?>
        <form action="index.php?step=1" method="POST" class="form-horizontal">
          
          <div class="alert alert-success"><i class='icon-ok'></i> <strong><?php

				echo ucfirst($object->status);

?></strong>:<br /><?php

				echo $object->message;

?></div>   
          <input id="code" type="hidden" name="code" value="<?php

				echo $code;

?>" />
          <input id="username" type="hidden" name="username" value="<?php

				echo $username;

?>" />
          <div class="bottom">
            <input type="submit" class="btn btn-primary" value="Next Step"/>
          </div>
        </form>
        <?php

			} else {

?>
        <div class="alert alert-error"><i class='icon-remove'></i> <strong><?php

				echo ucfirst($object->status);

?> <?php

				echo $cfc ? 'Unable to Connect Remote Server - Try Again after sometime!' : '';

?> :</strong><br /> <?php

				echo $object->message;

?><?php

				echo substr($cfc, -200, 150);

?></div>
        <form action="index.php?step=0" method="POST" class="form-horizontal">
          <div class="control-group">
            <label class="control-label" for="username">Envato Username</label>
            <div class="controls">
              <input id="username" type="text" name="username" class="input-large" required data-error="Username is required" placeholder="Envato Username" />
            </div>
          </div>
      <div class="control-group">
        <label class="control-label" for="code">Purchase Code <a href="#myModal" role="button" data-toggle="modal"><i class="icon-question-sign"></i></a></label>
        <div class="controls">
          <input id="code" type="text" name="code" class="input-large" required data-error="Purchase Code is required" placeholder="Purchase Code" />
        </div>
      </div>
      <div class="bottom">
        <input type="submit" class="btn btn-primary" value="Check"/>
      </div>
  </form>
  <?php

			}
		} else {

?>
<p>Please enter the required information to register free support account and varify your purchase. </p><br>
<form action="index.php?step=0" method="POST" class="form-horizontal">
  <div class="control-group">
    <label class="control-label" for="username">Envato Username</label>
    <div class="controls">
      <input id="username" type="text" name="username" class="input-large" required data-error="Username is required" placeholder="Envato Username" />
    </div>
  </div>
      <div class="control-group">
        <label class="control-label" for="code">Purchase Code <a href="#myModal" role="button" data-toggle="modal"><i class="icon-question-sign"></i></a></label>
        <div class="controls">
          <input id="code" type="text" name="code" class="input-large" required data-error="Purchase Code is required" placeholder="Purchase Code" />
        </div>
      </div>
      
      <div class="bottom">
        <input type="submit" class="btn btn-primary" value="Validate"/>
      </div>
  </form>
  <?php

		}

	} elseif ($step == '1') {

?>
      <ul class="steps">
    <li class="ok"><i class="icon icon-ok"></i>Checklist</li>
    <li class="ok"><i class="icon icon-ok"></i>Verify</li>
    <li class="active">Database</li>
    <li>Site Config</li>
    <li class="last">Done!</li>
  </ul>
  <?php

		if ($_POST) {

?>
  <h3>Database Config</h3>
  <p>If the database does not exist the system will try to create it.</p>
  <form action="index.php?step=2" method="POST" class="form-horizontal">
  
       <div class="control-group">
      <label class="control-label" for="domain">Website URL</label>
      <div class="controls">
        <input id="domain"  class="input-large" required data-error="Website URL required" placeholder="Website URL with traling slash" type="text" name="domain" value="<?php

        echo protocol() . $_SERVER["SERVER_NAME"] . substr($_SERVER["REQUEST_URI"], 0, -
                24);

?>" />
      </div>
    </div> 
    
    <div class="control-group">
      <label class="control-label" for="dbhost">Database Host</label>
      <div class="controls">
        <input id="dbhost" type="text" name="dbhost" class="input-large" required data-error="DB Host is required" placeholder="DB Host" value="localhost" />
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="dbusername">Database Username</label>
      <div class="controls">
        <input id="dbusername" type="text" name="dbusername" class="input-large" required data-error="DB Username is required" placeholder="DB Username" />
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="dbpassword">Database Password</a></label>
      <div class="controls">
        <input id="dbpassword" type="password" name="dbpassword" class="input-large" data-error="DB Password is required" placeholder="DB Password" />
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="dbname">Database Name</label>
      <div class="controls">
        <input id="dbname" type="text" name="dbname" class="input-large" required data-error="DB Name is required" placeholder="DB Name" />
      </div>
    </div>
    
    <input id="code" type="hidden" name="code" value="<?php

			echo $_POST['code'];

?>" />
    <input type="hidden" name="username" value="<?php

			echo $_POST['username'];

?>" />
    <div class="bottom">
      <input type="submit" class="btn btn-primary" value="Next Step"/>
    </div>
  </form>
  
  <?php

		}
	} elseif ($step == '2') {

?>
         
      <ul class="steps">
    <li class="ok"><i class="icon icon-ok"></i>Checklist</li>
    <li class="ok"><i class="icon icon-ok"></i>Verify</li>
    <li class="active">Database</li>
    <li>Site Config</li>
    <li class="last">Done!</li>
  </ul>
  <h3>Saving database config</h3>
  <?php

		if ($_POST) {
			$dbhost = $_POST["dbhost"];
			$dbusername = $_POST["dbusername"];
			$dbpassword = $_POST["dbpassword"];
			$dbname = $_POST["dbname"];
            $domain= $_POST["domain"];
			$code = $_POST["code"];
			$username = $_POST["username"];
			$link = new mysqli($dbhost, $dbusername, $dbpassword);
			if (mysqli_connect_errno()) {
				echo "<div class='alert alert-error'><i class='icon-remove'></i> Could not connect to MYSQL!</div>";
			} else {
				echo '<div class="alert alert-success"><i class="icon-ok"></i> Connection to MYSQL successful!</div>';
				$db_selected = mysqli_select_db($link, $dbname);
				if (!$db_selected) {
					if (!mysqli_query($link, "CREATE DATABASE IF NOT EXISTS `$dbname`")) {
						echo "<div class='alert alert-error'><i class='icon-remove'></i> Database " . $dbname .
							" does not exist and could not be created. Please create the Database manually and retry this step.</div>";
						return FALSE;
					} else {
						echo "<div class='alert alert-success'><i class='icon-ok'></i> Database " . $dbname .
							" created</div>";
					}
				}



				$_SESSION['user'] = $dbusername;
				$_SESSION['pass'] = $dbpassword;
				$_SESSION['host'] = $dbhost;
                $_SESSION['db'] = $dbname;
				$_SESSION['domain'] = $domain;






			}
		} else {
			echo "<div class='alert alert-success'><i class='icon-question-sign'></i> Nothing to do...</div>";
		}

?>
  <div class="bottom">
    <form action="index.php?step=1" method="POST" class="form-horizontal">
  
      <input id="code" type="hidden" name="code" value="<?php

		echo $_POST['code'];

?>" />
      <input id="username" type="hidden" name="username" value="<?php

		echo $_POST['username'];

?>" />
      <input type="submit" class="btn pull-left" value="Previous Step"/>
    </form>
    <form action="index.php?step=3" method="POST" class="form-horizontal">

      <input id="code" type="hidden" name="code" value="<?php

		echo $_POST['code'];

?>" />
      <input id="username" type="hidden" name="username" value="<?php

		echo $_POST['username'];

?>" />

     
      <input type="submit" class="btn btn-primary pull-right" value="Next Step">
    </form>
    <br clear="all">
  </div>
  
 <?php

	} else
		if ($step == 3) {

?>
         <ul class="steps">
    <li class="ok"><i class="icon icon-ok"></i>Checklist</li>
    <li class="ok"><i class="icon icon-ok"></i>Verify</li>
    <li class="ok"><i class="icon icon-ok"></i>Database</li>
    <li class="ok"><i class="icon icon-ok"></i>Site Config</li>
    <li  class="active"><i class="icon icon-ok"></i>Done!</li>
  </ul>

  <?php

			if ($_POST) {
                $code = $_POST['code'];
			
				$username = $_POST['username'];
            

				$curl_handle = curl_init();
				curl_setopt($curl_handle, CURLOPT_URL, 'http://mp3ora.com/api_license/');
				curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl_handle, CURLOPT_POST, 1);
				curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
					'username' => $_POST["username"],
					'code' => $_POST["code"],
					'id' => '5580519',
					'version' => '1',
					'type' => 'newinstall'));
				$buffer = curl_exec($curl_handle);
				curl_close($curl_handle);
				$object = json_decode($buffer);

				if ($object->status == 'success') {
					$dbimport = array(
						'host' => $_SESSION['host'],
						'user' => $_SESSION['user'],
						'pass' => $_SESSION['pass'],
                        'db' => $_SESSION['db'],
        				'query' => $object->dbdata);


					if (import_db($dbimport) == false) {

						$finished = FALSE;
						echo "<div class='alert alert-warning'><i class='icon-warning'></i> The database tables could not be created, please try again.</div>";
					} else {
						$finished = TRUE;
						

						$config_file = file_get_contents($sampleConfig);
						$config_file = str_replace('<DB_HOST>', $_SESSION['host'], $config_file);
						$config_file = str_replace('<DB_NAME>', $_SESSION['db'], $config_file);
						$config_file = str_replace('<DB_USER>', $_SESSION['user'], $config_file);
                        $config_file = str_replace('<DB_PASSWORD>', $_SESSION['pass'], $config_file);
						$config_file = str_replace('<WEB_DOMAIN>', $_SESSION['domain'], $config_file);
						

						@chmod($configFile, 0777);
						$f = fopen($configFile, 'w+');
						if (!fwrite($f, $config_file) > 0) {
							$error_msg = 'Unable to Create Config File, Give Write Permission to ../includes/ directory';
						}
						fclose($f);
						@chmod($configFile, 0644);

						if ($error == true) {
							echo "<div class='alert alert-error'><i class='icon-remove'></i> " . $error_msg .
								"</div>";
						} else {
							if (!@unlink('../Mp3Ora')) {
								echo "<div class='alert alert-warning'><i class='icon-warning'></i> Please remove the 'Mp3Ora' file from the main folder in order to lock the installer.</div>";
							}
						}
					}

				} else {
					echo "<div class='alert alert-error'><i class='icon-remove'></i> Error while validating your purchase code!</div>";
				}

			}
			if ($finished) {
               session_destroy();

?>
    
    <h3><i class='icon-ok'></i> Installation completed!</h3>
    <div class="alert alert-info"><i class='icon-info-sign'></i> You can login now in admin panel using the following credential:<br /><br />
      Username: <span style="font-weight:bold; letter-spacing:1px;">admin</span><br />Password: <span style="font-weight:bold; letter-spacing:1px;">admin</span><br /><br /></div>
      <div class="alert alert-warning"><i class='icon-warning-sign'></i> Please don't forget to change username and password.</div>
      <div class="bottom">
        <a href="<?php

				echo protocol() . $_SERVER["SERVER_NAME"] . substr($_SERVER["REQUEST_URI"], 0, -
					24);

?>admin.php" class="btn btn-primary">Go to Login</a>
      </div>
      
      <?php

			}
		}

} else {
	echo "<div style='width: 100%; font-size: 10em; color: #F00; text-shadow: 0 0 2px #333, 0 0 2px #333, 0 0 2px #333; text-align: center;'><i class='icon-lock'></i></div><h3 class='alert-text text-center'>Installer is locked!<br><small style='color:#ccc;'> If you want to re-install, Empty Database, Create a empty 'Mp3Ora' File inside script directory OR Contact Developer/Support Team! <br> <strong>Note:</strong> We are not responsible for any data loss while Installing or Re-Installing</small></h3>";
}

?>
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
    <h3 id="myModalLabel">How to find your purchase code</h3>
  </div>
  <div class="modal-body">
    <img src="img/purchaseCode.png">
  </div>
</div>