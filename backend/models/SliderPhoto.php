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
 * @property int $user_update_id
 * @property string $date_created
 * @property string $date_updated
 * 
 * @property Status $status
 * @property User $user
 * @property User $userUpdate
 */
class SliderPhoto extends \niksko12\auditlogs\classes\ModelAudit
{
    public $photo_attach=[];

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
            [['caption', 'status_id'], 'required'],
            [['status_id', 'upload_photo'], 'integer'],
            [['date_created', 'date_updated', 'user_id', 'user_update_id', 'url'], 'safe'],
            [['caption', 'url'], 'string', 'max' => 255],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['user_update_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_update_id' => 'id']],
            [['photo_attach'], 'file', 'skipOnError' => true, 'extensions' => 'jpg, jpeg, png, pdf']
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
            'status_id' => 'Status',
            //'upload_photo' => 'Upload Photo',
            'photo_attach' => 'Upload Photo',
            'url' => 'Url',
            'user_id' => 'Encoded By',
            'user_update_id' => 'Updated By',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
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
