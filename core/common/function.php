<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/10
 * Time: 11:08
 * ------------
 * 函数库
 */

/**
 * 调试错误断点
 *
 * @param int|string|object|array $val 要打印的数据源
 * @param bool $dump 是否用var_dump
 * @param bool $exit 是否终止
 */
function debug($val, $dump = false, $exit = true)
{
    if ($dump) {
        $func = 'var_dump';
    } else {
        $func = (is_array($val) || is_object($val)) ? 'print_r' : 'printf';
    }
    header('Content-type:text/html;charset=utf-8');
    echo '<pre>debug output:<hr />';
    $func($val);
    echo "</pre>";
    if ($exit) exit;
}

/**
 * 创建目录
 *
 * @param string $file 目录名称
 * @param int $mode 权限
 * @return bool
 */
function createDir($file, $mode = 0755)
{
    if (!is_dir($file)) {
        if (mkdir($file) && chmod($file, $mode)) {
            return true;
        }
        return false;
    }
    return true;
}

/**
 * 创建文件
 *
 * @param string $file 文件名称
 * @param string $content 内容
 * @param int $mode 权限
 * @return bool
 */
function createFile($file, $content = '', $mode = 0755)
{
    if (file_exists($file)) {
        if (empty($content)) {
            return true;
        }
        if (file_put_contents($file, $content) !== false) {
            return true;
        }
    } else {
        if (file_put_contents($file, $content) !== false && chmod($file, $mode)) {
            return true;
        }
    }
    return false;
}

//TODO get封装
function g()
{
    return $_GET;
}

//TODO post封装
function p()
{
    return $_POST;
}

/**
 * TODO 验证类型待完善
 * get && post 请求
 *
 * @param string $name 参数名
 * @param string $defaultValue 默认值
 * @param int $filter 是否验证类型
 * @return string
 */
function gp($name, $defaultValue = '', $filter = 0)
{
    $_GET = array_change_key_case($_GET, CASE_LOWER);
    $name = strtolower($name);
    $v = isset ($_GET [$name]) ? $_GET [$name] : '';
    if ($v == '') {
        $_POST = array_change_key_case($_POST, CASE_LOWER);
        $v = isset ($_POST [$name]) ? $_POST [$name] : '';
    }
    if ($v == '') {
        return $defaultValue;
    } else {
        if ($filter) {
            switch ($filter) {
                case IS_INI:
                    if (is_numeric($v)) {
                        return $v;
                    } else {
                        return $defaultValue;
                    }
                    break;
                case IS_STRING:
                    break;
                default:
                    break;
            }
        }
        return trim($v);
    }
}


