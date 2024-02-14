<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cms_data_type".
 *
 * @property int $id
 * @property string $data_type
 *
 * @property CmsField[] $cmsFields
 */
class DataType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_data_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'data_type'], 'required'],
            [['id'], 'integer'],
            [['data_type'], 'string', 'max' => 255],
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
            'data_type' => 'Data Type',
        ];
    }

    /**
     * Gets query for [[CmsFields]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsFields()
    {
        return $this->hasMany(CmsField::className(), ['data_type_id' => 'id']);
    }
}
