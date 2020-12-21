<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'language' => 'en-EN',
    'bootstrap' => [
        'log',
        [
            'class' => 'frontend\components\LanguageSelector',
        ],
    ],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'user' => [
            'class' => 'frontend\modules\user\Module',
        ],
        'post' => [
            'class' => 'frontend\modules\post\Module',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'enableCsrfValidation' => true,
        ],
        'user' => [
            'identityClass' => 'frontend\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'site/index',
                'news' => 'parser/parse',
                'news/<id:\d+>' => 'parser/view',
                'newsfeed' => 'site/newsfeed',
                'about' => 'site/about',
                'contact' => 'site/contact',
                'profile/<nickname:[\w\-]+>' => 'user/profile/view',
                'post/<id:\d+>' => 'post/default/view',
                'post/create' => 'post/default/create',
                'newsletter/unsubscribe/<id:\d+>' => 'newsletter/unsubscribe',
            ],
        ],
        'feedService' => [
            'class' => 'frontend\components\FeedService',
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                ],
            ],
        ],
        'stringHelper' => [
            'class' => 'common\components\StringHelper',
        ],
    ],
    'params' => $params,
    'aliases' => [
        '@images' => '/files/photos',
        '@site' => 'https://yiinstagram.saviv.site',
    ]
];
