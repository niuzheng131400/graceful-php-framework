<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/26
 * Time: 17:06
 */

namespace core\lib;

class Config implements \ArrayAccess
{
    protected $path;
    protected $configs = [];
    protected $all = [];

    public function __construct($path, $config = [])
    {
        $this->path = $path;
        $this->all = $config;
    }

    public function offsetGet($key)
    {
        if (empty($this->configs[$key])) {
            $file_path = $this->path . '/' . $key . '.php';
            $config = require $file_path;
            $this->configs[$key] = $config;
        }
        return array_merge($this->configs[$key], $this->all);
    }

    public function offsetSet($key, $value)
    {
        throw new \Exception("cannot write config file.");
    }

    public function offsetExists($key)
    {
        return isset($this->configs[$key]);
    }

    public function offsetUnset($key)
    {
        unset($this->configs[$key]);
    }
}
