### Framework
- Simple PHP Framework
#### Requirements
  - PHP > 7.0.0
#### 版本
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
- 完善中 ...
  
    
