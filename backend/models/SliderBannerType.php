<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cms_slider_banner_type".
 *
 * @property int $id
 * @property string $slider_banner_type
 */
class SliderBannerType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_slider_banner_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'slider_banner_type'], 'required'],
            [['id'], 'integer'],
            [['slider_banner_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slider_banner_type' => 'Slider Banner Type',
        ];
    }
}
