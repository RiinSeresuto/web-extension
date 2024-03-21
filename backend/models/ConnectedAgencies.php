<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cms_connected_agencies".
 *
 * @property int $id
 * @property int $agency_type_id
 * @property string $label
 * @property int $agency_order
 * @property int $status_id
 * @property int $logo
 * @property int $file_upload
 * @property string $link
 * @property int $user_id
 * @property int $user_update_id
 * @property string $date_created
 * @property string $date_updated
 *
 * @property AgencyType $agencyType
 * @property Status $status
 * @property User $user
 * @property User $userUpdate
 */
class ConnectedAgencies extends \niksko12\auditlogs\classes\ModelAudit
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_connected_agencies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['agency_type_id', 'label', 'agency_order', 'status_id'], 'required'],
            [['agency_type_id', 'agency_order', 'status_id'], 'integer'],
            [['date_created', 'date_updated', 'user_id', 'user_update_id', 'date_updated', 'file_upload', 'link'], 'safe'],
            [['label', 'link'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['agency_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AgencyType::className(), 'targetAttribute' => ['agency_type_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['user_update_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_update_id' => 'id']],
            [['file_upload'], 'file', 'skipOnError' => true, 'extensions' => 'jpg, jpeg, png, pdf']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'agency_type_id' => 'Agency Type',
            'label' => 'Label',
            'agency_order' => 'Agency Order',
            'status_id' => 'Status',
            'logo' => 'Logo Upload',
            'file_upload' => 'File Upload',
            'link' => 'Link',
            'user_id' => 'Encoded By',
            'user_update_id' => 'Updated By',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }

    /**
     * Gets query for [[AgencyType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAgencyType()
    {
        return $this->hasOne(AgencyType::className(), ['id' => 'agency_type_id']);
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

    public function getLogoFile()
    {
        return $this->hasMany(File::className(), ['itemId' => 'id']);
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
