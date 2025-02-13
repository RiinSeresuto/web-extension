<?php

namespace backend\models;

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
 * @property Menu $menu
 * @property UrlType $urlType
 * @property Status $status
 * @property Type $type
 * @property FileAttachment $sliderPhoto
 * @property FileAttachment $fileAttachment
 * @property User $user
 * @property User $userUpdate
 * @property Post[] $cmsPosts
 */
class Pages extends \niksko12\auditlogs\classes\ModelAudit
{
    public $file_attach = [];
    //public $photo_attach=[];
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
            [['title', 'url_type_id', 'status_id', 'type_id'], 'required'],
            [['menu_id', 'url_type_id', 'status_id', 'type_id'], 'integer'],
            [['body'], 'string'],
            [['menu_id', 'date_created', 'date_updated', 'link', 'slider_photo', 'file_attachment', 'caption', 'body',], 'safe'],
            [['title', 'caption', 'link'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['menu_id' => 'id']],
            [['url_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => UrlType::className(), 'targetAttribute' => ['url_type_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']],
            //[['slider_photo'], 'exist', 'skipOnError' => true, 'targetClass' => FileAttachment::className(), 'targetAttribute' => ['slider_photo' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['user_update_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_update_id' => 'id']],
            [['file_attach'], 'file', 'skipOnError' => false, 'extensions' => 'jpg, jpeg, png, pdf']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menu_id' => 'Parent Menu',
            'title' => 'Title',
            'caption' => 'Caption',
            'body' => 'Body',
            'url_type_id' => 'Url Type',
            'status_id' => 'Status',
            'type_id' => 'Type',
            'link' => 'Link',
            //'slider_photo' => 'Slider Photo',
            'file_attach' => 'File Upload',
            'user_id' => 'Encoded By',
            'user_update_id' => 'Updated By',
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
        return $this->hasOne(Menu::className(), ['id' => 'menu_id']);
    }

    /**
     * Gets query for [[UrlType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUrlType()
    {
        return $this->hasOne(UrlType::className(), ['id' => 'url_type_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    /**
     * Gets query for [[FileAttachment]].
     *
     * @return \yii\db\ActiveQuery
     */
    // public function getFileAttachment()
    // {
    //     return $this->hasMany(File::className(), ['itemId' => 'id']);
    // }

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
        return $this->hasMany(Post::className(), ['page_id' => 'id']);
    }

    public function behaviors()
    {
        return [

            'fileBehavior' => [
                'class' => \attachment\behaviors\FileBehavior::className()
            ]

        ];
    }
}
