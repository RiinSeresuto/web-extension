<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cms_url_type".
 *
 * @property int $id
 * @property string $url_type
 *
 * @property CmsPages[] $cmsPages
 */
class UrlType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_url_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'url_type'], 'required'],
            [['id'], 'integer'],
            [['url_type'], 'string', 'max' => 255],
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
            'url_type' => 'Url Type',
        ];
    }

    /**
     * Gets query for [[CmsPages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsPages()
    {
        return $this->hasMany(Pages::className(), ['url_type_id' => 'id']);
    }
}
