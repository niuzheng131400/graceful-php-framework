<?php

namespace core\lib;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    protected $data;
    protected $controller_name;
    protected $view_name;
    protected $template_dir;
    protected $assign;

    public function __construct($controller_name, $view_name)
    {
        $this->controller_name = $controller_name;
        $this->view_name = $view_name;
        $this->template_dir = APP . '/views';
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
     * @param string $file
     * @param bool $twig
     * @throws
     */
    public function display($file = '', $twig = false)
    {
        $name = (empty($file) ? $this->view_name : $file) . '.php';
        $dir = strtolower($this->controller_name);
        $file = empty($file) ? $dir . '/' . $this->view_name . '.php' : $dir . '/' . $file . '.php';
        $path = $this->template_dir . '/' . $file;
        if (is_file($path)) {
            if ($twig) {
                $loader = new FilesystemLoader($this->template_dir . '/' . strtolower($this->controller_name));
                $twig = new Environment($loader, [
                    'cache' => MY_FRAME . '/runtime/twig',
                    'debug' => DEBUG,
                ]);
                $template = $twig->load($name);
                $template->display($this->assign ? $this->assign : []);
            } else {
                extract($this->assign ? $this->assign : []);
                include $path;
            }
        } else {
            new \Exception('Templates:'.$path.'not found');
        }
    }
}