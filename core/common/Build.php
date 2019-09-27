<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/11
 * Time: 11:27
 */

namespace core\common;

use core\framework;

class Build
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
        $build = framework::getInstance()->config['main']['dir'];
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
    }
}
