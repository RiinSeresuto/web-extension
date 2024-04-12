<?php
namespace common\helpers;

use backend\models\WidgetSelect2Items;
use yii\helpers\ArrayHelper;

class Getter
{
    public static function getOptions($id)
    {
        return ArrayHelper::map(WidgetSelect2Items::find()->where(['field_id' => $id])->all(), 'value', 'label');
    }
}
