<?php

namespace common\helpers;

use Yii;
use backend\models\SliderPhoto;
use backend\models\Banner;

class Carousel
{
    public static function getPhoto()
    {
        return SliderPhoto::find()->all();
    }

    public static function getBanner()
    {
        $info = Banner::find()->all();
        return $info;
    }
}
?>