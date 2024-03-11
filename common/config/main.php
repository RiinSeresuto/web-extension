<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@file' => dirname(__DIR__),
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'assetManager' => [
            'bundles' => [
                'kartik\form\ActiveFormAsset' => [
                    'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle
                ],
            ],
        ],
    ],
	'modules' => [
	    'user' => [
	        'class' => 'niksko12\user\Module',
            'enableUnconfirmedLogin' => true,
            'enableFlashMessages'=> false,
            'admins' => ['stsenin'],
	    ],
	    'rbac' => [
        	'class' => 'niksko12\rbac\Module',
            'enableFlashMessages'=> false,
    	],
		'auditlogs' => [
			'class' => 'niksko12\auditlogs\Module',
		],
        'utility' => [
            'class' => 'c006\utility\migration\Module',
        ],
        'wfh' => [
            'class' => 'common\modules\wfh\Module',
        ],	
        'attachment' => [
            'class' => 'attachment\Module',
            'webDir' => 'files',
            'tempPath' => '@common/uploads/temp',
            'storePath' => '@common/uploads/store',
            'rules' => [
                'maxFiles' => 2,
                'maxSize' => 1024 * 1024 * 20 // 20 MB
            ],
        ],
	],
	'timeZone' => 'Asia/Manila',
];
