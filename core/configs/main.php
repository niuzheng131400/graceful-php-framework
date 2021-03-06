<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/26
 * Time: 17:41
 */

$config = [
    'default' => [
        'ctrl' => 'index',//默认控制器
        'decorator' => [
            'noUse' => ['login'],
            'list' => [
                'app\decorator\Login',
                'app\decorator\Template',
                'app\decorator\Json',
            ]
        ]
    ],
    'action' => 'index',//默认访问方法
    'log' => [
        'drive' => 'file',
        'option' => [
            'path' => MY_FRAME . '/runtime/log/',
            'file' => 'log',//默认文件名
        ]
    ],
    'chromeConsole' => false,
];

if (DEBUG) {
    //错误类展示美化
    $whoops = new \Whoops\Run;
    $errorTitle = "MY_Frame框架出错了!";
    $option = new \Whoops\Handler\PrettyPageHandler;
    $option->setPageTitle($errorTitle);
    $whoops->prependHandler($option);
    $whoops->register();
    ini_set('display_error', 'On');
    error_reporting(E_ALL);
} else {
    ini_set('display_error', 'Off');
}
return $config;