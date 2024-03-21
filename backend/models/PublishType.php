<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cms_publish_type".
 *
 * @property int $id
 * @property string $publish_type
 *
 * @property CmsPost[] $cmsPosts
 */
class PublishType extends \niksko12\auditlogs\classes\ModelAudit
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_publish_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'publish_type'], 'required'],
            [['id'], 'integer'],
            [['publish_type'], 'string', 'max' => 255],
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
            'publish_type' => 'Publish Type',
        ];
    }

    /**
     * Gets query for [[CmsPosts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsPosts()
    {
        return $this->hasMany(Post::className(), ['publish_id' => 'id']);
    }
}
