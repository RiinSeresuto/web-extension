<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cms_agency_type".
 *
 * @property int $id
 * @property string $agency_type
 *
 * @property CmsConnectedAgencies[] $cmsConnectedAgencies
 */
class AgencyType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_agency_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'agency_type'], 'required'],
            [['id'], 'integer'],
            [['agency_type'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'agency_type' => 'Agency Type',
        ];
    }

    /**
     * Gets query for [[CmsConnectedAgencies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsConnectedAgencies()
    {
        return $this->hasMany(CmsConnectedAgencies::className(), ['agency_type_id' => 'id']);
    }
}
