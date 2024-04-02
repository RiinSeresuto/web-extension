<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cms_slider_banner".
 *
 * @property int $id
 * @property string $title
 * @property int $photo_upload
 * @property string $url
 * @property int $slider_banner_id
 * @property int $user_id
 * @property int $user_update_id
 * @property string $date_created
 * @property string $date_updated
 * 
 * @property SliderBannerType $sliderBannerType
 * @property User $user
 * @property User $userUpdate
 */
class SliderBanner extends \niksko12\auditlogs\classes\ModelAudit
{
    public $photo_upload=[];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_slider_banner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'photo_upload', 'slider_banner_id', 'user_id'], 'required'],
            [['slider_banner_id', 'user_id', 'user_update_id'], 'integer'],
            [['url', 'date_created', 'date_updated', 'user_update_id'], 'safe'],
            [['url', 'title'], 'string', 'max' => 255],
            [['photo_upload'], 'file', 'skipOnError' => true, 'extensions' => 'jpg, jpeg, png, pdf'],
            [['slider_banner_id'], 'exist', 'skipOnError' => true, 'targetClass' => SliderBannerType::className(), 'targetAttribute' => ['slider_banner_id' => 'id']],
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
            'title' => 'Title',
            'photo_upload' => 'File Attachment',
            'slider_banner_id' => 'Type',
            'url' => 'URL',
            'user_id' => 'Encoded By',
            'user_update_id' => 'Updated By',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }

    /**
     * Gets query for [[Slider Banner Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSliderBannerType()
    {
        return $this->hasOne(SliderBannerType::className(), ['id' => 'slider_banner_id']);
    }

    /**
     * Gets query for [[Photo Upload]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoUpload()
    {
        return $this->hasMany(File::className(), ['itemId' => 'id']);
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

    public function behaviors()
    {
        return [
            
            'fileBehavior' => [
                'class' => \attachment\behaviors\FileBehavior::className()
            ]
        
        ];
    }
}
