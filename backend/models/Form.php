<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cms_form".
 *
 * @property int $id
 * @property int $category_id
 * @property string $description
 * @property int $status_id
 * @property int $year_id
 * @property int $field_id
 * @property int $user_id
 * @property int $user_update_id
 * @property string $date_created
 * @property string $date_updated
 *
 * @property CmsField $field
 * @property CmsCategory $category
 * @property CmsStatus $status
 * @property CmsYear $year
 * @property User $user
 * @property User $userUpdate
 * @property CmsPost[] $cmsPosts
 */
class Form extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_form';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'description', 'status_id', 'year_id', 'field_id', 'user_id', 'user_update_id', 'date_updated'], 'required'],
            [['id', 'category_id', 'status_id', 'year_id', 'field_id', 'user_id', 'user_update_id'], 'integer'],
            [['date_created', 'date_updated'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['field_id'], 'exist', 'skipOnError' => true, 'targetClass' => Field::className(), 'targetAttribute' => ['field_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['year_id'], 'exist', 'skipOnError' => true, 'targetClass' => Year::className(), 'targetAttribute' => ['year_id' => 'id']],
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
            'category_id' => 'Category ID',
            'description' => 'Description',
            'status_id' => 'Status ID',
            'year_id' => 'Year ID',
            'field_id' => 'Field ID',
            'user_id' => 'User ID',
            'user_update_id' => 'User Update ID',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }

    /**
     * Gets query for [[Field]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getField()
    {
        return $this->hasOne(Field::className(), ['id' => 'field_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
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
     * Gets query for [[Year]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getYear()
    {
        return $this->hasOne(Year::className(), ['id' => 'year_id']);
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
        return $this->hasMany(Post::className(), ['forms_id' => 'id']);
    }
}
