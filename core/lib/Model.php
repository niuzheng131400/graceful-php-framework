<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/10
 * Time: 13:34
 * -----------
 * mysql 操作类 Medoo https://medoo.lvtao.net/1.2/doc.php
 *
 */

namespace core\lib;

use core\Framework;
use Medoo\Medoo;

class Model extends Medoo
{
    /**
     * model constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $database = Framework::getInstance()->config['db']['master'];
        parent::__construct($database);
    }

    public function where()
    {
        return $this;
    }

    public function andWhere()
    {
        return $this;
    }

    public function groupBy()
    {
        return $this;
    }

    public function limit()
    {
        return $this;
    }
}