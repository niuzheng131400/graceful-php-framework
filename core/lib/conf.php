<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/10
 * Time: 14:03
 * --------
 * 配置类
 */

namespace core\lib;

class conf
{
    static public $conf = [];

    /**
     * 获取单个配置项
     *
     * @param $name
     * @param $file
     * @return mixed
     * @throws \Exception
     * ----------
     * 1、判断配置文件是否存在
     * 2、判断配置是否存在
     * 3、缓存配置
     */
    static public function get($name, $file)
    {
        if (isset(self::$conf[$file])) {
            return self::$conf[$file][$name];
        } else {
            $path = MY_FRAME . '/core/config/' . $file . '.php';
            if (is_file($path)) {
                $conf = include $path;
                if (isset($conf[$name])) {
                    self::$conf[$file] = $conf;
                    return $conf[$name];
                } else {
                    throw new \Exception('not found config param' . $name);
                }
            } else {
                throw new \Exception('not found config file' . $file);
            }
        }
    }

    /**
     * 获取多个配置
     *
     * @param $file
     * @return mixed
     * @throws \Exception
     * -------------
     * 1、判断配置文件是否存在
     * 2、缓存配置
     */
    static public function all($file)
    {
        if (isset(self::$conf[$file])) {
            return self::$conf[$file];
        } else {
            $path = MY_FRAME . '/core/config/' . $file . '.php';
            if (is_file($path)) {
                $conf = include $path;
                self::$conf[$file] = $conf;
                return $conf;
            } else {
                throw new \Exception('not found config file' . $file);
            }
        }
    }
}