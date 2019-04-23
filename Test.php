<?php
require_once __DIR__ . '/vendor/autoload.php';
$surl = new Surl('8d9d76e891df103039677e4a5d32e80d');

/*create short url*/
$longUrl = 'http://www.2vm.net.cn';
var_dump($longUrl);

$shortUrl = $surl->create($longUrl);
if ($shortUrl === false) {
    var_dump($surl->getError());
}
var_dump($shorUrl);

/*query long url from short url*/
$checkLongUrl = $surl->query($shortUrl);
if ($checkLongUrl === false) {
    var_dump($surl->getError());
}
var_dump($checkLongUrl);
