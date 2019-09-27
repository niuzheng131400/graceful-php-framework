<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/27
 * Time: 12:50
 */

namespace core\lib;

use core\lib\db\Mysqli;
use core\lib\db\Proxy;
use core\framework;

class Factory
{
    /**
     * @var null
     */
    static public $proxy = null;

    /**
     * @param string $id
     * @return array|Mysqli|Proxy|null
     */
    static public function getDb($id = 'proxy')
    {
        if (!in_array($id, ['proxy','slave','master'])) {
            return null;
        }
        if ($id == 'proxy') {
            if (!self::$proxy) {
                self::$proxy = new Proxy();
            }
            return self::$proxy;
        }
        if ($id == 'slave') {
            $slaves = framework::getInstance()->config['db'][$id];
            $dbConfig = $slaves[array_rand($slaves)];
        } else {
            $dbConfig = framework::getInstance()->config['db'][$id];
        }
        $key = 'database_' . $id;
        $db = Register::get($key);
        if (!$db) {
            $db = new Mysqli();
            $db->connect($dbConfig['server'], $dbConfig['username'], $dbConfig['password'], $dbConfig['database_name']);
            Register::set($key, $db);
        }
        return $db;
    }
}