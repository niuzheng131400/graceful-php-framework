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
use http\Env\Request;
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
                $class = '\\app\\controllers\\' . ucwords($ctrl) . 'Controller';
                if (class_exists($class)) {
                    unset($pathArr[0]);
                }
            }
            if (isset($pathArr[1])) {
                $action = $pathArr[1];
                if (class_exists($class)) {
                    unset($pathArr[1]);
                }
            } else {
                $action = $this->config['main']['action'];
            }
            $count = count($pathArr) + COUNTER;
            $i = class_exists($class) ? COUNTER : 0;
            $_GET = [];
            while ($i < $count) {
                if (isset($pathArr[$i + 1])) {
                    $_GET[$pathArr[$i]] = $pathArr[$i + 1];
                }
                $i += COUNTER;
            }
        }
        $ctrlLow = strtolower($ctrl);
        $class = '\\app\\controllers\\' . ucwords($ctrl) . 'Controller';
        //TODO 优化访问的控制器类或者方法不存在时,路由问题以及默认路由
        if (!class_exists($class)) {
            $ctrl = $this->config['main']['default']['ctrl'];
            $action = $this->config['main']['action'];
            $class = '\\app\\controllers\\' . ucwords($ctrl) . 'Controller';
            $obj = new $class($ctrl, $action);
        } else {
            $obj = new $class($ctrl, $action);
        }
        $ctrlConfig = $this->config['main'];
        $decorators = [];
        //TODO 优化可以自定义某些控制器类的某些方法
        if (!empty($ctrlConfig['default']['decorator']['list']) &&
            !in_array($ctrlLow, $ctrlConfig['default']['decorator']['noUse'])
        ) {
            $conf_decorator = $ctrlConfig['default']['decorator']['list'];
            foreach ($conf_decorator as $dec) {
                $decorators[] = new $dec;
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