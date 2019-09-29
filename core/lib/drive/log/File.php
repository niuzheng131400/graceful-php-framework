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

class File
{
    //日志存储路径
    private $path;
    private $file;

    /**
     * File constructor.
     * @param $option
     */
    public function __construct($option)
    {
        $this->path = $option['path'];
        $this->file = isset($option['file']) ? $option['file'] : 'log';
    }

    /**
     * @param $message
     * -----------
     * 1、确定文件存储是否存在
     *   不存在->新建目录
     * 2、写入日志
     *
     * @return bool|int
     */
    public function log($message)
    {
        $dir = $this->path . date('YmdH');
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
            chmod($dir, 0777);
        }
        $fileName = $dir . '/' . $this->file . '.php';
        return file_put_contents($fileName, date('Y-m-d H:i:s') . '---' . json_encode($message) . PHP_EOL, FILE_APPEND);
    }
}