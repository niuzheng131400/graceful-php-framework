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
//            'app\decorator\login',
            'app\decorator\template',
            'app\decorator\json',
        ]
    ],
    'action' => 'index',//默认访问方法
    'log' => [
        'drive' => 'file',
        'option' => [
            'path' => MY_FRAME . '/runtime/log/',
            'file' => 'log',//默认文件名
        ]
    ]
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
} else {
    ini_set('display_error', 'Off');
}

return $config;