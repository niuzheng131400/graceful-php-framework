<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/10
 * Time: 11:15
 * -----------
 * 框架基础类
 */

namespace core;

use core\lib\Build;
use core\lib\Config;
use core\lib\log;

class Framework
{
    const COUNTER = 2;
    static public $classMap = [];
    public $config;
    protected static $instance;

    /**
     * Framework constructor.
     * @param $config
     */
    private function __construct($config)
    {
        $this->config = new Config(CORE . '/configs', $config);
    }

    /**
     * 单例
     * @param $config
     * @return Framework
     */
    static public function getInstance($config = [])
    {
        if (empty(self::$instance)) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    /**
     * run运行
     */
    public function run()
    {
        self::init();
        $this->dispatch();
    }

    /**
     * init
     */
    static private function init()
    {
        session_start();
        date_default_timezone_set("PRC");
        log::init();
    }
    /**
     * 自动加载类方法
     * @param $class
     *
     * @return bool
     */
    static public function load($class)
    {
        $class = str_replace('\\', '/', $class);
        if (isset($classMap[$class])) {
            return true;
        } else {
            $file = MY_FRAME . '/' . $class . '.php';
            if (is_file($file)) {
                include $file;
                self::$classMap[$class] = $class;
            } else {
                return false;
            }
        }
    }

    /**
     * 启动框架入口方法
     */
    private function dispatch()
    {
        $ctrl = $this->config['main']['default']['ctrl'];
        $action = $this->config['main']['action'];
        if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {
            $uri = $_SERVER['REQUEST_URI'];
            $pathArr = explode('/', trim($uri, '/'));
            if (isset($pathArr[0])) {
                $ctrl = $pathArr[0];
                unset($pathArr[0]);
            }
            if (isset($pathArr[1])) {
                $action = $pathArr[1];
                unset($pathArr[1]);
            } else {
                $action = $this->config['main']['action'];
            }
            $count = count($pathArr) + self::COUNTER;
            $i = self::COUNTER;
            $_GET = [];
            while ($i < $count) {
                if (isset($pathArr[$i + 1])) {
                    $_GET[$pathArr[$i]] = $pathArr[$i + 1];
                }
                $i += self::COUNTER;
            }
        }
        $ctrlLow = strtolower($ctrl);
        $class = '\\app\\controllers\\' . $ctrl . 'Controller';
        $obj = new $class($ctrl, $action);
        $ctrlConfig = $this->config['main'];
        $decorators = [];
        if (isset($ctrlConfig[$ctrlLow]['decorator'])) {
            $conf_decorator = $ctrlConfig[$ctrlLow]['decorator'];
            foreach ($conf_decorator as $class) {
                $decorators[] = new $class;
            }
        }
        foreach ($decorators as $decorator) {
            $decorator->beforeRequest($obj);
        }
        $return_value = $obj->$action();
        foreach ($decorators as $decorator) {
            $decorator->afterRequest($return_value);
        }
        log::log('Controller:' . $ctrl . 'Controller   ' . 'Action:' . $action);
    }
}






















