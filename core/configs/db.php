<?php

return [
    'master' => [
        'database_type' => 'mysql',
        'database_name' => 'test',
        'server' => 'localhost',
        'username' => 'root',
        'password' => '123456',
        'charset' => 'utf8',
    ],
    'slave' => [
        'slave1' => [
            'database_type' => 'mysql',
            'database_name' => 'test',
            'server' => 'localhost',
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
        ],
        'slave2' => [
            'database_type' => 'mysql',
            'database_name' => 'test',
            'server' => 'localhost',
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
        ]
    ]
];

