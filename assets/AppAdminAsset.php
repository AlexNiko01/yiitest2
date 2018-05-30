<?php


namespace app\assets;


use yii\web\AssetBundle;

class AppAdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public $js = [

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yiister\adminlte\assets\Asset',
    ];
}