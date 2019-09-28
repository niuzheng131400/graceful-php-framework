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

