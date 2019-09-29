<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/29
 * Time: 10:25
 */

namespace core\lib\drive\log;

class SeasLog
{
    /**
     * SeasLog constructor.
     * @param $option
     */
    public function __construct($option)
    {
        $path = isset($option['path']) ? $option['path'] : MY_FRAME . '/runtime/log/';
        $module = isset($option['module']) ? $option['module'] : 'SeaLog';
        \SeasLog::setBasePath($path);
        \SeasLog::setLogger($module);

    }

    /**
     * @param $message
     * @param string $lever
     */
    public function log($message, $lever = "INFO")
    {
        \SeasLog::log($lever, $message);
    }
}