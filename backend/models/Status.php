<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cms_status".
 *
 * @property int $id
 * @property string $status_type
 *
 * @property CmsCategory[] $cmsCategories
 * @property CmsConnectedAgencies[] $cmsConnectedAgencies
 * @property CmsForm[] $cmsForms
 * @property CmsMenu[] $cmsMenus
 * @property CmsPages[] $cmsPages
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status_type'], 'required'],
            [['id'], 'integer'],
            [['status_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status_type' => 'Status Type',
        ];
    }

    /**
     * Gets query for [[CmsCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsCategories()
    {
        return $this->hasMany(Category::className(), ['status_id' => 'id']);
    }

    /**
     * Gets query for [[CmsConnectedAgencies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsConnectedAgencies()
    {
        return $this->hasMany(ConnectedAgencies::className(), ['status_id' => 'id']);
    }

    /**
     * Gets query for [[CmsForms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsForms()
    {
        return $this->hasMany(Form::className(), ['status_id' => 'id']);
    }

    /**
     * Gets query for [[CmsMenus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsMenus()
    {
        return $this->hasMany(Menu::className(), ['status_id' => 'id']);
    }

    /**
     * Gets query for [[CmsPages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsPages()
    {
        return $this->hasMany(Pages::className(), ['status_id' => 'id']);
    }
}
