# Surl
> php plugin for make long url to short url
## Install
```
composer require bingher/surl
```

## Example
```
<?php
require_once __DIR__ . '/vendor/autoload.php';
$baidu = [
    'driver'=>'baidu',
    'app_key'=>'your token'
];
$sina = [
    'driver'=>'sina',
    'app_key'=>'your appKey'
];
$surl = new \bingher\surl\Surl($sina);

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
```

## MIT License


