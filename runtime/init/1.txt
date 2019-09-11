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

use app\model\exampleModel;
use core\myFrame;

class exampleCtrl extends myFrame
{
    /**
     * @throws \Exception
     */
    public function index()
    {
        //简单调用model操作数据库
        /*$model = new exampleModel();
        debug($model->getAll());
        dump($model->getOne(1003));
        $data = ['class' => 1, 'grade' => 2, 'score' => 98, 'username' => '王五1'];
        $ret = $model->add($data);
        dump($ret);
        //更新
        $ret = $model->setOne(1003, $data);
        dump($ret);*/
        $data = "example";
        $this->assign('data', $data);
        $this->display('example.php');
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function example()
    {
        $data = 'example1';
        $this->assign('data', $data);
        $this->display('example1.php');
    }
}