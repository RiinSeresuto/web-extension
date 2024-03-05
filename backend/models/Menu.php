<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cms_menu".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $label
 * @property int $menu_order
 * @property int $is_new_tab //new
 * @property int $url_type
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
    public $file_attach=[];
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
            [['label', 'menu_order', 'position_id', 'status_id'], 'required'],
            [['parent_id', 'menu_order', 'position_id', 'status_id', 'url_type'], 'integer'],         // added is_new_tab
            [['link', 'date_created', 'date_updated', 'user_update_id', 'user_id', 'user_update_id'], 'safe'],
            [['label', 'link'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => Position::className(), 'targetAttribute' => ['position_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['user_update_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_update_id' => 'id']],
            [['file_attach'], 'file', 'skipOnError' => true, 'extensions' => 'jpg, jpeg, png, pdf']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent Menu',
            'label' => 'Label',
            'menu_order' => 'Menu Order',
            'url_type' => 'URL Type',
            'position_id' => 'Position',
            'status_id' => 'Status',
            'link' => 'Link',
            'logo_file' => 'File Upload',
            'file_attach' => 'File Upload',
            'user_id' => 'Encoded By',
            'user_update_id' => 'Updated By',
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
        return $this->hasMany(File::className(), ['itemId' => 'id']);
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

    public function getMenuChildren()
    {
        return $this->hasMany(Menu::className(), ['parent_id' => 'id']);
    }

    public function getParentLabel()
    {
        return $this->hasOne(Menu::className(), ['id' => 'parent_id']);
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
