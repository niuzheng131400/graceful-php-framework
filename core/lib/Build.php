<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/11
 * Time: 11:27
 */

namespace core\lib;

class Build
{
    /**
     * 创建项目脚手架
     */
    static public function init()
    {
        if (defined('APP')) {
            define('MODULE', substr(APP, -3, 3));
        } else {
            new \Exception('请定义项目目录');
        }
        //创建项目目录
        if (!createDir(APP)) {
            echo '<h2>' . APP . '项目创建失败！/(ㄒoㄒ)/~~</h2>';
            exit;
        }
        //获取目录配置项
        $build = ['controllers', 'models', 'views', 'configs', 'common', 'decorator'];
        //创建项目子目录
        foreach ($build as $dir) {
            $sonDir = APP . '/' . $dir;
            if (!createDir($sonDir, 0777)) {
                echo '<h2>' . $sonDir . '项目子目录创建失败！/(ㄒoㄒ)/~~</h2>';
                exit;
            }
            switch ($dir) {
                case 'controllers':
                    $file = APP . '/controllers/IndexController.php';
                    $content = <<<CONTROLLER
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
        \$content = '<div class ="text-center"><h2>欢迎使用MyFrame╰(￣▽￣)╮</h2><span><a href="http://niuzheng.net" target="_blank">友儿の博客地址</a></span></div>';
        \$this->assign('content', \$content);
        \$this->display('index');
    }
}
CONTROLLER;
                    break;
                case 'models':
                    $file = APP . '/models/User.php';
                    $content = <<<MOEDL
<?php

namespace app\models;

use core\lib\Model;

class User extends Model
{
    /**
     * @var string
     */
    public \$table = "user";

    /**
     * @return array|bool
     */
    public function getAll()
    {
        \$ret = \$this->select(\$this->table, '*');
        return \$ret;
    }

    /**
     * @param \$id
     * @return mixed
     */
    public function getOne(\$id)
    {
        \$ret = \$this->get(\$this->table, '*', ['id' => \$id]);
        return \$ret;
    }

    /**
     * @param \$data
     * @return bool|\PDOStatement
     */
    public function add(\$data)
    {
        \$ret = \$this->insert(\$this->table, \$data);
        return \$ret;
    }

    /**
     * @param \$id
     * @param \$data
     * @return bool|\PDOStatement
     */
    public function setOne(\$id, \$data)
    {
        \$ret = \$this->update(\$this->table, \$data, ['id' => \$id]);
        return \$ret;
    }

    /**
     * @param \$id
     * @return bool|\PDOStatement
     */
    public function delOne(\$id)
    {
        return \$this->delete(\$this->table, ['id' => \$id]);
    }
}
MOEDL;
                    break;
                case 'views':
                    if (!createDir($sonDir . '/index', 0777)) {
                        echo '<h2>' . $sonDir . '/index' . '项目子目录创建失败！/(ㄒoㄒ)/~~</h2>';
                        exit;
                    }
                    $file = APP . '/views/index/index.php';
                    $content = <<<INDEX
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to MyFrame</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .text-center {margin-top: 200px}
    </style>
</head>
<body>
<header class="text-center">让程序创造人生 ，让学习成为一种习惯。</header>
<?=\$content;?>
<footer class="text-center">联系邮箱：771036148#qq.com(#替换成@)</footer>
</body>
</html>
INDEX;
                    break;
                case 'configs':
                    $file = [
                        APP . '/configs/db.php' => [
                            <<<DB
<?php

return [
    'master' => [
        'database_type' => 'mysql',
        'database_name' => 'test',
        'server' => 'localhost',
        'username' => 'root',
        'password' => '123456',
        'charset' => 'utf8',
    ],
    'slave' => [
        'slave1' => [
            'database_type' => 'mysql',
            'database_name' => 'test',
            'server' => 'localhost',
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
        ],
        'slave2' => [
            'database_type' => 'mysql',
            'database_name' => 'test',
            'server' => 'localhost',
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
        ]
    ]
];
DB
                        ],
                        APP . '/configs/main.php' => [
                            <<<MAIN
<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/26
 * Time: 17:41
 */

\$config = [
    'default' => [
        'ctrl' => 'index',//默认控制器
        'decorator' => [
//            'app\decorator\login',
            'app\decorator\\template',
            'app\decorator\json',
        ]
    ],
    'action' => 'index',//默认访问方法
    'log' => [
        'drive' => 'file',
        'option' => [
            'path' => MY_FRAME . '/runtime/log/',
        ]
    ]
];

if (DEBUG) {
    //错误类展示美化
    \$whoops = new \Whoops\Run;
    \$errorTitle = "MY_Frame框架出错了!";
    \$option = new \Whoops\Handler\PrettyPageHandler;
    \$option->setPageTitle(\$errorTitle);
    \$whoops->prependHandler(\$option);
    \$whoops->register();
    ini_set('display_error', 'On');
} else {
    ini_set('display_error', 'Off');
}

return \$config;
MAIN
                        ]
                    ];
                    break;

                case 'decorator':
                    $file = [
                        APP . '/decorator/Json.php' => [
                            <<<JSON
<?php

namespace app\decorator;

class Json
{
    function beforeRequest(\$controller)
    {

    }

    function afterRequest(\$return_value)
    {
        if (isset(\$_GET['app']) && \$_GET['app'] == 'json') {
            echo json_encode(\$return_value);
        }
    }
}
JSON
                        ],
                        APP . '/decorator/Template.php' => [
                            <<<Template
<?php

namespace app\decorator;

class Template
{
    /**
     * @var \IMooc\Controller
     */
    protected \$controller;

    function beforeRequest(\$controller)
    {
        \$this->controller = \$controller;
    }

    function afterRequest(\$return_value)
    {
        if (isset(\$_GET['app']) && \$_GET['app'] == 'html') {
            foreach (\$return_value as \$k => \$v) {
                \$this->controller->assign(\$k, \$v);
            }
            \$this->controller->display();
        }
    }
}
Template
                        ],
                        APP . '/decorator/Login.php' => [
                            <<<Login
<?php

namespace app\decorator;

class Login
{
    function beforeRequest(\$controller)
    {
        session_start();
        if (empty(\$_SESSION['isLogin'])) {
            header('Location: /login/index/');
            exit;
        }
    }

    function afterRequest(\$return_value)
    {

    }
}
Login
                        ]

                    ];
            }
            if (is_array($file)) {
                foreach ($file as $d => $con) {
                    if (!file_exists($d)) {
                        if (!createFile($d, $con, 0777)) {
                            echo '<h2>' . $d . '默认文件创建失败！/(ㄒoㄒ)/~~</h2>';
                            exit;
                        }
                    }
                }
            } else {
                if (!file_exists($file)) {
                    if (!createFile($file, $content, 0777)) {
                        echo '<h2>' . $file . '默认类创建失败！/(ㄒoㄒ)/~~</h2>';
                        exit;
                    }
                }
            }
        }
    }
}
