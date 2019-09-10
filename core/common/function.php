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
 * @param $val
 * @param bool $dump
 * @param bool $exit
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