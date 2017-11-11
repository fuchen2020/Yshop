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
        //rbac配置
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
    ],
    //配置语言包
    'language'=>'zh-CN',
    //访问默认控制器
    'defaultRoute'=>'brand/index',
];
