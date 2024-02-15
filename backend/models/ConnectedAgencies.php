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
 * @property string $link
 * @property int $user_id
 * @property int $user_update_id
 * @property string $date_created
 * @property string $date_updated
 *
 * @property CmsAgencyType $agencyType
 * @property CmsStatus $status
 * @property User $user
 * @property User $userUpdate
 */
class ConnectedAgencies extends \yii\db\ActiveRecord
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
            [['id', 'agency_type_id', 'label', 'agency_order', 'status_id', 'logo', 'link', 'user_id', 'user_update_id', 'date_updated'], 'required'],
            [['id', 'agency_type_id', 'agency_order', 'status_id', 'logo', 'user_id', 'user_update_id'], 'integer'],
            [['date_created', 'date_updated'], 'safe'],
            [['label', 'link'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['agency_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AgencyType::className(), 'targetAttribute' => ['agency_type_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
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
            'agency_type_id' => 'Agency Type ID',
            'label' => 'Label',
            'agency_order' => 'Agency Order',
            'status_id' => 'Status ID',
            'logo' => 'Logo',
            'link' => 'Link',
            'user_id' => 'User ID',
            'user_update_id' => 'User Update ID',
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
}
