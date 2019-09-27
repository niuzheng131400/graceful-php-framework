<?php

namespace app\decorator;

class Json
{
    function beforeRequest($controller)
    {

    }

    function afterRequest($return_value)
    {
        if (isset($_GET['app']) && $_GET['app'] == 'json') {
            echo json_encode($return_value);
        }
    }
}