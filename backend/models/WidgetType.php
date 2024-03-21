<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cms_widget_type".
 *
 * @property int $id
 * @property string $widget_type
 *
 * @property CmsField[] $cmsFields
 */
class WidgetType extends \niksko12\auditlogs\classes\ModelAudit
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_widget_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'widget_type'], 'required'],
            [['id'], 'integer'],
            [['widget_type'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'widget_type' => 'Widget Type',
        ];
    }

    /**
     * Gets query for [[CmsFields]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsFields()
    {
        return $this->hasMany(Field::className(), ['widget_type_id' => 'id']);
    }
}
