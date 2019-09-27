<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/25
 * Time: 13:26
 */

namespace core\lib;

class Register
{
    /**
     * @var
     */
    protected static $objects;

    /**
     * @param $alias
     * @param $object
     */
    static public function set($alias, $object)
    {
        self::$objects[$alias] = $object;
    }

    /**
     * @param $name
     * @return array
     */
    static public function get($name)
    {
        return isset(self::$objects[$name]) ? self::$objects[$name] : [];
    }

    /**
     * @param $alias
     */
    static public function _unset($alias)
    {
        unset(self::$objects[$alias]);
    }
}