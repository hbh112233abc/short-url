<?php
namespace bingher\url\driver;

/**
 * 驱动公用基础类
 * 主要提供以下公用方法:
 * 1.get请求
 * 2.post请求
 * 3.getError获取错误信息
 */
abstract class Base
{
    protected $baseUri = '';
    protected $appKey = '';
    protected $headers;
    protected $error;
    function __construct($appKey = '')
    {
        if (!empty($appKey)) {
            $this->appKey = $appKey;
        }

        if (empty($this->appKey)) {
            throw new \Exception('appKey nou found');
        }

        $this->headers = [
            'Content-Type:application/json',
        ];
    }

    public function create($longUrl)
    {
        echo '创建短链接From:'.$longUrl;
    }

    public function query($shortUrl)
    {
        echo '解析短链接From:'.$shortUrl;
    }

    /**
     * curl请求GET接口
     * @param  string $api    接口链接
     * @param  array  $params 传参
     * @return bool|array         接口返回json解析的数组
     */
    public function get($api,$params = [])
    {
        try {
            if (!empty($params)) {
                $query = http_build_query($params);
                if (strpos('?', $api) !== false) {
                    $api = $api . '&' . $query;
                } else {
                    $api = $api . '?' . $query;
                }
            }

            $curl = curl_init($api);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
            curl_setopt($curl, CURLOPT_FAILONERROR, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_HEADER, false);

            //发送请求
            $response = curl_exec($curl);
            curl_close($curl);
            try {
                $result = json_decode($response,true);
            } catch (\Exception $e) {
                $result = $response;
            }

            return $result;
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
        }
        return false;
    }

    /**
     * curl请求POST接口
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
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));

            // 发送请求
            $response = curl_exec($curl);
            curl_close($curl);
            try {
                $result = json_decode($response,true);
            } catch (\Exception $e) {
                $result = $response;
            }
            return $result;
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
