<?php
//$siteurl = 'http://localhost / emp3 / ';
function timestamps($timestamp)
{
  return date('M j Y g:i A', strtotime($timestamp));
}

function covtime($youtube_time)
{
  $start = new DateTime('@0'); // Unix epoch
  $start->add(new DateInterval($youtube_time));
  return $start->format('H:i:s');

}

function timeinsec($str_time)
{
  //  $str_time = "23:12:95";

  $str_time     = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);

  sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

  $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;
  return ($time_seconds);
}

function fsz($bytes)
{
  if ($bytes >= 1073741824) {
    $bytes = number_format($bytes / 1073741824, 2) . ' GB';
  }
  elseif ($bytes >= 1048576) {
    $bytes = number_format($bytes / 1048576, 2) . ' MB';
  }
  elseif ($bytes >= 1024) {
    $bytes = number_format($bytes / 1024, 2) . ' KB';
  }
  elseif ($bytes > 1) {
    $bytes = $bytes . ' bytes';
  }
  elseif ($bytes == 1) {
    $bytes = $bytes . ' byte';
  }
  else {
    $bytes = '0 bytes';
  }

  return $bytes;
}

function number_shorten($number, $precision = 0, $divisors = null)
{

  // Setup default $divisors if not provided
  if (!isset($divisors)) {
    $divisors = array(
      pow(1000, 0)=> '',// 1000 ^ 0 == 1
      pow(1000, 1)=> 'K',// Thousand
      pow(1000, 2)=> 'M',// Million
      pow(1000, 3)=> 'B',// Billion
      pow(1000, 4)=> 'T',// Trillion
      pow(1000, 5)=> 'Qa',// Quadrillion
      pow(1000, 6)=> 'Qi',// Quintillion
    );
  }

  // Loop through each $divisor and find the
  // lowest amount that matches
  foreach ($divisors as $divisor => $shorthand) {
    if ($number < ($divisor * 1000)) {
      // We found a match!
      break;
    }
  }

  // We found our match, or there were no matches.
  // Either way, use the last defined value for $divisor.
  return number_format($number / $divisor, $precision) . $shorthand;
}

function timeprint($duration)
{
  $duration = $duration / (1000);
  $periods  = array(
    'day'   => 86400,
    'hour'  => 3600,
    'minute'=> 60,
    'second'=> 1,
  );

  $parts = array();

  foreach ($periods as $name => $dur) {
    $div = floor($duration / $dur);

    if ($div == 0) {
      continue;
    }
    else
    if ($div == 1) {
      $parts[] = $div . " " . $name;
    }
    else {
      $parts[] = $div . " " . $name . "s";
    }

    $duration %= $dur;
  }

  $last = array_pop($parts);

  if (empty($parts)) {
    return $last;
  }
  else {
    return join(', ', $parts) . " and " . $last;
  }

  printf("%d hours, %d minutes and %d seconds\n", (int) $miliseconds / (1000 * 60 * 60), (int) $miliseconds / (1000 * 60), (int) $miliseconds / 1000);

}

function release($release)
{
  $release = date('F j, Y', strtotime($release));
  return $release;
}

function artwork($url, $width = '80x80', $current = '100x100')
{
  global $ssl_setting;
  if (isset($ssl_setting) && $ssl_setting=='ssl'){
    return cache_image(str_ireplace($current, $width, $url));
  } else {
    return str_ireplace($current, $width, $url);
  }
}

function artist_url($artistId, $artistName, $deli = '-', $end = '.html')
{
  global $siteurl, $lang_code, $artist_rewrite,$m_l;
  $lange_code = lang($lang_code);

  $artistName = toAscii($artistName, '', $deli);
  if ($m_l == 'multi') {
    $url = $siteurl . $lange_code . '/' . $artist_rewrite . '/' . $artistId . '/' . $artistName . $end;
  }
  else {
    $url = $siteurl .  $artist_rewrite . '/' . $artistId . '/' . $artistName . $end;
  }
  return $url;
}

function album_url($albumid, $album, $deli = '-', $end = '.html')
{
  global $siteurl, $lang_code, $album_rewrite,$m_l;
  $lange_code = lang($lang_code);
  $album      = toAscii($album, '', $deli);
  if ($m_l == 'multi') {
    $url = $siteurl . $lange_code . '/' . $album_rewrite . '/' . $albumid . '/' . $album . $end;
  }
  else {
    $url = $siteurl . $album_rewrite . '/' . $albumid . '/' . $album . $end;
  }
  return $url;
}

