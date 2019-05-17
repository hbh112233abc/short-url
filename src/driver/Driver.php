<?php
namespace bingher\surl\driver;

/**
 * 驱动模板,新增驱动请implement此模板,保证接口统一
 */
interface Driver
{
    public function create($longUrl);
    public function query($shortUrl);
}
