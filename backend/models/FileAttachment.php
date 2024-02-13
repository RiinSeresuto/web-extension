<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cms_file_attachment".
 *
 * @property int $id
 * @property int $category_id
 * @property int $form_id
 * @property string $file_name
 * @property string $file_path
 * @property string $file_type
 * @property string $file_category
 * @property string $file_extension
 * @property int $sort
 * @property string $model
 * @property int $user_id
 * @property int $user_update_id
 * @property string $date_created
 * @property string $date_updated
 *
 * @property CmsCategory $category
 * @property CmsForm $form
 * @property User $user
 * @property User $userUpdate
 * @property CmsMenu[] $cmsMenus
 * @property CmsPages[] $cmsPages
 * @property CmsPages[] $cmsPages0
 */
class FileAttachment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_file_attachment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'form_id', 'file_name', 'file_path', 'file_type', 'file_category', 'file_extension', 'sort', 'model', 'user_id', 'user_update_id', 'date_updated'], 'required'],
            [['id', 'category_id', 'form_id', 'sort', 'user_id', 'user_update_id'], 'integer'],
            [['date_created', 'date_updated'], 'safe'],
            [['file_name', 'file_path', 'file_type', 'file_category', 'file_extension', 'model'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['form_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsForm::className(), 'targetAttribute' => ['form_id' => 'id']],
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
            'form_id' => 'Form ID',
            'file_name' => 'File Name',
            'file_path' => 'File Path',
            'file_type' => 'File Type',
            'file_category' => 'File Category',
            'file_extension' => 'File Extension',
            'sort' => 'Sort',
            'model' => 'Model',
            'user_id' => 'User ID',
            'user_update_id' => 'User Update ID',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(CmsCategory::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Form]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForm()
    {
        return $this->hasOne(CmsForm::className(), ['id' => 'form_id']);
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
     * Gets query for [[CmsMenus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsMenus()
    {
        return $this->hasMany(CmsMenu::className(), ['logo/file' => 'id']);
    }

    /**
     * Gets query for [[CmsPages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsPages()
    {
        return $this->hasMany(CmsPages::className(), ['slider_photo' => 'id']);
    }

    /**
     * Gets query for [[CmsPages0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsPages0()
    {
        return $this->hasMany(CmsPages::className(), ['file_attachment' => 'id']);
    }
}
