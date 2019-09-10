<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/10
 * Time: 17:13
 * -------------
 * 简单演示
 */

namespace app\model;

use core\lib\model;

class userModel extends model
{
    /**
     * @var string
     */
    public $table = "user";

    /**
     * @return array|bool
     */
    public function getAll()
    {
        $ret = $this->select($this->table, '*');
        return $ret;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getOne($id)
    {
        $ret = $this->get($this->table, '*', ['id' => $id]);
        return $ret;
    }

    /**
     * @param $data
     * @return bool|\PDOStatement
     */
    public function add($data)
    {
        $ret = $this->insert($this->table, $data);
        return $ret;
    }

    /**
     * @param $id
     * @param $data
     * @return bool|\PDOStatement
     */
    public function setOne($id, $data)
    {
        $ret = $this->update($this->table, $data, ['id' => $id]);
        return $ret;
    }

    /**
     * @param $id
     * @return bool|\PDOStatement
     */
    public function delOne($id)
    {
        return $this->delete($this->table, ['id' => $id]);
    }
}