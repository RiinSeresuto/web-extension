<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cms_slider_photo".
 *
 * @property int $id
 * @property string $caption
 * @property int $status_id
 * @property int $upload_photo
 * @property string $url
 * @property int $user_id
 * @property int|null $user_update_id
 * @property string $date_created
 * @property string|null $date_updated
 */
class SliderPhoto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_slider_photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['caption', 'status_id', 'upload_photo', 'url', 'user_id'], 'required'],
            [['status_id', 'upload_photo', 'user_id', 'user_update_id'], 'integer'],
            [['date_created', 'date_updated'], 'safe'],
            [['caption', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'caption' => 'Caption',
            'status_id' => 'Status ID',
            'upload_photo' => 'Upload Photo',
            'url' => 'Url',
            'user_id' => 'User ID',
            'user_update_id' => 'User Update ID',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }
}
