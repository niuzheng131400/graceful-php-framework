<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/26
 * Time: 17:41
 */
return [
    'default' => [
        'ctrl' => 'default',//默认控制器
        'decorator' => [
//            'app\decorator\login',
//            'app\decorator\template',
//            'app\decorator\json',
        ]
    ],
    'action' => 'index',//默认访问方法
    'dir' => ['ctrl', 'model', 'views', 'configs', 'common'],//默认创建的目录和文件
    'log' => [
        'drive' => 'file',
        'option' => [
            'path' => MY_FRAME.'/runtime/log/',
        ]
    ]
];