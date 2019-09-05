<!--link href="//cdnjs.cloudflare.com/ajax/libs/pace/0.6.0/themes/red/pace-theme-flash.css" rel="stylesheet"//-->
<link href="<?php echo $siteurl; ?>result_files/a.css" rel="stylesheet">
<?php $li_page = false;?>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $siteurl; ?>images/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $siteurl; ?>images/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $siteurl; ?>images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $siteurl; ?>images/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo $siteurl; ?>images/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $siteurl; ?>images/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $siteurl; ?>images/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $siteurl; ?>images/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $siteurl; ?>images/apple-touch-icon-180x180.png">
<link rel="icon" type="image/png" href="<?php echo $siteurl; ?>images/favicon-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="<?php echo $siteurl; ?>images/favicon-160x160.png" sizes="160x160">
<link rel="icon" type="image/png" href="<?php echo $siteurl; ?>images/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="<?php echo $siteurl; ?>images/favicon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="<?php echo $siteurl; ?>images/favicon-32x32.png" sizes="32x32">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="msapplication-TileImage" content="<?php echo $siteurl; ?>/images/mstile-144x144.png">
<?php echo $pophead; ?>
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
        <a class="navbar-brand" href="<?php echo home_url(); ?>">
          <img style="width:160px;margin-top:-5px" alt="<?php echo $sitename; ?>" src="<?php echo $siteurl; ?>result_files/logo1.png">
        </a>
      </div>
      <div class="collapse navbar-collapse " id="menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="<?php echo home_url(); ?>">
              <i class="fa fa-home">
              </i><?php echo $lang['home']; ?>
            </a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-line-chart">
              </i><?php echo $lang['top_chart_home']; ?>
              <span class="caret">
              </span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a href="<?php echo $siteurl; ?>top-world/">
                  <i class="fa fa-line-chart">
                  </i><?php echo $lang['top_50']; ?> (World)
                </a>
              </li>
              <li>
                <a href="<?php echo $siteurl; ?>top-india/">
                  <i class="fa fa-line-chart">
                  </i><?php echo $lang['top_50']; ?>(India)
                </a>
              </li>
              <li>
                <a href="<?php echo $siteurl; ?>top-france/">
                  <i class="fa fa-line-chart">
                  </i><?php echo $lang['top_50']; ?>(France)
                </a>
              </li>
              <li role="separator" class="divider">
              </li>
              <li class="dropdown-header">
                <?php echo $lang['more_chart']; ?>
              </li>
              <li>
                <a href="<?php echo $siteurl; ?>top-uk/">
                  <i class="fa fa-line-chart">
                  </i><?php echo $lang['top_50']; ?> (UK)
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="<?php echo $siteurl; ?>dmca.php">
              <i class="fa fa-copyright">
              </i>DMCA
            </a>
          </li>
          <li>
            <a href="<?php echo $siteurl; ?>contactus.php">
              <i class="fa fa-envelope-o">
              </i><?php echo $lang['contact_us']; ?>
            </a>
          </li>
          <?php
          if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
            ?>
            <li>
              <a href="<?php echo $siteurl; ?><?php echo $config_url; ?>">
                <i class="fa fa-cog">
                </i>Admin Panel
              </a>
            </li>
            <li>
              <a href="<?php echo $siteurl; ?><?php echo $config_url; ?>?logout=true">
                <i class="fa fa-sign-out">
                </i>Logout
              </a>
            </li>
            <?php
          }?>
        </ul>
        <?php
        if ($m_l == 'multi') {
          ?>
          <ul class="nav navbar-nav ">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-language">
                </i><?php echo $lang['language_title']; ?>
                <span class="caret">
                </span>
              </a>
              <ul class="dropdown-menu">
                <?php
                if (is_array($permalink) && !empty($permalink)) {
                  foreach ($permalink as $lang_url) {

                    if ($lang_url['lang_code'] == $lang_code) {
                      $select = 'class="active"';
                    }
                    else {
                      $select = '"';
                    }
                    ?>
                    <li <?php echo $select; ?>>
                      <a href="<?php echo $lang_url['url']; ?>">
                        <i class="fa fa-caret-right">
                        </i><?php echo $lang_url['lang']; ?>
                      </a>
                    </li>
                    <?php
                  }
                }
                else {
                  $select = 'class="active"';
                  ?>
                  <li <?php
 if ($lang_code == 'en') {echo $select;}?>>
                    <a href="<?php echo $siteurl; ?><?php echo $lang['_en']; ?>/" >
                      <i class="fa fa-caret-right">
                      </i><?php echo $lang['en']; ?>
                    </a>
                  </li>
                  <li <?php
 if ($lang_code == 'fr') {echo $select;}?>>
                    <a href="<?php echo $siteurl; ?><?php echo $lang['_fr']; ?>/" >
                      <i class="fa fa-caret-right">
                      </i><?php echo $lang['fr']; ?>
                    </a>
                  </li>
                  <li <?php
 if ($lang_code == 'de') {echo $select;}?>>
                    <a href="<?php echo $siteurl; ?><?php echo $lang['_de']; ?>/" >
                      <i class="fa fa-caret-right">
                      </i><?php echo $lang['de']; ?>
                    </a>
                  </li>
                  <li <?php
 if ($lang_code == 'br') {echo $select;}?>>
                    <a href="<?php echo $siteurl; ?><?php echo $lang['_br']; ?>/" >
                      <i class="fa fa-caret-right">
                      </i><?php echo $lang['br']; ?>
                    </a>
                  </li>
                  <?php
                }?>
              </ul>
            </li>
          </ul>

          <?php
        } ?>
      </div>
    </nav>
  </div>
</div>
<div class="container">
<div class="well" style="-webkit-box-shadow:0 6px 6px -6px #777;-moz-box-shadow:0 6px 6px -6px #777;box-shadow:0 6px 6px -6px #777;">
<center>
<?php
if (isset($home) && $home == true) {
  ?>
  <a href="<?php echo $siteurl; ?>">
    <img style="margin-top:-5px;margin-bottom:5px" class="thumbnail1 img-responsive" alt="<?php echo $sitename; ?>" src="<?php echo $siteurl; ?>result_files/home.png">
  </a>
  <?php
}?>
<?php include('class/nocsrf.php');
$token = NoCSRF::generate( 'csrf_token' );

?>
<form action="<?php echo $siteurl; ?>find.php" method="post">
  <div class="input-group col-lg-8">
    <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
    <input name="search" class="form-control input-lg" autofocus="autofocus" autocomplete="off" id="query"  placeholder="<?php echo $lang['search_input']; ?>" required="" type="text">
    <span class="input-group-btn">
      <button class="btn btn-primary" style="height:48px;" type="submit">
        <?php echo $lang['search_button']; ?>
      </button>
    </span>
  </div>
</form>
<?php echo $adsearch; ?>