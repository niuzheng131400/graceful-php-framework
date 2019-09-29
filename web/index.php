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
define('MY_FRAME', realpath('./../'));
define('CORE', MY_FRAME . '/core');
define('APP', MY_FRAME . '/app');
define('DEBUG', true);
require("../vendor/autoload.php");
require(CORE . '/common/function.php');
require(CORE . '/Framework.php');
spl_autoload_register('\core\Framework::load');
\core\lib\Build::init();
require(APP .'/configs/constants.php');
$config = array_merge(
    require(APP . "/configs/db.php"),
    require(APP . "/configs/main.php")
);
\core\Framework::getInstance($config)->run();