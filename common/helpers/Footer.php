<?php
namespace common\helpers;

use Yii;
use backend\models\DilgInfoSystems;
use backend\models\ConnectedAgencies;
use backend\models\File;
use yii\helpers\FileHelper;

class Footer
{
    public static function getInfoSystem()
    {
        $info = DilgInfoSystems::find()->all();	
        return $info;
    }

    public static function getAttachedAgencies()
    {
        $info = ConnectedAgencies::find()->all();	
        return $info;
    }

}