<?php
namespace bingher\surl;

class Surl
{
    protected $driver = 'Sina';
    protected $validity;
    protected $hander;
    public function __construct($config = [])
    {
        if (!empty($config['driver'])) {
            $this->driver = $config['driver'];
        }

        $namespace = '\\bingher\\surl\\driver\\';

        $appKey = $config['app_key'];

        $className = false !== strpos($this->driver, '\\') ? $this->driver : $namespace . ucwords($this->driver);

        if (!class_exists($className)) {
            throw new \ClassNotFoundException('class not exists:' . $className, $className);
        }

        $this->validity = $config['validity'];

        $class = new \ReflectionClass($className);
        $this->handle = $class->newInstance($appKey);
    }

    /**
     * 生成短链接
     * @param  string $longUrl 长链接
     * @return string          短链接
     */
    public function create(string $longUrl)
    {
        return $this->handle->create($longUrl,$this->validity);
    }

    /**
     * 短链接还原
     * @param  string $shortUrl 短链接
     * @return string           长链接
     */
    public function query(string $shortUrl)
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
