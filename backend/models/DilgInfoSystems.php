<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cms_dilg_info_systems".
 *
 * @property int $id
 * @property string $label
 * @property int $order
 * @property int $status_id
 * @property int $logo
 * @property string $link
 * @property int $user_id
 * @property int $user_update_id
 * @property string $date_created
 * @property string $date_updated
 * 
 * @property Status $status
 * @property User $user
 * @property User $userUpdate
 */
class DilgInfoSystems extends \niksko12\auditlogs\classes\ModelAudit
{
    public $logo_attach=[];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_dilg_info_systems';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['label', 'order', 'status_id', 'link'], 'required'],
            [['order', 'status_id', 'logo'], 'integer'],
            [['date_created', 'date_updated', 'user_id', 'user_update_id'], 'safe'],
            [['label', 'link'], 'string', 'max' => 255],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['user_update_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_update_id' => 'id']],
            [['logo_attach'], 'file', 'skipOnError' => true, 'extensions' => 'jpg, jpeg, png, pdf']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Label',
            'order' => 'Order',
            'status_id' => 'Status',
            //'logo' => 'Logo',
            'logo_attach' => 'Logo',
            'link' => 'URL',
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
