<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
	'modules' => [
	    'user' => [
	        'class' => 'niksko12\user\Module',
            'enableUnconfirmedLogin' => true,
            'enableFlashMessages'=> false,
            'admins' => [],
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
        'file' => [
            'class' => 'file\FileModule',
            'webDir' => 'files',
            'tempPath' => '@common/uploads/temp',
            'storePath' => '@common/uploads/store',
            'rules' => [
                'maxFiles' => 2,
                'maxSize' => 1024 * 1024 * 2 // 2 MB
            ],
        ],
	],
	'timeZone' => 'Asia/Manila',
];
