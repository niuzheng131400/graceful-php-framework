<?php

namespace app\ctrl;

use core\myFrame;

class defaultCtrl extends myFrame
{
	public function index()
	{
		$this->assign('data',[]);
	$this->display('default.php');
	}
}