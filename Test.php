<?php
require_once __DIR__ . '/vendor/autoload.php';

$drivers = [
    [
        'driver'=>'baidu',
        'app_key'=>'baidu api token'
    ],
    [
        'driver'=>'sina',
        'app_key'=>'weibo api app_key'
    ],
    [
        'driver'=>'dlj',
        'app_key'=>''
    ]
];

// include_once __DIR__.'/test_account.php';

$longUrl = 'http://www.2vm.net.cn';

foreach ($drivers as $k => $v) {
    var_dump('=============[driver:'.$v['driver'].']=============');
    $surl = new \bingher\surl\Surl($v);
    var_dump('[+] longUrl:'.$longUrl);
    $shortUrl = $surl->create($longUrl);
    if ($shortUrl === false) {
        var_dump('[-] create short url error:'.$surl->getError());
    } else {
        var_dump('shortUrl:'.$shortUrl);
    }
    $checkLongUrl = $surl->query($shortUrl);
    if ($checkLongUrl === false) {
        var_dump('[-] query short url error:'.$surl->getError());
    } else {
        var_dump('[+] shortUrl:'.$shortUrl.' expand long url:'.$checkLongUrl);
    }
}