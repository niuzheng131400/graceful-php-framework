<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/27
 * Time: 12:56
 */

namespace core\lib;

interface IDb
{
    /**
     * 数据库连接
     *
     * @param string $host 链接地址
     * @param string $user 用户名
     * @param string $passwd 密码
     * @param string $dbname 数据库名
     * @return mixed
     */
    public function connect($host, $user, $passwd, $dbname);

    /**
     * 执行sql
     * @param string $sql sql语句
     * @return mixed
     */
    public function query($sql);

    /**
     * 关闭数据库
     *
     * @return mixed
     */
    public function close();
}