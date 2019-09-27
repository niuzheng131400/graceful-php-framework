<?php

namespace app\decorator;

class Login
{
    function beforeRequest($controller)
    {
        session_start();
        if (empty($_SESSION['isLogin'])) {
            header('Location: /login/index/');
            exit;
        }
    }

    function afterRequest($return_value)
    {

    }
}