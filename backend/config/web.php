<?php
$config = [
    'id' => 'my-app',
    'components' => [
  ]
];

Yii::$container->set('leandrogehlen\treegrid\TreeGridAsset',[
    'js' => [
        'js/jquery.cookie.js',
        'js/jquery.treegrid.min.js',
    ]
]);

return $config;