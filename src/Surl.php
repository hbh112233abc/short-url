<?php
namespace bingher\url;

class Surl
{
    protected $baseUrl;
    protected $token;
    protected $headers;
    protected $error;
    public function __construct($token)
    {
        $this->baseUrl = 'https://dwz.cn/admin/v2';
        $this->headers = [
            'Content-Type:application/json',
            'Token:' . $token,
        ];
    }

    /**
     * 生成短链接
     * @param  string $longUrl 长链接
     * @return string          短链接
     */
    public function create($longUrl)
    {
        $api = $this->baseUrl . '/create';

        $params = ['url' => $longUrl];
        $res    = $this->post($api, $params);
        return empty($res) ? false : $res['ShortUrl'];
    }

    /**
     * 短链接还原
     * @param  string $shortUrl 短链接
     * @return string           长链接
     */
    public function query($shortUrl)
    {
        $api    = $this->baseUrl . '/query';
        $params = ['shortUrl' => $shortUrl];
        $res    = $this->post($api, $params);
        return empty($res) ? false : $res['LongUrl'];
    }

    /**
     * curl请求百度接口
     * @param  string $api    接口链接
     * @param  array  $params 传参
     * @return bool|array         接口返回json解析的数组
     */
    protected function post($api, $params = [])
    {
        try {
            // 创建连接
            $curl = curl_init($api);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
            curl_setopt($curl, CURLOPT_FAILONERROR, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));

            // 发送请求
            $response = curl_exec($curl);
            curl_close($curl);

            $result = json_decode($response, true);
            if ($result['Code'] === 0) {
                return $result;
            }
            $this->error = $result['ErrMsg'];
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
        }
        return false;
    }

    /**
     * 获取错误信息
     * @return string 错误信息
     */
    public function getError()
    {
        return $this->error;
    }
}
