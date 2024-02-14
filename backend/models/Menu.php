<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cms_menu".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $label
 * @property int $menu_order
 * @property int $position_id
 * @property int $status_id
 * @property string $link
 * @property int $logo_file
 * @property int $user_id
 * @property int $user_update_id
 * @property string $date_created
 * @property string $date_updated
 *
 * @property Position $position
 * @property Status $status
 * @property FileAttachment $logoFile
 * @property User $user
 * @property User $userUpdate
 * @property Pages[] $cmsPages
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'label', 'menu_order', 'position_id', 'status_id', 'user_id', 'user_update_id', 'date_updated'], 'required'],
            [['id', 'parent_id', 'menu_order', 'position_id', 'status_id',  'user_id', 'user_update_id'], 'integer'],
            [['link', 'logo_file', 'logo_file', 'date_created', 'date_updated'], 'safe'],
            [['label', 'link'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => Position::className(), 'targetAttribute' => ['position_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['logo_file'], 'exist', 'skipOnError' => true, 'targetClass' => FileAttachment::className(), 'targetAttribute' => ['logo_file' => 'id']],
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
            'parent_id' => 'Parent ID',
            'label' => 'Label',
            'menu_order' => 'Menu Order',
            'position_id' => 'Position',
            'status_id' => 'Status',
            'link' => 'Link',
            'logo_file' => 'Logo/File Upload',
            'user_id' => 'User',
            'user_update_id' => 'User Update',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }

    /**
     * Gets query for [[Position]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(Position::className(), ['id' => 'position_id']);
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
     * Gets query for [[LogoFile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLogoFile()
    {
        return $this->hasOne(FileAttachment::className(), ['id' => 'logo_file']);
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
     * Gets query for [[CmsPages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsPages()
    {
        return $this->hasMany(Pages::className(), ['menu_id' => 'id']);
    }
}
