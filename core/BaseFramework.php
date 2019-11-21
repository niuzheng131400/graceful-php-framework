<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/11/21
 * Time: 14:00
 */

namespace core;

use core\lib\Config;
use core\lib\Log;
use PhpConsole\Handler;


/**
 * Get parameter (key = > value) cycle
 */
define('COUNTER', 2);

class BaseFramework
{
    /**
     * Auto load class mapping array
     *
     * @var array
     */
    static public $classMap = [];

    /**
     * Get configuration items
     * @var
     */
    public $config;

    /**
     * @var
     */
    public static $app;

    /**
     * case
     * @var
     */
    protected static $instance;

    /**
     * Get frame version number
     *
     * @return string
     */
    public static function getVersion()
    {
        return '1.2.0.0';
    }

    /**
     * Framework constructor.
     * @param $config
     */
    private function __construct($config)
    {
        self::$app = $this;
        $this->config = new Config(CORE . '/configs', $config);
    }

    /**
     * Single case
     *
     * @param array $config
     * @return BaseFramework
     */
    static public function getInstance($config = [])
    {
        if (empty(self::$instance)) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    /**
     * run framework
     */
    public function run()
    {
        self::init();
        $this->dispatch();
    }

    /**
     * This method is used to initialize frame parameters
     */
    static private function init()
    {
        session_start();
        date_default_timezone_set("PRC");
        Log::init();
    }

    /**
     * [phpConsole](https://github.com/barbushin/php-console#php-console-server-library)
     * [需要下载Chrome 插件](https://github.com/barbushin/php-console-extension)
     *
     * @param $key
     * @param $val
     * @throws
     */
    public function console($key = 'console', $val)
    {
        if (Framework::$app->config['main']['chromeConsole']) {
            $handler = Handler::getInstance();
            $handler->start();
            $handler->debug($val, $key);
        }
    }

    /**
     * run Framework method
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
            $count = count($pathArr) + COUNTER;
            $i = COUNTER;
            $_GET = [];
            while ($i < $count) {
                if (isset($pathArr[$i + 1])) {
                    $_GET[$pathArr[$i]] = $pathArr[$i + 1];
                }
                $i += COUNTER;
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
        Log::log('Controller:' . $ctrl . 'Controller   ' . 'Action:' . $action);
    }

    /**
     * 自动加载类方法
     * @param $className
     *
     * @return bool
     */
    static public function load($className)
    {
        if (isset(static::$classMap[$className])) {
            $classFile = static::$classMap[$className];
        } else {
            $classFile = MY_FRAME . '/' . str_replace('\\', '/', $className) . '.php';
            if (!is_file($classFile)) {
                return false;
            }
        }
        include $classFile;
    }
}