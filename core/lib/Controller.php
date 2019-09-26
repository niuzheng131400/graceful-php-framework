<?php
namespace core\lib;

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
        $this->template_dir = APP.'/views';
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
    public function display($file = '')
    {
        $name = (empty($file) ? $this->view_name : $file).'.php';
        $dir = strtolower($this->controller_name);
        $file = empty($file) ?  $dir.'/'.$this->view_name.'.php' : $dir.'/'.$file.'.php';
        $path = $this->template_dir.'/'.$file;
        if (is_file($path)) {
//            extract($this->assign);
//            include $file;
            require_once MY_FRAME .'/vendor/autoload.php';
            $loader = new \Twig\Loader\FilesystemLoader($this->template_dir.'/'.strtolower($this->controller_name));
            $twig = new \Twig\Environment($loader, [
                'cache' => MY_FRAME . '/runtime/twig',
                'debug' => DEBUG,
            ]);
            $template = $twig->load($name);
            $template->display($this->assign ? $this->assign : []);
        } else {
            new \Exception('');
        }
    }
}