function mp3_url($name, $deli = '-', $end = '.html')
{
  global $siteurl, $lang_code, $song_rewrite,$m_l;
  $lange_code = lang($lang_code);

  $name       = toAscii($name, '', $deli);
  if ($m_l == 'multi') {
    $url = $siteurl . $lange_code . '/' . $song_rewrite . '/' . $name . $end;
  }
  else {
    $url = $siteurl . $song_rewrite . '/' . $name . $end;
  }
  return $url;
}

function yt_url($id, $title, $deli = '-', $end = '.html')
{
  global $siteurl, $lang_code, $download_rewrite,$m_l;
  $lange_code = lang($lang_code);
  $name       = toAscii($title, '', $deli);

  if ($m_l == 'multi') {
    $url = $siteurl . $lange_code . '/' . $download_rewrite . '/' . $id . '/' . $name . $end;
  }
  else {
    $url = $siteurl . $download_rewrite . '/' . $id . '/' . $name . $end;
  }
  return $url;
}
function lang($lang_code = 'en')
{
  /* global $siteurl,$available_langs,$lang_code;
  //var_dump($_SESSION['lang']);

  if (!isset($lang_code) and $lang_code==''){
  $lang_code='en';
  } else {
  $siteurlx=$siteurl.$lang_code.'/';
  }

  return $siteurlx;
  */
  global $lang_default;
  if (!isset($lang_code) and $lang_code == '') {
    $lang_code = $lang_default;
  }
  return $lang_code;
}

function home_url()
{
  global $siteurl, $lang_code,$m_l;
  if (!isset($lang_code) and $lang_code == '' or $lang_code == 'en' and $m_l == 'multi') {
    $lang_code = 'en';
    return $siteurl;
  }
  else {
    return $siteurl . $lang_code . '/';
  }
}

/* TEXT CLEANING */
function seems_utf8($str)
{
  $length = strlen($str);
  for ($i = 0; $i < $length; $i++) {
    $c = ord($str[$i]);
    if ($c < 0x80) {
      $n = 0;
    }
    # 0bbbbbbb
    elseif (($c & 0xE0) == 0xC0) {
      $n = 1;
    }
    # 110bbbbb
    elseif (($c & 0xF0) == 0xE0) {
      $n = 2;
    }
    # 1110bbbb
    elseif (($c & 0xF8) == 0xF0) {
      $n = 3;
    }
    # 11110bbb
    elseif (($c & 0xFC) == 0xF8) {
      $n = 4;
    }
    # 111110bb
    elseif (($c & 0xFE) == 0xFC) {
      $n = 5;
    }
    # 1111110b
    else {
      return false;
    }
    # Does not match any model
    for ($j = 0; $j < $n; $j++) {
      # n bytes matching 10bbbbbb follow ?
      if ((++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80)) {
        return false;
      }

    }
  }
  return true;
}

