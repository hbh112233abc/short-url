# Surl
> make long url to short url by baidu api

## Install
```
composer require bingher/surl dev-master
```

## Example
```
<?php
use bingher\url\Surl;

$surl     = new Surl('baidu api token');

/*create short url*/
$longUrl  = 'http://www.2vm.net.cn';
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
```

## MIT License


