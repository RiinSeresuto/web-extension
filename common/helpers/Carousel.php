<?php

namespace common\helpers;

use Yii;
use backend\models\SliderPhoto;

class Carousel
{
    public static function getPhoto()
    {
        return SliderPhoto::find()->all();
    }
}
?>