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

class log
{
    static $class;

    /**
     * @throws \Exception
     */
    static public function init()
    {
        $logConfig = Framework::getInstance()->config['main']['log'];
        $drive = $logConfig['drive'];
        $class = '\\core\\lib\\drive\\log\\' . $drive;
        self::$class = new $class();
    }

    /**
     * @param $name
     * @param $file
     */
    static public function log($name, $file = 'log')
    {
        self::$class->log($name, $file);
    }
}
