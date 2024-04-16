<?php
namespace common\helpers;

use Yii;
use backend\models\DilgInfoSystems;
use backend\models\AttachedAgency;
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
        $info = AttachedAgency::find()->all();
        return $info;
    }

}