/**
* Converts all accent characters to ASCII characters.
*
* If there are no accent characters, then the string given is just returned.
*
* @param string $string Text that might have accent characters
* @return string Filtered string with replaced "nice" characters.
*/
function remove_accents($string)
{
  if (!preg_match('/[\x80-\xff]/', $string)) {
    return $string;
  }

  if (seems_utf8($string)) {
    $chars = array(
      // Decompositions for Latin - 1 Supplement
      chr(195) . chr(128)=> 'A',chr(195) . chr(129)           => 'A',
      chr(195) . chr(130)           => 'A',chr(195) . chr(131)           => 'A',
      chr(195) . chr(132)           => 'A',chr(195) . chr(133)           => 'A',
      chr(195) . chr(135)           => 'C',chr(195) . chr(136)           => 'E',
      chr(195) . chr(137)           => 'E',chr(195) . chr(138)           => 'E',
      chr(195) . chr(139)           => 'E',chr(195) . chr(140)           => 'I',
      chr(195) . chr(141)           => 'I',chr(195) . chr(142)           => 'I',
      chr(195) . chr(143)           => 'I',chr(195) . chr(145)           => 'N',
      chr(195) . chr(146)           => 'O',chr(195) . chr(147)           => 'O',
      chr(195) . chr(148)           => 'O',chr(195) . chr(149)           => 'O',
      chr(195) . chr(150)           => 'O',chr(195) . chr(153)           => 'U',
      chr(195) . chr(154)           => 'U',chr(195) . chr(155)           => 'U',
      chr(195) . chr(156)           => 'U',chr(195) . chr(157)           => 'Y',
      chr(195) . chr(159)           => 's',chr(195) . chr(160)           => 'a',
      chr(195) . chr(161)           => 'a',chr(195) . chr(162)           => 'a',
      chr(195) . chr(163)           => 'a',chr(195) . chr(164)           => 'a',
      chr(195) . chr(165)           => 'a',chr(195) . chr(167)           => 'c',
      chr(195) . chr(168)           => 'e',chr(195) . chr(169)           => 'e',
      chr(195) . chr(170)           => 'e',chr(195) . chr(171)           => 'e',
      chr(195) . chr(172)           => 'i',chr(195) . chr(173)           => 'i',
      chr(195) . chr(174)           => 'i',chr(195) . chr(175)           => 'i',
      chr(195) . chr(177)           => 'n',chr(195) . chr(178)           => 'o',
      chr(195) . chr(179)           => 'o',chr(195) . chr(180)           => 'o',
      chr(195) . chr(181)           => 'o',chr(195) . chr(182)           => 'o',
      chr(195) . chr(182)           => 'o',chr(195) . chr(185)           => 'u',
      chr(195) . chr(186)           => 'u',chr(195) . chr(187)           => 'u',
      chr(195) . chr(188)           => 'u',chr(195) . chr(189)           => 'y',
      chr(195) . chr(191)           => 'y',
      // Decompositions for Latin Extended - A
      chr(196) . chr(128)=> 'A',chr(196) . chr(129)           => 'a',
      chr(196) . chr(130)           => 'A',chr(196) . chr(131)           => 'a',
      chr(196) . chr(132)           => 'A',chr(196) . chr(133)           => 'a',
      chr(196) . chr(134)           => 'C',chr(196) . chr(135)           => 'c',
      chr(196) . chr(136)           => 'C',chr(196) . chr(137)           => 'c',
      chr(196) . chr(138)           => 'C',chr(196) . chr(139)           => 'c',
      chr(196) . chr(140)           => 'C',chr(196) . chr(141)           => 'c',
      chr(196) . chr(142)           => 'D',chr(196) . chr(143)           => 'd',
      chr(196) . chr(144)           => 'D',chr(196) . chr(145)           => 'd',
      chr(196) . chr(146)           => 'E',chr(196) . chr(147)           => 'e',
      chr(196) . chr(148)           => 'E',chr(196) . chr(149)           => 'e',
      chr(196) . chr(150)           => 'E',chr(196) . chr(151)           => 'e',
      chr(196) . chr(152)           => 'E',chr(196) . chr(153)           => 'e',
      chr(196) . chr(154)           => 'E',chr(196) . chr(155)           => 'e',
      chr(196) . chr(156)           => 'G',chr(196) . chr(157)           => 'g',
      chr(196) . chr(158)           => 'G',chr(196) . chr(159)           => 'g',
      chr(196) . chr(160)           => 'G',chr(196) . chr(161)           => 'g',
      chr(196) . chr(162)           => 'G',chr(196) . chr(163)           => 'g',
      chr(196) . chr(164)           => 'H',chr(196) . chr(165)           => 'h',
      chr(196) . chr(166)           => 'H',chr(196) . chr(167)           => 'h',
      chr(196) . chr(168)           => 'I',chr(196) . chr(169)           => 'i',
      chr(196) . chr(170)           => 'I',chr(196) . chr(171)           => 'i',
      chr(196) . chr(172)           => 'I',chr(196) . chr(173)           => 'i',
      chr(196) . chr(174)           => 'I',chr(196) . chr(175)           => 'i',
      chr(196) . chr(176)           => 'I',chr(196) . chr(177)           => 'i',
      chr(196) . chr(178)           => 'IJ',chr(196) . chr(179)           => 'ij',
      chr(196) . chr(180)           => 'J',chr(196) . chr(181)           => 'j',
      chr(196) . chr(182)           => 'K',chr(196) . chr(183)           => 'k',
      chr(196) . chr(184)           => 'k',chr(196) . chr(185)           => 'L',
      chr(196) . chr(186)           => 'l',chr(196) . chr(187)           => 'L',
      chr(196) . chr(188)           => 'l',chr(196) . chr(189)           => 'L',
      chr(196) . chr(190)           => 'l',chr(196) . chr(191)           => 'L',
      chr(197) . chr(128)           => 'l',chr(197) . chr(129)           => 'L',
      chr(197) . chr(130)           => 'l',chr(197) . chr(131)           => 'N',
      chr(197) . chr(132)           => 'n',chr(197) . chr(133)           => 'N',
      chr(197) . chr(134)           => 'n',chr(197) . chr(135)           => 'N',
      chr(197) . chr(136)           => 'n',chr(197) . chr(137)           => 'N',
      chr(197) . chr(138)           => 'n',chr(197) . chr(139)           => 'N',
      chr(197) . chr(140)           => 'O',chr(197) . chr(141)           => 'o',
      chr(197) . chr(142)           => 'O',chr(197) . chr(143)           => 'o',
      chr(197) . chr(144)           => 'O',chr(197) . chr(145)           => 'o',
      chr(197) . chr(146)           => 'OE',chr(197) . chr(147)           => 'oe',
      chr(197) . chr(148)           => 'R',chr(197) . chr(149)           => 'r',
      chr(197) . chr(150)           => 'R',chr(197) . chr(151)           => 'r',
      chr(197) . chr(152)           => 'R',chr(197) . chr(153)           => 'r',
      chr(197) . chr(154)           => 'S',chr(197) . chr(155)           => 's',
      chr(197) . chr(156)           => 'S',chr(197) . chr(157)           => 's',
      chr(197) . chr(158)           => 'S',chr(197) . chr(159)           => 's',
      chr(197) . chr(160)           => 'S',chr(197) . chr(161)           => 's',
      chr(197) . chr(162)           => 'T',chr(197) . chr(163)           => 't',
      chr(197) . chr(164)           => 'T',chr(197) . chr(165)           => 't',
      chr(197) . chr(166)           => 'T',chr(197) . chr(167)           => 't',
      chr(197) . chr(168)           => 'U',chr(197) . chr(169)           => 'u',
      chr(197) . chr(170)           => 'U',chr(197) . chr(171)           => 'u',
      chr(197) . chr(172)           => 'U',chr(197) . chr(173)           => 'u',
      chr(197) . chr(174)           => 'U',chr(197) . chr(175)           => 'u',
      chr(197) . chr(176)           => 'U',chr(197) . chr(177)           => 'u',
      chr(197) . chr(178)           => 'U',chr(197) . chr(179)           => 'u',
      chr(197) . chr(180)           => 'W',chr(197) . chr(181)           => 'w',
      chr(197) . chr(182)           => 'Y',chr(197) . chr(183)           => 'y',
      chr(197) . chr(184)           => 'Y',chr(197) . chr(185)           => 'Z',
      chr(197) . chr(186)           => 'z',chr(197) . chr(187)           => 'Z',
      chr(197) . chr(188)           => 'z',chr(197) . chr(189)           => 'Z',
      chr(197) . chr(190)           => 'z',chr(197) . chr(191)           => 's',
      // Euro Sign
      chr(226) . chr(130) . chr(172)=> 'E',
      // GBP (Pound) Sign
      chr(194) . chr(163)=> '');

    $string = strtr($string, $chars);
  }
  else {
    // Assume ISO - 8859 - 1 if not UTF - 8
    $chars['in'] = chr(128) . chr(131) . chr(138) . chr(142) . chr(154) . chr(158)
    . chr(159) . chr(162) . chr(165) . chr(181) . chr(192) . chr(193) . chr(194)
    . chr(195) . chr(196) . chr(197) . chr(199) . chr(200) . chr(201) . chr(202)
    . chr(203) . chr(204) . chr(205) . chr(206) . chr(207) . chr(209) . chr(210)
    . chr(211) . chr(212) . chr(213) . chr(214) . chr(216) . chr(217) . chr(218)
    . chr(219) . chr(220) . chr(221) . chr(224) . chr(225) . chr(226) . chr(227)
    . chr(228) . chr(229) . chr(231) . chr(232) . chr(233) . chr(234) . chr(235)
    . chr(236) . chr(237) . chr(238) . chr(239) . chr(241) . chr(242) . chr(243)
    . chr(244) . chr(245) . chr(246) . chr(248) . chr(249) . chr(250) . chr(251)
    . chr(252) . chr(253) . chr(255);

    $chars['out'] = "EfSZszYcYuAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy";

    $string = strtr($string, $chars['in'], $chars['out']);
    $double_chars['in'] = array(chr(140),chr(156),chr(198),chr(208),chr(222),chr(223),chr(230),chr(240),chr(254));
    $double_chars['out'] = array('OE','oe','AE','DH','TH','ss','ae','dh','th');
    $string = str_replace($double_chars['in'], $double_chars['out'], $string);
  }

  return $string;
}
function toAscii($str, $options = array(), $delimiter = ' ')
{
  // Make sure string is in UTF - 8 and strip invalid UTF - 8 characters
  $str = mb_convert_encoding((string) $str, 'UTF-8', mb_list_encodings());

  $defaults = array(
    'delimiter'    => $delimiter,
    'limit'        => null,
    'lowercase'    => false,
    'replacements'  => array(),
    'transliterate'=> false,
  );

  if (!isset($options) && $options == '') {
    $options = array();
  }
  // Merge options
  $options = array();
  $options = array_merge($defaults, $options);

  $char_map= array(
    // Latin
    'À'=> 'A','Á'=> 'A','Â'=> 'A','Ã'=> 'A','Ä'=> 'A','Å'=> 'A','Æ'=> 'AE','Ç'=> 'C',
    'È'=> 'E','É'=> 'E','Ê'=> 'E','Ë'=> 'E','Ì'=> 'I','Í'=> 'I','Î'=> 'I','Ï'=> 'I',
    'Ð'=> 'D','Ñ'=> 'N','Ò'=> 'O','Ó'=> 'O','Ô'=> 'O','Õ'=> 'O','Ö'=> 'O','Ő'=> 'O',
    'Ø'=> 'O','Ù'=> 'U','Ú'=> 'U','Û'=> 'U','Ü'=> 'U','Ű'=> 'U','Ý'=> 'Y','Þ'=> 'TH',
    'ß'=> 'ss',
    'à'=> 'a','á'=> 'a','â'=> 'a','ã'=> 'a','ä'=> 'a','å'=> 'a','æ'=> 'ae','ç'=> 'c',
    'è'=> 'e','é'=> 'e','ê'=> 'e','ë'=> 'e','ì'=> 'i','í'=> 'i','î'=> 'i','ï'=> 'i',
    'ð'=> 'd','ñ'=> 'n','ò'=> 'o','ó'=> 'o','ô'=> 'o','õ'=> 'o','ö'=> 'o','ő'=> 'o',
    'ø'=> 'o','ù'=> 'u','ú'=> 'u','û'=> 'u','ü'=> 'u','ű'=> 'u','ý'=> 'y','þ'=> 'th',
    'ÿ'=> 'y',
    // Latin symbols
    '©'=> '(c)',
    // Greek
    'Α'=> 'A','Β'=> 'B','Γ'=> 'G','Δ'=> 'D','Ε'=> 'E','Ζ'=> 'Z','Η'=> 'H','Θ'=> '8',
    'Ι'=> 'I','Κ'=> 'K','Λ'=> 'L','Μ'=> 'M','Ν'=> 'N','Ξ'=> '3','Ο'=> 'O','Π'=> 'P',
    'Ρ'=> 'R','Σ'=> 'S','Τ'=> 'T','Υ'=> 'Y','Φ'=> 'F','Χ'=> 'X','Ψ'=> 'PS','Ω'=> 'W',
    'Ά'=> 'A','Έ'=> 'E','Ί'=> 'I','Ό'=> 'O','Ύ'=> 'Y','Ή'=> 'H','Ώ'=> 'W','Ϊ'=> 'I',
    'Ϋ'=> 'Y',
    'α'=> 'a','β'=> 'b','γ'=> 'g','δ'=> 'd','ε'=> 'e','ζ'=> 'z','η'=> 'h','θ'=> '8',
    'ι'=> 'i','κ'=> 'k','λ'=> 'l','μ'=> 'm','ν'=> 'n','ξ'=> '3','ο'=> 'o','π'=> 'p',
    'ρ'=> 'r','σ'=> 's','τ'=> 't','υ'=> 'y','φ'=> 'f','χ'=> 'x','ψ'=> 'ps','ω'=> 'w',
    'ά'=> 'a','έ'=> 'e','ί'=> 'i','ό'=> 'o','ύ'=> 'y','ή'=> 'h','ώ'=> 'w','ς'=> 's',
    'ϊ'=> 'i','ΰ'=> 'y','ϋ'=> 'y','ΐ'=> 'i',
    // Turkish
    'Ş'=> 'S','İ'=> 'I','Ç'=> 'C','Ü'=> 'U','Ö'=> 'O','Ğ'=> 'G',
    'ş'=> 's','ı'=> 'i','ç'=> 'c','ü'=> 'u','ö'=> 'o','ğ'=> 'g',
    // Russian
    'А'=> 'A','Б'=> 'B','В'=> 'V','Г'=> 'G','Д'=> 'D','Е'=> 'E','Ё'=> 'Yo','Ж'=> 'Zh',
    'З'=> 'Z','И'=> 'I','Й'=> 'J','К'=> 'K','Л'=> 'L','М'=> 'M','Н'=> 'N','О'=> 'O',
    'П'=> 'P','Р'=> 'R','С'=> 'S','Т'=> 'T','У'=> 'U','Ф'=> 'F','Х'=> 'H','Ц'=> 'C',
    'Ч'=> 'Ch','Ш'=> 'Sh','Щ'=> 'Sh','Ъ'=> '','Ы'=> 'Y','Ь'=> '','Э'=> 'E','Ю'=> 'Yu',
    'Я'=> 'Ya',
    'а'=> 'a','б'=> 'b','в'=> 'v','г'=> 'g','д'=> 'd','е'=> 'e','ё'=> 'yo','ж'=> 'zh',
    'з'=> 'z','и'=> 'i','й'=> 'j','к'=> 'k','л'=> 'l','м'=> 'm','н'=> 'n','о'=> 'o',
    'п'=> 'p','р'=> 'r','с'=> 's','т'=> 't','у'=> 'u','ф'=> 'f','х'=> 'h','ц'=> 'c',
    'ч'=> 'ch','ш'=> 'sh','щ'=> 'sh','ъ'=> '','ы'=> 'y','ь'=> '','э'=> 'e','ю'=> 'yu',
    'я'=> 'ya',
    // Ukrainian
    'Є'=> 'Ye','І'=> 'I','Ї'=> 'Yi','Ґ'=> 'G',
    'є'=> 'ye','і'=> 'i','ї'=> 'yi','ґ'=> 'g',
    // Czech
    'Č'=> 'C','Ď'=> 'D','Ě'=> 'E','Ň'=> 'N','Ř'=> 'R','Š'=> 'S','Ť'=> 'T','Ů'=> 'U',
    'Ž'=> 'Z',
    'č'=> 'c','ď'=> 'd','ě'=> 'e','ň'=> 'n','ř'=> 'r','š'=> 's','ť'=> 't','ů'=> 'u',
    'ž'=> 'z',
    // Polish
    'Ą'=> 'A','Ć'=> 'C','Ę'=> 'e','Ł'=> 'L','Ń'=> 'N','Ó'=> 'o','Ś'=> 'S','Ź'=> 'Z',
    'Ż'=> 'Z',
    'ą'=> 'a','ć'=> 'c','ę'=> 'e','ł'=> 'l','ń'=> 'n','ó'=> 'o','ś'=> 's','ź'=> 'z',
    'ż'=> 'z',
    // Latvian
    'Ā'=> 'A','Č'=> 'C','Ē'=> 'E','Ģ'=> 'G','Ī'=> 'i','Ķ'=> 'k','Ļ'=> 'L','Ņ'=> 'N',
    'Š'=> 'S','Ū'=> 'u','Ž'=> 'Z',
    'ā'=> 'a','č'=> 'c','ē'=> 'e','ģ'=> 'g','ī'=> 'i','ķ'=> 'k','ļ'=> 'l','ņ'=> 'n',
    'š'=> 's','ū'=> 'u','ž'=> 'z',
  );

  // Make custom replacements
  $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

  // Transliterate characters to ASCII
  if ($options['transliterate']) {
    $str = str_replace(array_keys($char_map), $char_map, $str);
  }

  // Replace non - alphanumeric characters with our delimiter
  $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

  // Remove duplicate delimiters
  $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

  // Truncate slug to max. characters
  $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');

  // Remove delimiter from ends
  $str = trim($str, $options['delimiter']);

  return $options['lowercase'] ? $str : $str;
}
/*
function toAscii($str, $replace=array(), $delimiter='-') {
$replace_array=array('&quot;','&amp;','&#039;'.',');
$str=str_replace($replace_array,'',$str);
//global $delimiters;
if( !empty($replace) ) {
$str = str_replace((array)$replace, ' ', $str);
}
//  setlocale(LC_COLLATE, 'en_US.utf8');
//echo $str;

if (preg_match("/^[a-zA-Z0-9 ]*$/u", $str) == 1){
//   $clean = iconv('UTF-8', 'us-ascii//TRANSLIT', $str);
$clean =remove_accents($str);
//     echo $clean.'<br>';
}  else {
$clean= $str;
//   echo $str2.'<br>';
}

// $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $clean);
$clean = strtolower(trim($clean, '-'));
$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

return $clean;
}

*/

