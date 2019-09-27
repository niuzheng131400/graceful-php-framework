<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/27
 * Time: 12:53
 */

namespace core\lib\db;

use core\lib\Factory;

class Proxy
{
    /**
     * @param $sql
     * @return array|Mysqli|Proxy|null
     */
    public function query($sql)
    {
        if (substr($sql, 0, 6) == 'select') {
            return Factory::getDb('slave')->query($sql);
        } else {
            return Factory::getDb('master')->query($sql);
        }
    }
}