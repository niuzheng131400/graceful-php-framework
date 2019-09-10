<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/10
 * Time: 11:21
 * -----------
 * 路由文件
 */

namespace core\lib;

class route
{
    /**
     * 控制器
     * @var
     */
    public $ctrl;
    /**
     * 方法
     * @var
     */
    public $action;
    /**
     * 计数器
     */
    const COUNTER = 2;

    /**
     * route constructor.
     *
     * 1、隐藏index.php
     * 2、获取到URL 参数部分
     * 3、返回对应的控制器和方法
     * @throws \Exception
     */
    public function __construct()
    {
        if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {
            $path = $_SERVER['REQUEST_URI'];
            $pathArr = explode('/', trim($path, '/'));
            if (isset($pathArr[0])) {
                $this->ctrl = $pathArr[0];
                unset($pathArr[0]);
            }
            if (isset($pathArr[1])) {
                $this->action = $pathArr[1];
                unset($pathArr[1]);
            } else {
                $this->action = conf::get('ACTION','route');
            }
            $count = count($pathArr) + self::COUNTER;
            $i = self::COUNTER;
            while ($i < $count) {
                if (isset($pathArr[$i + 1])) {
                    $_GET[$pathArr[$i]] = $pathArr[$i + 1];
                }
                $i += self::COUNTER;
            }
        } else {
            $this->ctrl = conf::get('CTRL','route');
            $this->action = conf::get('ACTION','route');
        }
    }
}