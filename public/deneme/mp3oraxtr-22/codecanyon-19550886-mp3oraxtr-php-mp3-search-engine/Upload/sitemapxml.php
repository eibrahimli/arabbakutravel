<?php
$data_file = unserialize(base64_decode(file_get_contents('includes/website_setting.conf')));
//require dirname(__FILE__) . (" / includes / config.php");
//            var_dump($_GET);

require dirname(__FILE__) . ("/includes/database.php");
require dirname(__FILE__) . ("/includes/functions.php");
$lang_code = 'en';
header("Content-Type: text/xml");
print "<?xml version='1.0' encoding='utf-8'?>";
$pageLimit = 15000;
$base      = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$base      = substr($base, 0, strrpos($base, "/") + 1);
//$link = mysql_connect($database['db_host'],$database['db_user'],$database['db_pass']);
//mysql_select_db($database['db_name'],$link);
if (isset($_GET["page"])) {
  print '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
  xmlns:xhtml="http://www.w3.org/1999/xhtml">
  ';
  $page    = intval($_GET["page"]);
  $from    = (($page - 1) * $pageLimit);
  $sql     = "SELECT * FROM search LIMIT " . $from . "," . $pageLimit;
  //$result = mysql_unbuffered_query($sql,$link);
  $results = $database->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  //var_dump($results);
  foreach ($results as $result) {
    //  while($row = mysql_fetch_array($result,MYSQL_ASSOC))
    //  {
    print "<url>
    ";

    print "<loc>" . mp3_url($result["tag"]) . "</loc>
    ";
    if ($m_l != 'single') {
      $lang_codex = $lang_code;
      foreach ($available_langs as $lang_code) {
        ?>
        <xhtml:link rel="alternate" hreflang="<?php echo $lang_code; ?>" href="<?php echo mp3_url($result["tag"]); ?>" />
        <?php

      }
      $lang_code = $lang_codex;
    }
    print "</url>

    ";
  }
  print "</urlset>
  ";
}
else {
  print "<sitemapindex xmlns='http://www.google.com/schemas/sitemap/0.84' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/siteindex.xsd'>";
  $sql     = "SELECT count(*) as count FROM search";
  // $result = mysql_query($sql,$link);
  $results = $database->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  $row     = count($results);
  $pages   = ceil($row / $pageLimit);
  for ($i = 1; $i <= $pages; $i++) {
    print "<sitemap>";
    $loc = $base . "sitemap.php?page=" . $i;
    print "<loc>" . $siteurl . "sitemap_" . $i . ".xml</loc>";
    print "</sitemap>";
  }
  print "</sitemapindex>";
}
exit();
function xmlentities($text)
{
  $search = array('&','<','>','"','\'');
  $replace = array('&amp;','&lt;','&gt;','&quot;','&apos;');
  $text = str_replace($search, $replace, $text);
  return $text;
}
?>