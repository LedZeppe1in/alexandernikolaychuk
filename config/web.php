<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'alexandernikolaychuk',
    'name' => 'Alexander Nikolaychuk',
    'defaultRoute' => 'client/default/index',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],

    // all site modules
    'modules' => [
        'client' => [
            'class' => 'app\modules\client\Module',
        ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'as access' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ],
        ]
    ],

    'components' => [
        'language' => 'ru-RU',
        'request' => [
            'class' => 'app\components\LangRequest',
            // site root directory
            'baseUrl' => '',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'avBgNUAB4sj6Y0YjpGoOcsQDlXLxnVtq',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'class' => 'app\components\LangUrlManager',
            'rules' => [
                'index' => 'client/default/index',
                'biography' => 'client/default/biography',
                'concerts' => 'client/default/concerts',
                'media' => 'client/default/media',
                'photo' => 'client/default/photo',
                '/photo-carousel/<id:\d+>' => 'client/default/photo-carousel/',
                'video' => 'client/default/video',
                'music' => 'client/default/music',
                '/music-view/<id:\d+>' => 'client/default/music-view/',
                'projects' => 'client/default/projects',
                'repertoire' => 'client/default/repertoire',
                'contacts' => 'client/default/contacts',
                'sing-in' => 'client/default/sing-in',
                '/user/<_u:(profile|biography|update-profile|update-biography|update-password)>' => 'admin/user/<_u>',
                '/photo/<_ph:(list|create)>' => 'admin/photo/<_ph>',
                '/photo/<_ph:(view|update|delete)>/<id:\d+>' => 'admin/photo/<_ph>',
                '/video/<_vd:(list|create)>' => 'admin/video/<_vd>',
                '/video/<_vd:(view|update|delete)>/<id:\d+>' => 'admin/video/<_vd>',
                '/concert/<_cn:(list|create)>' => 'admin/concert/<_cn>',
                '/concert/<_cn:(view|update|delete)>/<id:\d+>' => 'admin/concert/<_cn>',
                '/music-album/<_ma:(list|create)>' => 'admin/music-album/<_ma>',
                '/music-album/<_ma:(view|update|delete)>/<id:\d+>' => 'admin/music-album/<_ma>',
                '/project/<_pj:(list|create)>' => 'admin/project/<_pj>',
                '/project/<_pj:(view|update|delete)>/<id:\d+>' => 'admin/project/<_pj>',
                '/repertoire/<_rp:(list|create)>' => 'admin/repertoire/<_rp>',
                '/repertoire/<_rp:(view|update|delete)>/<id:\d+>' => 'admin/repertoire/<_rp>',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\admin\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['client/default/sing-in'],
        ],
        'errorHandler' => [
            'errorAction' => 'client/default/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
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
        'db' => $db,
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'forceTranslation' => true,
                    'sourceLanguage' => 'en-US',
                ],
            ],
        ],
        'formatter' => [
            'datetimeFormat' => 'dd.MM.Y HH:mm',
            'timeZone' => 'UTC',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
