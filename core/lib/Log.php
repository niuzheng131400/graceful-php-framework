<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/10
 * Time: 15:03
 * ----------------
 * 日志处理类
 * 1、确定日志存储方式
 * 2、写日志
 */

namespace core\lib;

use Core\Framework;

class Log
{
    static $class;

    /**
     *
     */
    static public function init()
    {
        $logConfig = Framework::getInstance()->config['main']['log'];
        $drive = ucwords($logConfig['drive']);
        $key = 'log_' . $drive;
        self::$class = Register::get($key);
        if (!self::$class) {
            $class = '\\core\\lib\\drive\\log\\' . $drive;
            $option = $logConfig['option'];
            self::$class = new $class($option);
            Register::set($key, self::$class);
        }
    }

    /**
     * @param $message
     * @param string $lever
     */
    static public function log($message, $lever = "INFO")
    {
        self::$class->log($message, $lever);
    }
}
