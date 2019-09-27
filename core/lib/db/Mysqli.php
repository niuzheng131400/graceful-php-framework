<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/25
 * Time: 13:35
 */

namespace core\lib\db;

use core\lib\IDb;

class Mysqli implements IDb
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
        $conn = mysqli_connect($host, $user, $passwd, $dbname);
        $this->conn = $conn;
    }

    /**
     * @param string $sql
     * @return bool|mixed|\mysqli_result
     */
    public function query($sql)
    {
        $res = mysqli_query($this->conn, $sql);
        return $res;
    }

    /**
     *
     * @return mixed|void
     */
    public function close()
    {
        mysqli_close($this->conn);
    }
}