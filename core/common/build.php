<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/11
 * Time: 11:27
 */

namespace core\common;

use core\myFrame;

class build
{
    //项目目录
    const APPLICATION = MY_FRAME .'/'. MODULE;

    /**
     * build constructor.
     * @throws \Exception
     */
    static public function init()
    {
        //创建项目目录
        if (!createDir(self::APPLICATION)) {
            echo '<h2>' . self::APPLICATION . '项目创建失败！/(ㄒoㄒ)/~~</h2>';
            exit;
        }
        //获取目录配置项
        $build = myFrame::getInstance()->config['main']['dir'];
        //创建项目子目录
        foreach ($build as $dir) {
            $sonDir = self::APPLICATION .'/'. $dir;
            if (!createDir($sonDir, 0777)) {
                echo '<h2>' . $sonDir . '项目子目录创建失败！/(ㄒoㄒ)/~~</h2>';
                exit;
            }
            if ($dir == 'views') {
                $default = self::APPLICATION .'/views/default';
                if (!createDir($default, 0777)) {
                    echo '<h2>' . $default . '项目子目录创建失败！/(ㄒoㄒ)/~~</h2>';
                    exit;
                }
            }
        }
        //创建默认controller
        $ctrl = self::APPLICATION . '/ctrl/defaultCtrl.php';
        if (!file_exists($ctrl)) {
            $content = "<?php\r\n\r\nnamespace " . MODULE . "\ctrl;\r\n\r\nuse core\\lib\\Controller;\r\n\r\nclass defaultCtrl extends Controller\r\n" . "{\r\n" . "\tpublic function index()\r\n\t" . "{\r\n\t\$this->display('index');\r\n\t";
            $content .= "}\r\n" . "}";
            if (!createFile($ctrl, $content, 0777)) {
                echo '<h2>' . $ctrl . '默认控制器创建失败！/(ㄒoㄒ)/~~</h2>';
                exit;
            }
        }
        //创建默认model
        $model = self::APPLICATION .'/model/defaultModel.php';
        if (!file_exists($model)) {
            $mcontent = "<?php\r\n\r\nnamespace " . MODULE . "\model;\r\n\r\nuse core\lib\model;\r\n\r\nclass defaultModel extends model\r\n" . "{\r\n\r\n}";
            if (!createFile($model, $mcontent, 0777)) {
                echo '<h2>' . $model . '默认模型创建失败！/(ㄒoㄒ)/~~</h2>';
                exit;
            }
        }
        //创建项目默认配置文件
        $conf = self::APPLICATION .'/configs/config.php';
        if (!file_exists($conf)) {
            $fcontent = "<?php\r\nreturn [\r\n\r\n];";
            if (!createFile($conf, $fcontent, 0777)) {
                echo '<h2>配置文件创建失败！/(ㄒoㄒ)/~~</h2>';
                exit;
            }
        }
        self::createExample();
    }

    /**
     * 创建默认例子
     */
    static private function createExample()
    {
        $init = MY_FRAME . '/runtime/init/';
        $view = APP .'/views/default';
        $newFile = '';
        for ($i = 1; $i < 7; $i++) {
            $file = $init . $i . '.txt';
            switch ($i) {
                case 1:
                    $newFile = APP . '/ctrl/exampleCtrl.php';
                    break;
                case 2:
                    $newFile = APP .  '/model/exampleModel.php';
                    break;
                case 3:
                    $newFile = $view . '/example.php';
                    break;
                case 4:
                    $newFile = $view . '/example1.php';
                    break;
                case 5:
                    $newFile = $view . '/layout.php';
                    break;
                case 6:
                    $newFile = $view . '/index.php';
                    break;
            }
            if (file_exists($file)) {
                $content = file_get_contents($file);
                if (!file_exists($newFile) && $newFile != '') {
                    if (!createFile($newFile, $content, 0777)) {
                        $message = ['控制器', '模型', '视图', '视图', 'layout','视图'];
                        echo '<h2>' . $newFile . '默认案例' . $message[$i] . '创建失败！/(ㄒoㄒ)/~~</h2>';
                        exit;
                    }
                }
            }
        }
    }
}
