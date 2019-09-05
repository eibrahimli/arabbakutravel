<?php //session_start();
/* Login Information Here */
// ini_set('display_errors','0');
date_default_timezone_set('Africa/Lagos');
/* END LOGIN INFO  */
/* Extract */

$data_file = unserialize(base64_decode(file_get_contents('includes/website_setting.conf')));
//var_dump($data_file);
extract($data_file);

/* END Extract */
include 'includes/database.php';
include 'includes/functions.php';
//var_dump($_SESSION);
$install   = true;
?><!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="content-language" content="en-us">
<title>
  Configuraton
</title>

<?php include 'header.php';?>
</center><br>
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
  <div class="song-list" style="margin-left: 20px; margin-right: 20px;">
    <div style="padding: 10px;" id="contact_form" class="row">
      <div class="col-12 col-sm-12 col-lg-12">
        <?php
        /* Settings Area */
        if (isset($_GET['method']) && $_GET['method'] == 'add' && isset($_SESSION['login']) && $_SESSION['login'] === true) {
          if (isset($_POST['add']) && $_POST['add'] != '') {
            try {
              NoCSRF::check( 'csrf_token_song', $_POST, true, 60 * 10, false );
              echo 'Songs List added';
              $term = $_POST['add'];
              $terms= explode("\r\n", $term);
              foreach ($terms as $term) {
                $title        = toAscii($term, '', ' ');
                $title        = trim($title);
                $last_user_id = $database->insert("search", array('tag'=> $title));
                echo $title . '<br>';
              }
            }
            catch ( Exception $e ) {
              // CSRF attack detected
              $result = $e->getMessage() . ' Form ignored.';
              die($result);
            }
          }
          ?>

          <form class="form-horizontal" method="post" action="<?php echo $config_url; ?>?method=add">
            <fieldset>
              <!-- Form Name -->
              <legend>
                Songs Keyword Add
              </legend>
              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="add">
                  Songs Keywords
                </label>
                <div class="col-md-4">
                  <?php $csrf_token_song = NoCSRF::generate( 'csrf_token_song' );?>
                  <input type="hidden" name="csrf_token_song" value="<?php echo $csrf_token_song;?>">
                  <textarea rows="25" class="form-control" id="add" name="add">
                  </textarea>
                  <span class="help-block">
                    Songs Keyword seprate by New line!
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="submit">
                  Save Settings
                </label>
                <div class="col-md-4">
                  <input type="submit" id="submit" name="submit" value="Save Settings" class="btn btn-primary">
                </div>
              </div>
            </fieldset>
          </form>

          <?php

          // echo ' < h1 > Add Keywords</h1 > ';
        }
        elseif (isset($_GET['method']) && $_GET['method'] == 'dmca' && isset($_SESSION['login']) && $_SESSION['login'] === true) {
          // echo ' < h1 > DMCA Block</h1 > ';
          if (isset($_POST['dmcablock']) && $_POST['dmcablock'] != '') {
            try {
              NoCSRF::check( 'csrf_token_dmca', $_POST, true, 60 * 10, false );
              echo 'DMCA Link Added';
              $term = $_POST['dmcablock'];
              $terms= explode("\r\n", $term);
              foreach ($terms as $term) {
                // $title = toAscii($term,'',' ');
                $title        = trim($term);
                $last_user_id = $database->insert("dmca", array('dmca'=> $title));
                echo $title . '<br>';
              }
            }
            catch ( Exception $e ) {
              // CSRF attack detected
              $result = $e->getMessage() . ' Form ignored.';
              die($result);
            }
          }

          ?><?php $token_dmca = NoCSRF::generate( 'csrf_token_dmca' );?>

          <form class="form-horizontal" method="post" action="<?php echo $config_url; ?>?method=dmca">
            <fieldset>
              <!-- Form Name -->
              <legend>
                DMCA Settings
              </legend>
              <div class="form-group">
                <label class="col-md-4 control-label" for="dmcablock">
                  DMCA Links
                </label>
                <div class="col-md-4">
                  <input type="hidden" name="csrf_token_dmca" value="<?php echo $token_dmca;?>">
                  <textarea rows="25" class="form-control" id="dmcablock" name="dmcablock"></textarea>
                  <span class="help-block">
                    DMCA link seprate by new line!
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="submit">
                  Save Settings
                </label>
                <div class="col-md-4">
                  <input type="submit" id="submit" name="submit" value="Save Settings" class="btn btn-primary">
                </div>
              </div>
              <!-- Text input-->
            </fieldset>
          </form>
          <?php
        }
        else {

          /* Setting IF END */
          $country_array = array('al'   => 'Albania',
            'dz'   => 'Algeria',
            'ao'   => 'Angola',
            'ai'   => 'Anguilla',
            'ag'   => 'Antigua and Barbuda',
            'ar'   => 'Argentina',
            'ar_en'=> 'ArgentinaEnglish)',
            'am'   => 'Armenia',
            'au'   => 'Australia',
            'at'   => 'Austria',
            'at_en'=> 'AustriaEnglish)',
            'az'   => 'Azerbaijan',
            'bs'   => 'Bahamas',
            'bh'   => 'Bahrain',
            'bb'   => 'Barbados',
            'by'   => 'Belarus',
            'be'   => 'Belgium',
            'be_en'=> 'BelgiumEnglish)',
            'be_fr'=> 'BelgiumFrench)',
            'bz'   => 'Belize',
            'bz_es'=> 'BelizeSpanish)',
            'bj'   => 'Benin',
            'bm'   => 'Bermuda',
            'bt'   => 'Bhutan',
            'bo'   => 'Bolivia',
            'bo_en'=> 'BoliviaEnglish)',
            'bw'   => 'Botswana',
            'br'   => 'Brazil',
            'br_en'=> 'BrazilEnglish)',
            'vg'   => 'British Virgin Islands',
            'bn'   => 'Brunei Darussalam',
            'bg'   => 'Bulgaria',
            'bf'   => 'Burkina Faso',
            'kh'   => 'Cambodia',
            'ca'   => 'Canada',
            'ca'   => 'CanadaFrench)',
            'cv'   => 'Cape Verde',
            'ky'   => 'Cayman Islands',
            'td'   => 'Chad',
            'cl'   => 'Chile',
            'cl_en'=> 'ChileEnglish)',
            'cn'   => 'China',
            'cn_en'=> 'ChinaEnglish)',
            'co'   => 'Colombia',
            'co_en'=> 'ColombiaEnglish)',
            'cg'   => 'Congo, Republic of the',
            'cr'   => 'Costa Rica',
            'cr_en'=> 'Costa RicaEnglish)',
            'hr'   => 'Croatia',
            'cy'   => 'Cyprus',
            'cz'   => 'Czech Republic',
            'dk'   => 'Denmark',
            'dk_en'=> 'DenmarkEnglish)',
            'dm'   => 'Dominica',
            'dm_en'=> 'DominicaEnglish)',
            'do'   => 'Dominican Republic',
            'dO_en'=> 'Dominican RepublicEnglish)',
            'ec'   => 'Ecuador',
            'ec_en'=> 'EcuadorEnglish)',
            'eg'   => 'Egypt',
            'sv'   => 'El Salvador',
            'sv_en'=> 'El SalvadorEnglish)',
            'ee'   => 'Estonia',
            'fj'   => 'Fiji',
            'fi'   => 'Finland',
            'fi_en'=> 'FinlandEnglish)',
            'fr'   => 'France',
            'fr_en'=> 'FranceEnglish)',
            'gm'   => 'Gambia',
            'de'   => 'Germany',
            'de_en'=> 'GermanyEnglish)',
            'gh'   => 'Ghana',
            'gr'   => 'Greece',
            'gd'   => 'Grenada',
            'gt'   => 'Guatemala',
            'gt_en'=> 'GuatemalaEnglish)',
            'gw'   => 'Guinea-Bissau',
            'gy'   => 'Guyana',
            'hn'   => 'Honduras',
            'hn_en'=> 'HondurasEnglish)',
            'hk'   => 'Hong Kong',
            'hk_en'=> 'Hong KongEnglish)',
            'hu'   => 'Hungary',
            'is'   => 'Iceland',
            'in'   => 'India',
            'id'   => 'Indonesia',
            'id_en'=> 'IndonesiaEnglish)',
            'ie'   => 'Ireland',
            'il'   => 'Israel',
            'it'   => 'Italy',
            'it_en'=> 'ItalyEnglish)',
            'jm'   => 'Jamaica',
            'jp'   => 'Japan',
            'jp_en'=> 'JapanEnglish)',
            'jo'   => 'Jordan',
            'kz'   => 'Kazakhstan',
            'ke'   => 'Kenya',
            'kr'   => 'Korea, Republic Of',
            'kr_en'=> 'Korea, Republic OfEnglish)',
            'ku'   => 'Kuwait',
            'kg'   => 'Kyrgyzstan',
            'la'   => 'Lao, People\'s Democratic Republic',
            'lv'   => 'Latvia',
            'lb'   => 'Lebanon',
            'lr'   => 'Liberia',
            'lt'   => 'Lithuania',
            'lu'   => 'Luxembourg',
            'lu_en'=> 'LuxembourgEnglish)',
            'lu_en'=> 'LuxembourgFrench)',
            'mo'   => 'Macau',
            'mo_en'=> 'MacauEnglish)',
            'mk'   => 'Macedonia',
            'mg'   => 'Madagascar',
            'mw'   => 'Malawi',
            'my'   => 'Malaysia',
            'my_en'=> 'MalaysiaEnglish)',
            'ml'   => 'Mali',
            'mt'   => 'Malta',
            'mr'   => 'Mauritania',
            'mu'   => 'Mauritius',
            'mx'   => 'Mexico',
            'mx_en'=> 'MexicoEnglish)',
            'fm'   => 'Micronesia, Federated States of',
            'md'   => 'Moldova',
            'mn'   => 'Mongolia',
            'ms'   => 'Montserrat',
            'mz'   => 'Mozambique',
            'na'   => 'Namibia',
            'np'   => 'Nepal',
            'nl'   => 'Netherlands',
            'nl_en'=> 'NetherlandsEnglish)',
            'nz'   => 'New Zealand',
            'ni'   => 'Nicaragua',
            'ni_en'=> 'NicaraguaEnglish)',
            'ne'   => 'Niger',
            'ng'   => 'Nigeria',
            'no'   => 'Norway',
            'no_en'=> 'NorwayEnglish)',
            'om'   => 'Oman',
            'pk'   => 'Pakistan',
            'pw'   => 'Palau',
            'pn'   => 'Panama',
            'pn_en'=> 'PanamaEnglish)',
            'pg'   => 'Papua New Guinea',
            'py'   => 'Paraguay',
            'py_en'=> 'ParaguayEnglish)',
            'pe'   => 'Peru',
            'ph'   => 'Philippines',
            'pl'   => 'Poland',
            'pt'   => 'Portugal',
            'pt_en'=> 'PortugalEnglish)',
            'qa'   => 'Qatar',
            'ro'   => 'Romania',
            'ru'   => 'Russia',
            'ru_en'=> 'RussiaEnglish)',
            'st'   => 'São Tomé and Príncipe',
            'sa'   => 'Saudi Arabia',
            'sn'   => 'Senegal',
            'sc'   => 'Seychelles',
            'sl'   => 'Sierra Leone',
            'sg'   => 'Singapore',
            'sg_en'=> 'SingaporeEnglish)',
            'sk'   => 'Slovakia',
            'si'   => 'Slovenia',
            'sb'   => 'Solomon Islands',
            'za'   => 'South Africa',
            'es'   => 'Spain',
            'es_en'=> 'SpainEnglish)',
            'lk'   => 'Sri Lanka',
            'kh'   => 'St. Kitts and Nevis',
            'lc'   => 'St. Lucia',
            'vc'   => 'St. Vincent and The Grenadines',
            'sr'   => 'Suriname',
            'sr_en'=> 'SurinameEnglish)',
            'sz'   => 'Swaziland',
            'se'   => 'Sweden',
            'se_en'=> 'SwedenEnglish)',
            'ch'   => 'Switzerland',
            'ch_en'=> 'SwitzerlandEnglish)',
            'ch_fr'=> 'SwitzerlandFrench)',
            'ch_it'=> 'SwitzerlandItalian)',
            'tw'   => 'Taiwan',
            'tw_en'=> 'TaiwanEnglish)',
            'tj'   => 'Tajikistan',
            'tz'   => 'Tanzania',
            'th'   => 'Thailand',
            'th_en'=> 'ThailandEnglish)',
            'tt'   => 'Trinidad and Tobago',
            'tn'   => 'Tunisia',
            'tr'   => 'Turkey',
            'tr_en'=> 'TurkeyEnglish)',
            'tm'   => 'Turkmenistan',
            'tc'   => 'Turks and Caicos',
            'ug'   => 'Uganda',
            'ua'   => 'Ukraine',
            'ae'   => 'United Arab Emirates',
            'gb'   => 'United Kingdom',
            'us'   => 'United States',
            'us_es'=> 'United StatesSpanish)',
            'uy'   => 'Uruguay',
            'uy_en'=> 'UruguayEnglish)',
            'uz'   => 'Uzbekistan',
            've'   => 'Venezuela',
            've_en'=> 'VenezuelaEnglish)',
            'vn'   => 'Vietnam',
            'vn_en'=> 'VietnamEnglish)',
            'ye'   => 'Yemen',
            'zw'   => 'Zimbabwe');

          $array_count18 = array(3,6,9,12,15,18,21,24,27,30);
          $array_count50 = array(10,20,30,40,50);
          function select($find, $array)
          {
            $return = '';
            foreach ($array as $value) {
              if ($find == $value) {
                $selected = 'selected=""';
              }
              $return .= '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
              $selected = '';
            }
            return $return;
          }
          if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
            // echo $password;
            if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
              $_SESSION['login'] = false;
              echo 'Logout';
              //  session_destroy();
              echo '<h1>Logout - Redirect to Home Page</h1>';
              echo '<meta http-equiv="refresh" content="2;url=index.php" />  </div>
              </div>
              </div>
              </div>
              </div>';
              include 'footer.php';
              die();

            }
          }
          else {
            $username = $password = $userError= $passError= '';
            if (isset($_POST['sub'])) {

              try {
                // var_dump($_POST);
                // Run CSRF check, on POST data, in exception mode, for 10 minutes, in one - time mode.
                NoCSRF::check( 'token_admin', $_POST, true, 60 * 10, false );

                $username = $_POST['username'];
                $password = $_POST['password'];
                //  echo $username;
                //  echo $password;
                if ($username === $admin_user && $password === $admin_pass) {

                  $_SESSION['login'] = true;
                  //var_dump($_SESSION['login']);
                  echo '<h1>Login Succesfully, Redirecting to Configuration Page</h1>';
                  echo '<meta http-equiv="refresh" content="2;url=' . $config_url . '" />
                  </div>
                  </div>
                  </div>
                  </div>
                  ';
                  include 'footer.php';
                  die();
                }
                if ($username !== 'admin') {
                  $userError = 'Invalid Username';
                }
                // form parsing, DB inserts, etc.
                // ...
                $result = 'CSRF check passed. Form parsed.';
              }
              catch ( Exception $e ) {
                // CSRF attack detected
                $result = $e->getMessage() . ' Form ignored.';
                die($result);
              }



            }
            echo "<!DOCTYPE html>
            <form name='input' class='form-horizontal'  action='{$config_url}' method='post'>
            ";
            echo '<fieldset>
            <!-- Form Name -->
            <legend>Main Settings</legend>
            <!-- Text input-->
            ';
            if (isset($userError) && $userError != '') {
              echo $userError;
            }

            $admin_token = NoCSRF::generate( 'token_admin' );
            echo '
            <div class="form-group">
            <label class="col-md-4 control-label" for="username">Login Username:</label>
            <div class="col-md-4">
            <input id="username" name="username"  placeholder="Username" class="form-control input-md" required="" type="text">
            <input type="hidden" name="token_admin" value="'.$admin_token.'">
            </div>
            </div>
            <div class="form-group">
            <label class="col-md-4 control-label" for="password">Login Password:</label>
            <div class="col-md-4">
            <input id="password" name="password"   placeholder="Password" class="form-control input-md" required="" type="password">

            </div>
            </div>
            <div class="form-group">
            <label class="col-md-4 control-label" for="submit">Save Settings</label>
            <div class="col-md-4">
            <input type="submit" id="submit" name="sub" value="Login" class="btn btn-primary">
            </div>
            </div>
            </div>
            </fieldset>
            </form>
            </div>
            </div>
            </div>
            </div>
            </div>
            ';
            include 'footer.php';
            die();
          }
          ?>
          <?php
          if ($_POST) {

            $htaccess_file = '.htaccess';

            if ($_POST['m_l'] == "single") {

              $htaccess_sample = <<<EOF
# Enable Rewriting
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^<DOWNLOAD_URL>/(.*)/(.*)\.html?$ search.php?id=$1&key=$2
RewriteRule ^<ALBUM_URL>/(.*)/(.*)\.html?$ album_list.php?id=$1
RewriteRule ^<ARTIST_URL>/(.*)/(.*)\.html?$ artist_detail.php?id=$1
RewriteRule ^top-downloads/?$ download_top.php [L,QSA]
RewriteRule ^fresh/?$ fresh_top.php [L,QSA]
RewriteRule ^top-india/?$ top_world.php?top=india [L,QSA]
RewriteRule ^top-world/?$ top_world.php?top=usa [L,QSA]
RewriteRule ^top-uk/?$ top_world.php?top=uk [L,QSA]
RewriteRule ^top-france/?$ top_world.php?top=france [L,QSA]
RewriteRule ^top-brazil/?$ top_world.php?top=brazil [L,QSA]
RewriteRule ^top-arabic/?$ top_world.php?top=arabic [L,QSA]
RewriteRule ^sitemaps.xml sitemapxml.php [L,QSA]
RewriteRule ^sitemap_(.*).xml?$ sitemapxml.php?page=$1[L,QSA]
RewriteRule ^([a-zA-Z0-9-/]+?)/?$ index.php?lang=$1 [L,QSA]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^<SONGS_URL>/(.*)\.html?$ result.php?title=$1 [NC]
EOF;

            }
            else {
              $htaccess_sample = <<<EOF
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)/<DOWNLOAD_URL>/(.*)/(.*)\.html?$search.php?id=$2&key=$3&lang=$1
RewriteRule ^(.*)/<ALBUM_URL>/(.*)/(.*)\.html?$ album_list.php?id=$2&lang=$1
RewriteRule ^(.*)/<ARTIST_URL>/(.*)/(.*)\.html?$ artist_detail.php?id=$2&lang=$1
RewriteRule ^top-downloads/?$ download_top.php [L,QSA]
RewriteRule ^fresh/?$ fresh_top.php [L,QSA]
RewriteRule ^top-india/?$ top_world.php?top=india [L,QSA]
RewriteRule ^top-world/?$ top_world.php?top=usa [L,QSA]
RewriteRule ^top-uk/?$ top_world.php?top=uk [L,QSA]
RewriteRule ^top-france/?$ top_world.php?top=france [L,QSA]
RewriteRule ^top-brazil/?$ top_world.php?top=brazil [L,QSA]
RewriteRule ^top-arabic/?$ top_world.php?top=arabic [L,QSA]
RewriteRule ^sitemaps.xml sitemapxml.php [L,QSA]
RewriteRule ^sitemap_(.*).xml?$ sitemapxml.php?page=$1[L,QSA]
RewriteRule ^([a-zA-Z0-9-/]+?)/?$ index.php?lang=$1 [L,QSA]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)/<SONGS_URL>/(.*)\.html?$ result.php?title=$2&lang=$1 [NC]

