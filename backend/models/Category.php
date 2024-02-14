<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cms_category".
 *
 * @property int $id
 * @property string $title
 * @property int $status_id
 * @property int $user_id
 * @property int $user_update_id
 * @property string $date_created
 * @property string $date_updated
 *
 * @property Status $status
 * @property User $user
 * @property User $userUpdate
 * @property Form[] $cmsForms
 * @property Year[] $cmsYears
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'title', 'status_id', 'user_id', 'user_update_id', 'date_updated'], 'required'],
            [['id', 'status_id', 'user_id', 'user_update_id'], 'integer'],
            [['date_created', 'date_updated'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['id'], 'unique'],
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
            'title' => 'Title',
            'status_id' => 'Status ID',
            'user_id' => 'User ID',
            'user_update_id' => 'User Update ID',
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

    /**
     * Gets query for [[CmsForms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsForms()
    {
        return $this->hasMany(Form::className(), ['category_id' => 'id']);
    }

    /**
     * Gets query for [[CmsYears]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsYears()
    {
        return $this->hasMany(Year::className(), ['category_id' => 'id']);
    }
}
