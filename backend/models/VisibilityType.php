<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cms_visibility_type".
 *
 * @property int $id
 * @property string $visibility_type
 *
 * @property CmsPost[] $cmsPosts
 */
class VisibilityType extends \niksko12\auditlogs\classes\ModelAudit
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_visibility_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'visibility_type'], 'required'],
            [['id'], 'integer'],
            [['visibility_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'visibility_type' => 'Visibility Type',
        ];
    }

    /**
     * Gets query for [[CmsPosts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsPosts()
    {
        return $this->hasMany(Post::className(), ['visibility_id' => 'id']);
    }
}
