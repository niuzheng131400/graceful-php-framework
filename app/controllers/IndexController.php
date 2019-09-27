<?php

namespace app\controllers;

use core\lib\Controller;

class IndexController extends Controller
{
    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $content = '<div class ="text-center"><h2>欢迎使用MyFrame╰(￣▽￣)╮</h2><span><a href="http://niuzheng.net" target="_blank">友儿の博客地址</a></span></div>';
        $this->assign('content', $content);
        $this->display('index');
    }
}