<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cms_post".
 *
 * @property int $id
 * @property int $forms_id
 * @property int $field_id
 * @property string $tags
 * @property int $status_id
 * @property int $visibility_id
 * @property int $publish_id
 * @property int $page_id
 * @property string $start_date_time
 * @property string $end_date_time
 * @property int $min_answer
 * @property int $max_answer
 * @property int $user_id
 * @property int $user_update_id
 * @property string $date_created
 * @property string $date_updated
 *
 * @property FileAttachment[] $cmsFileAttachments
 * @property Form $forms
 * @property Field $field
 * @property PostStatusType $status
 * @property VisibilityType $visibility
 * @property PublishType $publish
 * @property Pages $page
 * @property User $user
 * @property User $userUpdate
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'forms_id', 'field_id', 'tags', 'status_id', 'visibility_id', 'publish_id', 'page_id', 'start_date_time', 'end_date_time', 'min_answer', 'max_answer', 'user_id', 'user_update_id', 'date_updated'], 'required'],
            [['id', 'forms_id', 'field_id', 'status_id', 'visibility_id', 'publish_id', 'page_id', 'min_answer', 'max_answer', 'user_id', 'user_update_id'], 'integer'],
            [['start_date_time', 'end_date_time', 'date_created', 'date_updated'], 'safe'],
            [['tags'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['forms_id'], 'exist', 'skipOnError' => true, 'targetClass' => Form::className(), 'targetAttribute' => ['forms_id' => 'id']],
            [['field_id'], 'exist', 'skipOnError' => true, 'targetClass' => Field::className(), 'targetAttribute' => ['field_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => PostStatusType::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['visibility_id'], 'exist', 'skipOnError' => true, 'targetClass' => VisibilityType::className(), 'targetAttribute' => ['visibility_id' => 'id']],
            [['publish_id'], 'exist', 'skipOnError' => true, 'targetClass' => PublishType::className(), 'targetAttribute' => ['publish_id' => 'id']],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pages::className(), 'targetAttribute' => ['page_id' => 'id']],
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
            'forms_id' => 'Forms ID',
            'field_id' => 'Field ID',
            'tags' => 'Tags',
            'status_id' => 'Status ID',
            'visibility_id' => 'Visibility ID',
            'publish_id' => 'Publish ID',
            'page_id' => 'Page ID',
            'start_date_time' => 'Start Date Time',
            'end_date_time' => 'End Date Time',
            'min_answer' => 'Min Answer',
            'max_answer' => 'Max Answer',
            'user_id' => 'User ID',
            'user_update_id' => 'User Update ID',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }

    /**
     * Gets query for [[CmsFileAttachments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsFileAttachments()
    {
        return $this->hasMany(FileAttachment::className(), ['record_id' => 'id']);
    }

    /**
     * Gets query for [[Forms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForms()
    {
        return $this->hasOne(Form::className(), ['id' => 'forms_id']);
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
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(PostStatusType::className(), ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Visibility]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVisibility()
    {
        return $this->hasOne(VisibilityType::className(), ['id' => 'visibility_id']);
    }

    /**
     * Gets query for [[Publish]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublish()
    {
        return $this->hasOne(PublishType::className(), ['id' => 'publish_id']);
    }

    /**
     * Gets query for [[Page]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Pages::className(), ['id' => 'page_id']);
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
