<?php
namespace bingher\surl\driver;

/**
 * 点链接(dlj.biz)短地址驱动
 * 接口文档:https://dlj.biz/doc
 */
class Dlj extends Base implements Driver
{
    protected $baseUri = 'https://dlj.biz/api';
    protected $appKey = '';
    protected $headers;
    protected $error;
    public function __construct($appKey = '')
    {
        parent::__construct($appKey);

        $this->headers = [
            'Content-Type:application/json'
        ];
    }

    /**
     * 生成短链接
     * @param  string $longUrl 长链接
     * @return string          短链接
     */
    public function create($longUrl,$validity)
    {
        $api = $this->baseUri . '/create';

        $params = ['url' => $longUrl];
        $res    = $this->post($api, $params);
        if ($res['Code'] === 0) {
            return $res['ShortUrl'];
        }
        $this->error = $res['ErrMsg'];
        return false;
    }

    /**
     * 短链接还原
     * @param  string $shortUrl 短链接
     * @return string           长链接
     */
    public function query($shortUrl)
    {
        $api    = $this->baseUri . '/query';
        $params = ['shortUrl' => $shortUrl];
        $res    = $this->post($api, $params);
        if ($res['Code'] === 0) {
            return $res['LongUrl'];
        }
        $this->error = $res['ErrMsg'];
        return false;
    }

}