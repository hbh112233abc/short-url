<?php
namespace bingher\url;

class Surl
{
    protected $driver = 'Sina';
    protected $hander;
    public function __construct($config = [])
    {
        if (!empty($config['driver'])) {
            $this->driver = $config['driver'];
        }

        $namespace = '\\bingher\\url\\driver\\';

        if (empty($config['app_key'])) {
            throw new \Exception('app_key not found');
        }

        $appKey = $config['app_key'];

        $className = false !== strpos($this->driver, '\\') ? $this->driver : $namespace . ucwords($this->driver);

        if (!class_exists($className)) {
            throw new \ClassNotFoundException('class not exists:' . $className, $className);
        }

        $class = new \ReflectionClass($className);
        $this->handle = $class->newInstance($appKey);
    }

    /**
     * 生成短链接
     * @param  string $longUrl 长链接
     * @return string          短链接
     */
    public function create($longUrl)
    {
        return $this->handle->create($longUrl);
    }

    /**
     * 短链接还原
     * @param  string $shortUrl 短链接
     * @return string           长链接
     */
    public function query($shortUrl)
    {
        return $this->handle->query($shortUrl);
    }

    /**
     * 获取错误信息
     * @return string 错误信息
     */
    public function getError()
    {
        return $this->handle->getError();
    }
}
