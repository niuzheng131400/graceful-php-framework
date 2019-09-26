<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/10
 * Time: 15:05
 * -----------
 * 日志文件驱动类
 */

namespace core\lib\drive\log;

use core\myFrame;

class file
{
    //日志存储路径
    public $path;

    /**
     * file constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $logConfig = myFrame::getInstance()->config['main']['log'];
        $this->path = $logConfig['option']['path'];
    }

    /**
     * @param $message
     * @param string $file
     * -----------
     * 1、确定文件存储是否存在
     *   不存在->新建目录
     * 2、写入日志
     *
     * @return bool|int
     */
    public function log($message, $file = 'log')
    {
        $dir = $this->path . date('YmdH');
        if (!is_dir($dir)) {
           /* $old =umask(0);
            mkdir($dir,0777);
            umask($old);*/
            mkdir($dir, 0777, true);
            chmod($dir,0777);
        }
        $fileName = $dir . '/' . $file . '.php';
        return file_put_contents($fileName, date('Y-m-d H:i:s') . '---' . json_encode($message) . PHP_EOL, FILE_APPEND);
    }
}