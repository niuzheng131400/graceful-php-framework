<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/10
 * Time: 10:54
 * -------------
 * 入口文件
 *  1、定义常量
 *  2、加载函数库
 *  3、启动框架
 */

//定义根目录
define('MY_FRAME', realpath('./'));
//框架核心文件
define('CORE', MY_FRAME . '/core');
//项目文件
define('APP', MY_FRAME . '/app');
//定义软件目录名称
define('MODULE','app');

//第三方类库引入
include "vendor/autoload.php";

//调试模式
define('DEBUG', true);
//是否开启调试模式
if (DEBUG) {
    //错误类展示美化
    $whoops = new \Whoops\Run;
    $errorTitle = "MY_Frame框架出错了!";
    $option = new \Whoops\Handler\PrettyPageHandler;
    $option->setPageTitle($errorTitle);
    $whoops->prependHandler($option);
    $whoops->register();
    ini_set('display_error', 'On');
} else {
    ini_set('display_error', 'Off');
}
//优美的输出调试
//dump($_SERVER);
//加载函数库
include CORE.'/common/function.php';
//加载框架核心文件
include CORE.'/myFrame.php';
//自动加载类
spl_autoload_register('\core\myFrame::load');
//启动框架
\core\myFrame::run();