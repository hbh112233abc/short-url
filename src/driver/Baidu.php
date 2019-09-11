<?php
namespace bingher\surl\driver;

/**
 * 百度短地址驱动
 * 接口文档:https://dwz.cn/console/apidoc
 */
class Baidu extends Base implements Driver
{
    protected $baseUri = 'https://dwz.cn/admin/v2';
    protected $term = ['long-term','1-year'];
    protected $appKey = '';
    protected $headers;
    protected $error;
    public function __construct($appKey)
    {
        parent::__construct($appKey);

        if (empty($this->appKey)) {
            throw new \Exception('appKey nou found');
        }

        $this->headers = [
            'Content-Type:application/json',
            'Token:' . $this->appKey,
        ];
    }

    /**
     * 生成短链接
     * @param  string $longUrl 长链接
     * @param  string $validity 有效期
     * @return string          短链接
     */
    public function create($longUrl,$validity)
    {
        $api = $this->baseUri . '/create';
        $params = ['Url' => $longUrl,'TermOfValidity' => $validity];
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
