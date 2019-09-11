### MYFrame
- Simple PHP Framework
#### Requirements
  - PHP > 5.6.0
#### 版本
- 1.0.0.2
    - 引入bootstrap
    - 修复MacOS下自动加载路径问题。
    - 修改目录log->runtime
    - 添加./web、web/robots.txt、web/static、web/static/css、web/static/images、web/static/js
    - ./index.php移动到web/index.php、./.htaccess移动到web/.htaccess
- 1.0.0.1
    - 加入框架脚手架。
    - 删除项目案例app。
    - 更新1.0.0.0版本的实图加载默认问题。
- 1.0.0.0
    - 框架的基础文件
    - 入口
    - 路由解析
    - 控制器、模型、视图调用
#### Frame Structure
    .
    ├── README.MD
    ├── composer.json
    ├── composer.lock
    ├── core
    │   ├── common
    │   ├── config
    │   ├── lib
    │   └── myFrame.php
    ├── runtime
    ├── vendor
    └── web
        ├── index.php
        ├── robots.txt
        └── static
            ├── css
            ├── images
            └── js  
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
  
    
