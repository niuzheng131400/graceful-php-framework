<?php

namespace app\ctrl;

use core\myFrame;

class defaultCtrl extends myFrame
{
	public function index()
	{
	$this->display('default.php');
	}
}