EOF;
            }

            function trim_value( & $value)
            {
              $value = trim($value);    // this removes whitespace and related characters from the beginning and end of the string
            }
            array_filter($_POST, 'trim_value');
            array_filter($_POST, 'xss_clean');

            if (isset($_POST['m_l'])) {
              $_SESSION['lang'] = '';
              $_POST['m_l'] = 'single';
              //   echo 'session_removed';

            }
            else {
              $_POST['m_l'] = 'multi';
            }

            $save         = base64_encode(serialize($_POST));
            file_put_contents('includes/website_setting.conf', $save);
            //var_dump($_POST);
            $data         = unserialize(base64_decode(file_get_contents('includes/website_setting.conf')));
            // var_dump($data);
            extract($data);

            $song_url     = $_POST['song_rewrite'];
            $album_url    = $_POST['album_rewrite'];
            $artist_url   = $_POST['artist_rewrite'];
            $download_url = $_POST['download_rewrite'];

            if (isset($_POST['rewrite']) && $_POST['rewrite'] == "true" or isset($_POST['m_l'])) {
              if (isset($song_url) && $song_url != '') {
                $song_rewrite = $song_url;
              }
              if (isset($album_url) && $album_url != '') {
                $album_rewrite = $album_url;
              }
              if (isset($artist_url) && $artist_url != '') {
                $artist_rewrite = $artist_url;
              }
              if (isset($download_url) && $download_url != '') {
                $download_rewrite = $download_url;
              }

              // $config_file = file_get_contents($htaccess_file);
              $htaccess_sample = str_replace('<SONGS_URL>', $song_url, $htaccess_sample);
              $htaccess_sample = str_replace('<ALBUM_URL>', $album_url, $htaccess_sample);
              $htaccess_sample = str_replace('<ARTIST_URL>', $artist_url, $htaccess_sample);
              $htaccess_sample = str_replace('<DOWNLOAD_URL>', $download_url, $htaccess_sample);

              @chmod($htaccess_file, 0777);
              $f               = fopen($htaccess_file, 'w+');
              if (!fwrite($f, $htaccess_sample) > 0) {
                echo '<h1>Unable to Create or Update Htaccess File, Give Write Permission to .htaccess file</h1>';
              }
              fclose($f);
              @chmod($htaccess_file, 0644);
            }
          }

          function _c($value, $other = '')
          {
            if (isset($value) and $value != '') {
              return $value;
            }
            else {
              return $other;
            }
          }
          ?>
          <form class="form-horizontal" method="post" action="<?php echo $config_url; ?>">
            <fieldset>
              <!-- Form Name -->
              <legend>
                Main Settings
              </legend>
              <!-- Text input-->
              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="sitename">
                  Website Name
                </label>
                <div class="col-md-4">
                  <input id="sitename" name="sitename" value="<?php echo _c($sitename); ?>" placeholder="WebMusic" class="form-control input-md" required="" type="text">
                  <span class="help-block">
                    Add Your Sitename Which use almost in Whole Website!
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="keyword_home">
                  Keyword Home
                </label>
                <div class="col-md-4">
                  <input id="keyword_home" name="keyword_home" value="<?php echo _c($keyword_home); ?>" placeholder="keyword1,keyword2,keyword3" class="form-control input-md" required="" type="text">
                  <span class="help-block">
                    Seprate keywords with commas
                  </span>
                </div>
              </div>
              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="description">
                  Website Description Home
                </label>
                <div class="col-md-5">
                  <input id="description" name="description" value="<?php echo _c($description); ?>" placeholder="Website Description for Home Page" class="form-control input-md" required="" type="text">

                </div>
              </div>
              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="title_name">
                  Website Title
                </label>
                <div class="col-md-5">
                  <input id="title_name" name="title_name" value="<?php echo _c($title_name); ?>" placeholder="Your Website Title" class="form-control input-md" required="" type="text">

                </div>
              </div>
              <!-- Select Basic -->

              <div class="form-group">
                <label class="col-md-4 control-label" for="ssl_setting">
                  Images Cache (SSL)
                </label>
                <div class="col-md-4">
                  <?php
                  if (isset($ssl_setting) && $ssl_setting == 'ssl') {
                    $selected_ssl = 'checked';
                  }
                  else {
                    $selected_ssl = '';
                  }?>
                  <input type="checkbox" name="ssl_setting" value="ssl" <?php echo $selected_ssl;?>>
                  <span class="help-block">
                    If you want to enable SSL you must enable IMAGE CACHE, so all itunes images will be store at your server!
                  </span>
                </div>
              </div>

              <br>
              <legend>
                Language Setting
              </legend>

              <div class="form-group">
                <label class="col-md-4 control-label" for="m_l">
                  Single Language?
                </label>
                <div class="col-md-4">
                  <?php
                  if ($m_l == 'single') {
                    $selected = 'checked';
                  }
                  else {
                    $selected = '';
                  }?>
                  <input type="checkbox" name="m_l" value="single" <?php echo $selected;?>>
                  <span class="help-block">
                    Check this if you don't want to use multi language, default language will be used! (all your htaccess setting will be replaced!)
                  </span>
                </div>
              </div>


              <div class="form-group">
                <label class="col-md-4 control-label" for="lang_default">
                  Default Language
                </label>
                <div class="col-md-4">

                  <select id="lang_default" name="lang_default" class="form-control">
                    <?php
                    foreach ($available_langs as $lang_code) {
                      if (_c($lang_default) == $lang_code) {
                        $selected = 'selected=""';
                      }
                      echo '<option value="' . $lang_code . '" ' . $selected . '>' . $lang_code . '</option>';
                      $selected = '';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <br>
              <legend>
                Rewrite Rules
              </legend>
              <div class="form-group">
                <label class="col-md-4 control-label" for="rewrite">
                  Rewrite URL?
                </label>
                <div class="col-md-4">
                  <input type="checkbox" name="rewrite" value="true">
                  <span class="help-block">
                    Check the checkbox to rewrite URL and this will update the htaccess file! (All existed htaccess changes will be removed!)
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="song_rewrite">
                  Songs URL
                </label>
                <div class="col-md-4">
                  <input id="song_rewrite" name="song_rewrite" value="<?php echo _c($song_rewrite); ?>"  placeholder="mp3" class="form-control input-md" required="" type="text">
                  <span class="help-block">
                    http://website.com/br/
                    <b>
                      song
                    </b>/Mp3-Songs-Search.html
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="album_rewrite">
                  Album URL
                </label>
                <div class="col-md-4">
                  <input id="album_rewrite" name="album_rewrite" value="<?php echo _c($album_rewrite); ?>"  placeholder="album" class="form-control input-md" required="" type="text">
                  <span class="help-block">
                    http://localhost/webm/br/
                    <b>
                      album
                    </b>/3205913413/Album-Name-2012.html
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="artist_rewrite">
                  Artist URL
                </label>
                <div class="col-md-4">
                  <input id="artist_rewrite" name="artist_rewrite" value="<?php echo _c($artist_rewrite); ?>"  placeholder="artist" class="form-control input-md" required="" type="text">
                  <span class="help-block">
                    http://localhost/webm/br/
                    <b>
                      artist
                    </b>/s84568188/Artist-Name.html
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="download_rewrite">
                  Download URL
                </label>
                <div class="col-md-4">
                  <input id="download_rewrite" name="download_rewrite" value="<?php echo _c($download_rewrite); ?>"  placeholder="download" class="form-control input-md" required="" type="text">
                  <span class="help-block">
                    http://localhost/webm/br/
                    <b>
                      download
                    </b>/XXXxxsssSS/Songs-Name.html
                  </span>
                </div>
              </div>
              <legend>
                Home Page Songs Listing
              </legend>

              <div class="form-group">
                <label class="col-md-4 control-label" for="hide1">
                  Hide 1st Country Tab?
                </label>
                <div class="col-md-4">
                  <input type="checkbox" name="hide1" value="hide">
                  <span class="help-block">
                    This will hide 1st country tab from Home Page
                  </span>
                </div>
              </div>


              <div class="form-group">
                <label class="col-md-4 control-label" for="country1">
                  1st Country
                </label>
                <div class="col-md-4">
                  <input id="country1name" name="country1name" value="<?php echo _c($country1name); ?>"  type="text" style="display: none;">
                  <select id="country1" name="country1" class="form-control">
                    <?php
                    foreach ($country_array as $cu => $name) {
                      if (_c($country1) == $cu) {
                        $selected = 'selected=""';
                      }
                      echo '<option value="' . $cu . '" ' . $selected . '>' . $name . '</option>';
                      $selected = '';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <!-- Select Basic -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="list1st">
                  Number of 1st Country List
                </label>
                <div class="col-md-4">
                  <select id="list1st" name="list1st" class="form-control">
                    <?php echo select($list1st, $array_count18); ?>

                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label" for="hide2">
                  Hide 2nd Country Tab?
                </label>
                <div class="col-md-4">
                  <input type="checkbox" name="hide2" value="hide">
                  <span class="help-block">
                    This will hide 2nd country tab from Home Page
                  </span>
                </div>
              </div>


              <!-- Select Basic -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="country2">
                  2nd Country
                </label>
                <div class="col-md-4">
                  <input id="country2name" name="country2name" value="<?php echo _c($country2name); ?>"  type="text"  style="display: none;">
                  <select id="country2" name="country2" class="form-control">
                    <?php
                    foreach ($country_array as $cu2 => $name2) {
                      if (_c($country2) == $cu2) {
                        $selected2 = 'selected=""';
                      }
                      echo '<option value="' . $cu2 . '" ' . $selected2 . '>' . $name2 . '</option>';
                      $selected2 = '';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <!-- Select Basic -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="list2nd">
                  Number of 2nd  Country List
                </label>
                <div class="col-md-4">
                  <select id="list2nd" name="list2nd" class="form-control">
                    <?php echo select($list2nd, $array_count18); ?>

                  </select>
                </div>
              </div>
              <!-- Select Basic -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="countrytop">
                  Top Songs Country
                </label>
                <div class="col-md-4">
                  <input id="countrytopname" name="countrytopname" value="<?php echo _c($countrytopname); ?>"  type="text" style="display: none;">
                  <select id="countrytop" name="countrytop" class="form-control">
                    <?php
                    foreach ($country_array as $cu3 => $name3) {
                      if (_c($countrytop) == $cu3) {
                        $selected3 = 'selected=""';
                      }
                      echo '<option value="' . $cu3 . '" ' . $selected3 . '>' . $name3 . '</option>';
                      $selected3 = '';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="ytapi">
                  API Keys
                </label>
                <div class="col-md-4">
                  <textarea class="form-control" id="ytapi" name="ytapi" rows="10" placeholder="AIzaSyD0IxF23_IEJyvawA9Ur02TvcbKN6OLPYT
AIzaSyD0IxF23_IEJyvawA9Ur02TvcbKN6OLPPO
AIzaSyD0IxF23_IEJyvawA9Ur02TvcbKN6OLPLC
AIzaSyD0IxF23_IEJyvawA9Ur02TvcbKN6OLPGK"><?php echo _c($ytapi); ?></textarea>
                  <span class="help-block">
                    Seperate Youtube API by new line (how to create Youtube API: <a href="https://www.dropbox.com/s/6ypl2kye8up9bdf/Youtube-Api-key_creating.pdf?dl=0" target="_blank"> Learn More</a>)
                  </span>
                </div>
              </div>
              <!-- Select Basic -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="topcsong">
                  Number of TOP County Songs
                </label>
                <div class="col-md-4">
                  <select id="topcsong" name="topcsong" class="form-control">
                    <?php echo select($topcsong, $array_count50); ?>

                  </select>
                </div>
              </div>
              <legend>
                DMCA Email
              </legend>
              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="dmca">
                  DMCA Email Address
                </label>
                <div class="col-md-4">
                  <input id="dmca" name="dmca" value="<?php echo _c($dmca); ?>"  placeholder="Type Email address where you recevied DMCA" class="form-control input-md" required="" type="text">
                  <span class="help-block">
                    email required for DMCA takedown!
                  </span>
                </div>
              </div>
              <!-- Text input-->
              <legend>
                Contact Email
              </legend>
              <div class="form-group">
                <label class="col-md-4 control-label" for="email">
                  Contact Us Email
                </label>
                <div class="col-md-4">
                  <input id="email" name="email" value="<?php echo _c($email); ?>"  placeholder="Type your Contact Email address" class="form-control input-md" required="" type="text">
                  <span class="help-block">
                    You will recevied Email from Contact Us
                  </span>
                </div>
              </div>
              <!-- Text input-->
              <legend>
                Google Captcha for DMCA &amp; Contact us from
              </legend>
              <div class="form-group">
                <label class="col-md-4 control-label" for="gsecret">
                  Google Secret ID
                </label>
                <div class="col-md-4">
                  <input id="gsecret" name="gsecret" value="<?php echo _c($gsecret); ?>"  placeholder="Google Captcha Secret ID" class="form-control input-md" required="" type="text">

                </div>
              </div>
              <!-- Password input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="gkey">
                  Google Captcha Site Key
                </label>
                <div class="col-md-4">
                  <input id="gkey" name="gkey" value="<?php echo _c($gkey); ?>"  placeholder="Add your Google Captcha Site Key here" class="form-control input-md" required="" type="text">

                </div>
              </div>
              <legend>
                Songs List Display # Limit
              </legend>
              <!-- Select Basic -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="topchart">
                  Number of TOP Charts Songs
                </label>
                <div class="col-md-4">
                  <select id="topchart" name="topchart" class="form-control">
                    <?php echo select($topchart, $array_count50); ?>
                  </select>
                </div>
              </div>
              <!-- Select Basic -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="topsearch">
                  Number of Search Results
                </label>
                <div class="col-md-4">
                  <select id="topsearch" name="topsearch" class="form-control">
                    <?php echo select($topsearch, $array_count50); ?>
                  </select>
                </div>
              </div>
              <!-- Select Basic -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="nowdownload">
                  Number of Now Downloading
                </label>
                <div class="col-md-4">
                  <select id="nowdownload" name="nowdownload" class="form-control">
                    <?php echo select($nowdownload, $array_count50); ?>
                  </select>
                </div>
              </div>
              <!-- Select Basic -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="freshsong">
                  Number of Fresh Music
                </label>
                <div class="col-md-4">
                  <select id="freshsong" name="freshsong" class="form-control">
                    <?php echo select($freshsong, $array_count50); ?>
                  </select>
                </div>
              </div>
              <!-- Select Basic -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="topsong">
                  Number of Top Songs HomePage
                </label>
                <div class="col-md-4">
                  <select id="topsong" name="topsong" class="form-control">
                    <?php echo select($topsong, $array_count50); ?>
                  </select>
                </div>
              </div>
              <!-- Button -->
              <legend>
                Download Setting
              </legend>
              <div class="form-group">
                <label class="col-md-4 control-label" for="downloadmanage">
                  Download Management
                </label>
                <div class="col-md-4">
                  <select id="downloadmanage" name="downloadmanage" class="form-control">
                    <option value="4" <?php
 if ($downloadmanage == 4) {echo 'selected=""';}?>>
                      Your API - Custom
                    </option>
                    <option value="3" <?php
 if ($downloadmanage == 3) {echo 'selected=""';}?>>
                      YTforMp3 API - Mp3
                    </option>
                    <option value="2" <?php
 if ($downloadmanage == 2) {echo 'selected=""';}?>>
                      API Download Mp3/Mp4
                    </option>
                    <option value="1" <?php
 if ($downloadmanage == 1) {echo 'selected=""';}?>>
                      API Download Mp3 Only
                    </option>
                    <option value="0" <?php
 if ($downloadmanage == 0) {echo 'selected=""';}?>>
                      Direct Download Mp3 Only
                    </option>
                  </select>
                  <span class="help-block">
                    Both Option use ThirdParty Mp3/Mp4 Downloading, BUT "Direct Download" use LEECH download using your server and eat bandwidth (which display as that your provide the download link),
                    "API Download" will use ThirdParty Download Embed Code in Your Website!
                  </span>
                </div>
              </div>

              <div class="form-group" id='custom_api_show'>
                <label class="col-md-4 control-label" for="custom_api">
                  Custom API Key Here
                </label>
                <div class="col-md-4">
                  <textarea class="form-control" id="custom_api" name="custom_api"><?php echo _c($custom_api); ?></textarea>
                  <span class="help-block">
                    Paste your API url here, Replace  Youtube ID with
                    <code>
                      &#x3C;YOUTUBE_ID&#x3E;
                    </code>, You can add multi custom API in this textarea, Example:
                    <br>
                    <code>
                      &#x3C;iframe id=&#x22;myframe&#x22; src=&#x22;http://yt2m.pro/mp3-api/&#x3C;YOUTUBE_ID&#x3E;&#x22; width=&#x22;100%&#x22; height=&#x22;100px&#x22; <br> allowtransparency=&#x22;true&#x22; scrolling=&#x22;no&#x22; style=&#x22;border:none;&#x22;&#x3E;&#x3C;/iframe&#x3E;
                    </code>
                    <br><br>
                    OR
                    <br>  <br>
                    <code>
                      &#x3C;div id=&#x22;yt2m&#x22; vid-id=&#x27;&#x3C;YOUTUBE_ID&#x3E;&#x27;&#x3E;&#x3C;/div&#x3E;
                      &#x3C;script async src=&#x22;http://yt2m.pro/api.js&#x22;&#x3E;&#x3C;/script&#x3E;
                    </code>

                  </span>
                </div>
              </div>

              <legend>
                Analytics/Stats Counter Code
              </legend>
              <div class="form-group">
                <label class="col-md-4 control-label" for="counter_footer">
                  Analytics/Stats Counter Code
                </label>
                <div class="col-md-4">
                  <textarea class="form-control" id="counter_footer" name="counter_footer"><?php echo _c($counter_footer); ?></textarea>
                </div>
              </div>
              <legend>
                Ads Area
              </legend>
              <div class="form-group">
                <label class="col-md-4 control-label" for="pophead">
                  Header POP Codes (
                  <a href="http://www.propellerads.com/?rfd=Tbc" target="_blank">
                    PropellerAds
                  </a>or Any Other)
                </label>
                <div class="col-md-4">
                  <textarea class="form-control" id="pophead" name="pophead"><?php echo _c($pophead); ?></textarea>
                </div>
              </div>
              <!-- Select Basic -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="adsearch">
                  Advertisment Bellow Search Form
                </label>
                <div class="col-md-4">
                  <textarea class="form-control" id="adsearch" name="adsearch"><?php echo _c($adsearch); ?></textarea>
                </div>
              </div>
              <!-- Select Basic -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="adfooter">
                  Advertisment Above Footer
                </label>
                <div class="col-md-4">
                  <textarea class="form-control" id="adfooter" name="adfooter"><?php echo _c($adfooter); ?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="adlink">
                  Ad Link (Fast Download Button in Mp3 Download Area)
                </label>
                <div class="col-md-4">
                  <input id="adlink" name="adlink" value="<?php echo _c($adlink); ?>" placeholder="http://go.ad2upapp.com/afu.php?id=814329" class="form-control input-md" type="text">

                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="submit">
                  Save Settings
                </label>
                <div class="col-md-4">
                  <input type="submit" id="submit" name="submit" value="Save Settings" class="btn btn-primary">
                </div>
              </div>
            </fieldset>
          </form>
          <?php
        }
        /* Settings IF END */
        ?>
      </div>
    </div>
  </div>
</div>
</div>
<?php include 'footer.php';?>
