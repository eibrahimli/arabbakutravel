<?php
$key_encrypt = 'encryptyoutubeid';
function hideinfo($key, $string) {return rawurlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key)))));}
function showinfo($key, $string) {return rawurldecode(rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode(rawurldecode($string)), MCRYPT_MODE_CBC, md5(md5($key))), "\0"));}
?>