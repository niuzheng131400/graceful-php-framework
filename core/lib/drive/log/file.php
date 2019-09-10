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

use core\lib\conf;

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
        $conf = conf::get('OPTION', 'log');
        $this->path = $conf['PATH'];
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
            mkdir($dir, '0777', true);
        }
        return file_put_contents($dir . '/' . $file . '.php', date('Y-m-d H:i:s') . '---' . json_encode($message) . PHP_EOL, FILE_APPEND);
    }
}