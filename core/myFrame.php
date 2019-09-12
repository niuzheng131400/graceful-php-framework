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

class myFrame
{
    static public $classMap = [];
    public $assign;

    /**
     * 启动框架入口方法
     *
     * @throws \Exception
     */
    static public function run()
    {
        try {
            //TODO　加载用户自定义配置
            session_start();//开启session
            date_default_timezone_set("PRC");//设置时区
            \core\lib\log::init();//初始化日志
            \core\lib\constant::init();//引入常量
            $route = new \core\lib\route();
            $ctrlClass = $route->ctrl;
            $action = $route->action;
            $ctrFile = APP . DIRECTORY_SEPARATOR . 'ctrl' . DIRECTORY_SEPARATOR . $ctrlClass . 'Ctrl.php';
            $cltrClass = "\\" . MODULE . "\ctrl\\" . $ctrlClass . 'Ctrl';
            if (is_file($ctrFile)) {
                include $ctrFile;
                $ctrl = new $cltrClass();
                $ctrl->$action();
                \core\lib\log::log('ctrl:' . $ctrlClass . '   ' . 'action:' . $action);
            } else {
                throw new \Exception('not found controller' . $ctrlClass);
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
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
            $file = MY_FRAME . DIRECTORY_SEPARATOR . $class . '.php';
            if (is_file($file)) {
                include $file;
                self::$classMap[$class] = $class;
            } else {
                return false;
            }
        }
    }

    /**
     *
     * @param $name
     * @param $value
     */
    public function assign($name, $value)
    {
        $this->assign[$name] = $value;
    }

    /**
     * 加载视图、分配变量
     *
     * @param $file
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function display($file)
    {
        $name = $file;
        $file = APP . '/views/' . $file;
        if (is_file($file)) {
//            extract($this->assign);
//            include $file;
            require_once MY_FRAME .DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
            $loader = new \Twig\Loader\FilesystemLoader(APP . '/views');
            $twig = new \Twig\Environment($loader, [
                'cache' => MY_FRAME . '/runtime/twig',
                'debug' => DEBUG,
            ]);
            $template = $twig->load($name);
            $template->display($this->assign ? $this->assign : []);
        }
    }
}






















