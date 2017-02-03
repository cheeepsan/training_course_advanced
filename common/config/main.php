<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            //'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		//'request' => [
        //    // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        //    'cookieValidationKey' => 'YQqFxwtnf2zoIRLNBPAEE6lsykOKHSn5',
        //],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            //'identityClass' => 'common\models\user\Users',
            'identityClass' => 'yii\web\User',
            'class' => 'yii\web\User',
            'enableAutoLogin' => true,
        ],

    ],
	'modules' => [
       'gridview' =>  [
            'class' => '\kartik\grid\Module'

        ]
    ],

];
