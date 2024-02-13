<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cms_pages".
 *
 * @property int $id
 * @property int $menu_id
 * @property string $title
 * @property string $caption
 * @property string $body
 * @property int $url_type_id
 * @property int $status_id
 * @property int $type_id
 * @property string $link
 * @property int $slider_photo
 * @property int $file_attachment
 * @property int $user_id
 * @property int $user_update_id
 * @property string $date_created
 * @property string $date_updated
 *
 * @property CmsMenu $menu
 * @property CmsUrlType $urlType
 * @property CmsStatus $status
 * @property CmsType $type
 * @property CmsFileAttachment $sliderPhoto
 * @property CmsFileAttachment $fileAttachment
 * @property User $user
 * @property User $userUpdate
 * @property CmsPost[] $cmsPosts
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_pages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'menu_id', 'title', 'caption', 'body', 'url_type_id', 'status_id', 'type_id', 'link', 'slider_photo', 'file_attachment', 'user_id', 'user_update_id', 'date_updated'], 'required'],
            [['id', 'menu_id', 'url_type_id', 'status_id', 'type_id', 'slider_photo', 'file_attachment', 'user_id', 'user_update_id'], 'integer'],
            [['body'], 'string'],
            [['date_created', 'date_updated'], 'safe'],
            [['title', 'caption', 'link'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsMenu::className(), 'targetAttribute' => ['menu_id' => 'id']],
            [['url_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsUrlType::className(), 'targetAttribute' => ['url_type_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsType::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['slider_photo'], 'exist', 'skipOnError' => true, 'targetClass' => CmsFileAttachment::className(), 'targetAttribute' => ['slider_photo' => 'id']],
            [['file_attachment'], 'exist', 'skipOnError' => true, 'targetClass' => CmsFileAttachment::className(), 'targetAttribute' => ['file_attachment' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['user_update_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_update_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menu_id' => 'Menu ID',
            'title' => 'Title',
            'caption' => 'Caption',
            'body' => 'Body',
            'url_type_id' => 'Url Type ID',
            'status_id' => 'Status ID',
            'type_id' => 'Type ID',
            'link' => 'Link',
            'slider_photo' => 'Slider Photo',
            'file_attachment' => 'File Attachment',
            'user_id' => 'User ID',
            'user_update_id' => 'User Update ID',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }

    /**
     * Gets query for [[Menu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(CmsMenu::className(), ['id' => 'menu_id']);
    }

    /**
     * Gets query for [[UrlType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUrlType()
    {
        return $this->hasOne(CmsUrlType::className(), ['id' => 'url_type_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(CmsStatus::className(), ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(CmsType::className(), ['id' => 'type_id']);
    }

    /**
     * Gets query for [[SliderPhoto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSliderPhoto()
    {
        return $this->hasOne(CmsFileAttachment::className(), ['id' => 'slider_photo']);
    }

    /**
     * Gets query for [[FileAttachment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFileAttachment()
    {
        return $this->hasOne(CmsFileAttachment::className(), ['id' => 'file_attachment']);
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
     * Gets query for [[CmsPosts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsPosts()
    {
        return $this->hasMany(CmsPost::className(), ['page_id' => 'id']);
    }
}
