<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cms_form_field".
 *
 * @property int $id
 * @property int $form_id
 * @property int $field_id
 */
class FormField extends \niksko12\auditlogs\classes\ModelAudit
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_form_field';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['form_id', 'field_id'], 'required'],
            [['form_id', 'field_id'], 'integer'],
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
            'field_id' => 'Field ID',
        ];
    }

    public function getField()
    {
        return $this->hasOne(Field::className(), ['id' => 'field_id']);
    }

    public function getWidgetType ()
    {
        return $this->hasOne(WidgetType::className(), ['id' => 'field_id']);
    }
}
