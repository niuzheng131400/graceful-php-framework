<?php
/**
 * Created by PhpStorm.
 * User: zhengniu
 * Date: 2019/9/12
 * Time: 11:45 PM
 * -----------
 * 加载框架常量
 */

namespace core\lib;


class constant
{
    /**
     * 加载常量文件
     */
    static public function init()
    {
        $file = CORE . DIRECTORY_SEPARATOR . 'common' . DIRECTORY_SEPARATOR . 'constant.php';
        if (file_exists($file)) {
            include $file;
        } else {
            return false;
        }
    }
}