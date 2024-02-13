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
 * @property int $logo/file
 * @property int $user_id
 * @property int $user_update_id
 * @property string $date_created
 * @property string $date_updated
 *
 * @property CmsPosition $position
 * @property CmsStatus $status
 * @property CmsFileAttachment $logo/file0
 * @property User $user
 * @property User $userUpdate
 * @property CmsPages[] $cmsPages
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
            [['id', 'parent_id', 'label', 'menu_order', 'position_id', 'status_id', 'link', 'logo/file', 'user_id', 'user_update_id', 'date_updated'], 'required'],
            [['id', 'parent_id', 'menu_order', 'position_id', 'status_id', 'logo/file', 'user_id', 'user_update_id'], 'integer'],
            [['date_created', 'date_updated'], 'safe'],
            [['label', 'link'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsPosition::className(), 'targetAttribute' => ['position_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['logo/file'], 'exist', 'skipOnError' => true, 'targetClass' => CmsFileAttachment::className(), 'targetAttribute' => ['logo/file' => 'id']],
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
            'position_id' => 'Position ID',
            'status_id' => 'Status ID',
            'link' => 'Link',
            'logo/file' => 'Logo/file',
            'user_id' => 'User ID',
            'user_update_id' => 'User Update ID',
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
        return $this->hasOne(CmsPosition::className(), ['id' => 'position_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(CmsStatus::className(), ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Logo/file0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLogo/file0()
    {
        return $this->hasOne(CmsFileAttachment::className(), ['id' => 'logo/file']);
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
        return $this->hasMany(CmsPages::className(), ['menu_id' => 'id']);
    }
}
