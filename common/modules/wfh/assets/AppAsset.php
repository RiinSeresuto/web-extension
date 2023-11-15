<?php

namespace common\modules\wfh\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@common/modules/wfh/web';
    public $css = [
		'css/extra_20200607.css',
    ];
    public $js = [
		'js/report.js',
		'js/task.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
		'yii\web\JqueryAsset',
    ];
}
