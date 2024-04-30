<?php

namespace common\helpers;

use backend\models\DilgInfoSystems;
use Yii;
use backend\models\SliderPhoto;
use backend\models\Banner;

class Carousel
{
    public static function getPhoto()
    {
        return SliderPhoto::find()->where(['status_id' => 1])->all();
    }

    // public static function getBanner()
    // {
    //     $info = Banner::find()->all();
    //     return $info;
    // }

    public static function getBanner()
    {
        return Banner::find()->where(['status_id' => 1])->all();
    }

    public static function getInfoSystem()
    {
        return DilgInfoSystems::find()->where(['status_id' => 1])->all();
    }
}
?>