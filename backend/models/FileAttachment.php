<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cms_file_attachment".
 *
 * @property int $id
 * @property int $record_id
 * @property string $file_name
 * @property string $file_path
 * @property string $file_type
 * @property string $file_extension
 * @property string $model
 * @property int $user_id
 * @property int $user_update_id
 * @property string $date_created
 * @property string $date_updated
 *
 * @property User $user
 * @property User $userUpdate
 * @property CmsPost $record
 * @property CmsMenu[] $cmsMenus
 * @property CmsPages[] $cmsPages
 * @property CmsPages[] $cmsPages0
 */
class FileAttachment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_file_attachment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'record_id', 'file_name', 'file_path', 'file_type', 'file_extension', 'model', 'user_id', 'user_update_id', 'date_updated'], 'required'],
            [['id', 'record_id', 'user_id', 'user_update_id'], 'integer'],
            [['date_created', 'date_updated'], 'safe'],
            [['file_name', 'file_path', 'file_type', 'file_extension', 'model'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['user_update_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_update_id' => 'id']],
            [['record_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['record_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'record_id' => 'Record ID',
            'file_name' => 'File Name',
            'file_path' => 'File Path',
            'file_type' => 'File Type',
            'file_extension' => 'File Extension',
            'model' => 'Model',
            'user_id' => 'User ID',
            'user_update_id' => 'User Update ID',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[UserUpdate]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserUpdate()
    {
        return $this->hasOne(User::className(), ['id' => 'user_update_id']);
    }

    /**
     * Gets query for [[Record]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRecord()
    {
        return $this->hasOne(Post::className(), ['id' => 'record_id']);
    }

    /**
     * Gets query for [[CmsMenus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsMenus()
    {
        return $this->hasMany(Menu::className(), ['logo_file' => 'id']);
    }

    /**
     * Gets query for [[CmsPages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsPages()
    {
        return $this->hasMany(Pages::className(), ['slider_photo' => 'id']);
    }

    /**
     * Gets query for [[CmsPages0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsPages0()
    {
        return $this->hasMany(Pages::className(), ['file_attachment' => 'id']);
    }
}
