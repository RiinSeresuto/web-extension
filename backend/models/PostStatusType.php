<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cms_post_status_type".
 *
 * @property int $id
 * @property string $post_status_type
 *
 * @property CmsPost[] $cmsPosts
 */
class PostStatusType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_post_status_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'post_status_type'], 'required'],
            [['id'], 'integer'],
            [['post_status_type'], 'string', 'max' => 255],
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
            'post_status_type' => 'Post Status Type',
        ];
    }

    /**
     * Gets query for [[CmsPosts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsPosts()
    {
        return $this->hasMany(Post::className(), ['status_id' => 'id']);
    }
}
