<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'DomainStatistic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'VX8wyPT8N1rNG6wPWkIZ8n3BOW8xjCfq',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'trace', 'info'],
                ],
            ],
       ],

        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (/*YII_ENV_DEV*/ True) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        "allowedIPs" => ['127.0.0.2', '::1', '83.243.70.247']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        "allowedIPs" => ['127.0.0.2', '::1', '83.243.70.247']
    ];
}

return $config;