function xss_clean($data)
{
  // Fix & entity\n;
  $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
  $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
  $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
  $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

  // Remove any attribute starting with "on" or xmlns
  $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

  // Remove javascript: and vbscript: protocols
  $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
  $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
  $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

  // Only works in IE: < span style = "width: expression(alert('Ping!'));"></span >
  $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
  $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
  $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

  // Remove namespaced elements (we do not need them)
  $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

  do {
    // Remove really unwanted tags
    $old_data = $data;
    $data     = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
  }
  while ($old_data !== $data);

  // we are done...
  return $data;
}

function cache_url($url, $skip_cache = true,$proxy = '')
{
  // settings
  $cachetime = 604800; //one week
  $where     = "cache";
  if (!is_dir($where)) {
    mkdir($where);
  }

  $hash = md5($url);
  $file = "$where/$hash.cache";

  // check the bloody file.
  $mtime= 0;
  if (file_exists($file)) {
    $mtime = filemtime($file);
  }
  $filetimemod = $mtime + $cachetime;

  // if the renewal date is smaller than now, return true; else false (no need for update)
  if ($filetimemod < time() OR $skip_cache) {
    // $data = file_get_contents($url);
    $ip = "" . mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("REMOTE_ADDR: $ip","HTTP_X_FORWARDED_FOR: $ip"));
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_REFERER, "https://emp3z.ws/");

    if (isset($proxy) && $proxy != '') {
      curl_setopt($ch, CURLOPT_PROXY, $proxy);
    }

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $data = curl_exec($ch);
    curl_close($ch);

    // save the file if there's data
    if ($data AND !$skip_cache) {
      file_put_contents($file, $data);
    }
  }
  else {
    $data = file_get_contents($file);
  }

  return $data;
}

function cache_image($image_url){
 global $siteurl;
    //replace with your cache directory
    $image_path = 'cache/images/';
    //get the name of the file
    $random_hash=md5($image_url);
    $exploded_image_url = explode("/",$image_url);
    $image_filename = $random_hash.end($exploded_image_url);
   // echo $image_filename;
    $exploded_image_filename = explode(".",$image_filename);
    $extension = end($exploded_image_filename);
    //make sure its an image
    if($extension == "gif" || $extension == "jpg" || $extension == "jpeg" || $extension == "png") {
        //get the remote image
        if (!file_exists($image_path.$image_filename)){

		$image_to_fetch = file_get_contents($image_url);
        //save it
        $local_image_file = fopen($image_path.$image_filename, 'w+');
        chmod($image_path.$image_filename,0755);
        fwrite($local_image_file, $image_to_fetch);
        fclose($local_image_file);
        }
        return $siteurl.$image_path.$image_filename;
    }
    return false;
}

function change($string, $site_url, $sitename)
{
  $array1 = array('{sitename}','{site_url}');
  $array2 = array($sitename,$site_url);
  return str_ireplace($array1, $array2, $string);

}
