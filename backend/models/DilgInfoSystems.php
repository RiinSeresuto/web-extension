<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cms_dilg_info_systems".
 *
 * @property int $id
 * @property string $label
 * @property int $order
 * @property int $status_id
 * @property int $logo
 * @property string $link
 * @property int $user_id
 * @property int $user_update_id
 * @property string $date_created
 * @property string|null $date_updated
 */
class DilgInfoSystems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_dilg_info_systems';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['label', 'order', 'status_id', 'logo', 'link'], 'required'],
            [['order', 'status_id', 'logo', 'user_id', 'user_update_id'], 'integer'],
            [['date_created', 'date_updated', 'user_id', 'user_update_id'], 'safe'],
            [['label', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Label',
            'order' => 'Order',
            'status_id' => 'Status ID',
            'logo' => 'Logo',
            'link' => 'Link',
            'user_id' => 'User ID',
            'user_update_id' => 'User Update ID',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }
}
