<?php
/**
 * Created by PhpStorm.
 * Author: Floating dust
 * Date: 2017-11-17
 * Time: 11:11
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class Personal extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'style/base.css',
        'style/global.css',
        'style/header.css',
        'style/home.css',
        'style/address.css',
        'style/bottomnav.css',
        'style/footer.css',
    ];
    public $js = [
        'js/header.js',
        'js/home.js',
        'js/address.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}