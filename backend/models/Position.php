<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cms_position".
 *
 * @property int $id
 * @property string $position
 *
 * @property Menu[] $cmsMenus
 */
class Position extends \niksko12\auditlogs\classes\ModelAudit
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_position';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'position'], 'required'],
            [['id'], 'integer'],
            [['position'], 'string', 'max' => 255],
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
            'position' => 'Position',
        ];
    }

    /**
     * Gets query for [[CmsMenus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsMenus()
    {
        return $this->hasMany(CmsMenu::className(), ['position_id' => 'id']);
    }

    public static function getPositionDropdown()
    {
        return self::find()->select(['position as name', 'id as id'])->indexBy('id')->column();
    }
}
