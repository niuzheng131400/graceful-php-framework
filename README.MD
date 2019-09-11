### MYFrame
- Simple PHP Framework
#### Requirements
  - PHP > 5.6.0
#### Frame Structure
    .
    ├── README.MD
    ├── app
    │   ├── ctrl
    │   │   └── indexCtrl.php
    │   ├── model
    │   │   └── userModel.php
    │   └── views
    │       ├── index.html
    │       ├── layout.html
    │       └── test.html
    ├── composer.json
    ├── composer.lock
    ├── core
    │   ├── common
    │   │   └── function.php
    │   ├── config
    │   │   ├── database.php
    │   │   ├── log.php
    │   │   └── route.php
    │   ├── lib
    │   │   ├── conf.php
    │   │   ├── drive
    │   │   ├── log.php
    │   │   ├── model.php
    │   │   └── route.php
    │   └── myFrame.php
    ├── index.php
    ├── log
    │   └── twig
    └── vendor  
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
- 完善中 ......
  
    