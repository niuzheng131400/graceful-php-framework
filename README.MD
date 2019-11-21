### Framework
- Simple PHP Framework
#### Requirements
  - PHP > 7.0.0
#### 版本
- 1.3.0.0
    - 添加PHP Console工具
    - 优化自动加载类
    - 修改日志类报错
- 1.2.0.0
    - 加入SeasLog 日志驱动类
    - 优化框架脚手架
    - 加入ArrayAccess调用配置文件加载
    - 加入注册树类
- 1.0.0.0
    - 框架的基础文件
    - 入口
    - 路由解析
    - 控制器、模型、视图调用
#### Frame Structure
    .
    ├── README.MD
    ├── app
    │   ├── configs
    │   ├── controllers
    │   ├── decorator
    │   ├── models
    │   └── views
    ├── composer.json
    ├── composer.lock
    ├── core
    │   ├── Framework.php
    │   ├── common
    │   ├── configs
    │   └── lib
    ├── runtime
    │   ├── log
    │   └── twig
    ├── vendor
    └── web
        ├── index.php
        ├── robots.txt
        └── static
- 说明
  - 为什么要开发自己的框架？
      - 为了达到更快的开发效率。
      - 为了更高的运行效率。
      - 为了更好地理解各种框架的底层。
- 框架运行流程
  - 入口文件 -> 定义常量 -> 引入函数库 -> 自动加载类 -> 启动框架 -> 路由解析 -> 加载控制器 -> 返回结果。
- Install via git over https:
```bash
    git clone https://github.com/niuzheng131400/My-Frame.git
```
- 日志配置main.php
  - 存储到文件
```php  
      'log' => [
              'drive' => 'file',//文件存储
              'option' => [
                  'path' => MY_FRAME . '/runtime/log/',//默认存储路径
              ]
          ]
```      
  - 使用SeasLog类
```php  
        'log' => [
                'drive' => 'file',//文件存储
                'option' => [
                    'path' => MY_FRAME . '/runtime/log/',默认存储路径
                    'module' => 'SeasLog'
                ]
            ]
```
  - 存储到Mysql(需要自行完善Mysql驱动类)
```php  
      'log' => [
              'drive' => 'Mysql',//文件存储
              'option' => [
                  
              ]
          ]
```
- 数据库配置db.php 
```php
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
```
- PHP Console工具
  - 配置main.php
```php
        'chromeConsole' => true
```
  - 调用  
```php
        Framework::$app->console('test', ['a' => 1]);
```  
    
