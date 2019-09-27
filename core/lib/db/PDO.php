<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/25
 * Time: 13:35
 */

namespace core\lib\db;

use core\lib\IDb;

class PDO implements IDb
{
    /**
     * @var
     */
    protected $conn;

    /**
     * @param string $host
     * @param string $user
     * @param string $passwd
     * @param string $dbname
     * @return mixed|void
     */
    public function connect($host, $user, $passwd, $dbname)
    {
        $conn = new \PDO("mysql:host=$host;dbanme=$dbname", $user, $passwd);
        $this->conn = $conn;
    }

    /**
     * @param string $sql
     * @return mixed
     */
    public function query($sql)
    {
        $res = $this->conn->query($sql);
        return $res;
    }

    /**
     * @return mixed|void
     */
    public function close()
    {
        unset($this->conn);
    }
}