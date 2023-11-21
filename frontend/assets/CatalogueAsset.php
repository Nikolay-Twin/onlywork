<?php
declare(strict_types=1);
namespace frontend\assets;

use yii\web\AssetBundle;

/**
 *
 */
class CatalogueAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/catalogue.css',
    ];
    public $js = [
        'js/nestedset.js',
        'js/catalogue.js',
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];

}
