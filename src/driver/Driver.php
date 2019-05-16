<?php
namespace bingher\url\driver;

interface Driver
{
    public function create($longUrl);
    public function query($shortUrl);
}
