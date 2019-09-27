<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/25
 * Time: 13:35
 */

namespace core\lib\db;

use core\lib\IDb;

class Mysql implements IDb
{
    /**
     * 数据库连接对象
     * @var
     */
    protected $conn;

    /**
     * 数据库连接
     *
     * @param string $host 链接地址
     * @param string $user 用户名
     * @param string $passwd 密码
     * @param string $dbname 数据库名
     * @return mixed
     */
    public function connect($host, $user, $passwd, $dbname)
    {
        $conn = mysql_connect($host, $user, $passwd);
        mysql_select_db($dbname, $conn);
        $this->conn = $conn;
    }

    /**
     * 执行sql
     * @param string $sql
     * @return mixed|resource
     */
    public function query($sql)
    {
        $res = mysql_query($sql, $this->conn);
        return $res;
    }

    /**
     * 关闭数据库
     *
     * @return mixed|void
     */
    public function close()
    {
        mysql_close($this->conn);
    }
}