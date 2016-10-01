<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        
        'db' => ['class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=aolga_base',
            'username' => 'aolga_user',
            'password' => '0R3LQTHt',
            'charset' => 'utf8',
            ]
    ],
];
