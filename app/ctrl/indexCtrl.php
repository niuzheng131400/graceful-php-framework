<?php
/**
 * Created by ZhengNiu.
 * User: admin
 * Date: 2019/9/10
 * Time: 13:07
 * -----------
 * 控制器
 */

namespace app\ctrl;

use app\model\userModel;
use core\lib\model;
use core\myFrame;

class indexCtrl extends myFrame
{
    /**
     * @throws \Exception
     */
    public function index()
    {
      /*
        //简单调用model操作数据库
        $model = new userModel();
        debug($model->getAll());
        dump($model->getOne(1003));
        $data = ['class' => 1, 'grade' => 2, 'score' => 98, 'username' => '王五1'];
        $ret = $model->add($data);
        //更新
        $ret = $model->setOne(1003, $data);
        dump($ret);
      */
        $data = "MY_Frame";
        $this->assign('data', $data);
        $this->display('index.html');
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function test()
    {
        $data = 'test';
        $this->assign('data', $data);
        $this->display('test.html');
    }
}