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

use core\myFrame;
use Medoo\Medoo;

class model extends Medoo
{
    /**
     * model constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $database = myFrame::getInstance()->config['db']['master'];
        parent::__construct($database);
    }
}