<?php
return [
    'name' => 'Yiinstagram.saviv.site',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'emailService' => [
            'class' => 'common\components\EmailService'
        ],
        'storage' => [
            'class' => 'common\components\Storage',
        ],
    ],
];
