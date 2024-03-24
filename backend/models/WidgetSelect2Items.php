<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cms_widget_select2_items".
 *
 * @property int $id
 * @property int $form_id
 * @property string $value
 * @property string $label
 */
class WidgetSelect2Items extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_widget_select2_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['form_id', 'value', 'label'], 'required'],
            [['form_id'], 'integer'],
            [['value', 'label'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'form_id' => 'Form ID',
            'value' => 'Value',
            'label' => 'Label',
        ];
    }
}
