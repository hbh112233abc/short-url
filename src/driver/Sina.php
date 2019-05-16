<?php
namespace bingher\url\driver;

/**
 * 新浪微博短地址
 * 接口参考文档:https://open.weibo.com/wiki/Short_url/shorten
 */
class Sina extends Base implements Driver
{
    protected $baseUri = 'http://api.t.sina.com.cn/short_url';
    protected $appKey = '';

    public function create($longUrl)
    {
        $api = $this->baseUri.'/shorten.json';
        $params = [
            'source' => $this->appKey,
            'url_long' => $longUrl,
        ];
        $res = $this->get($api,$params);
        if (!empty($res[0]['url_short'])) {
            return $res[0]['url_short'];
        }
        $this->error = $res['error'];
        return false;
    }

    public function query($shortUrl)
    {
        $api = $this->baseUri.'/expand.json';
        $params = [
            'source' => $this->appKey,
            'url_short' => $shortUrl,
        ];
        $res = $this->get($api,$params);
        if (!empty($res[0]['url_long'])) {
            return $res[0]['url_long'];
        }
        $this->error = $res['error'];
        return false;
    }

}
