<?php
require_once __DIR__ . '/vendor/autoload.php';
$baidu = [
    'driver'=>'baidu',
    'app_key'=>'8d9d76e891df103039677e4a5d32e80d'
];
$sina = [
    'driver'=>'sina',
    'app_key'=>'3818214747'
];
$surl = new \bingher\url\Surl($sina);

/*create short url*/
$longUrl = 'http://www.2vm.net.cn';
var_dump('longUrl:');
var_dump($longUrl);

$shortUrl = $surl->create($longUrl);
if ($shortUrl === false) {
    var_dump('create short url error:');
    var_dump($surl->getError());
}
var_dump('shortUrl:');
var_dump($shortUrl);

/*query long url from short url*/
$checkLongUrl = $surl->query($shortUrl);
if ($checkLongUrl === false) {
    var_dump('query short url error:');
    var_dump($surl->getError());
}
var_dump('shortUrl:'.$shortUrl.' expand long url:');
var_dump($checkLongUrl);
