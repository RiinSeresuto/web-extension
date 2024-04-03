<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cms_banner".
 *
 * @property int $id
 * @property string $label
 * @property int $order
 * @property int $status_id
 * @property int $logo
 * @property string $url
 * @property int $user_id
 * @property int|null $user_update_id
 * @property string $date_created
 * @property string|null $date_updated
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_banner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['label', 'order', 'status_id', 'logo', 'url', 'user_id'], 'required'],
            [['order', 'status_id', 'logo', 'user_id', 'user_update_id'], 'integer'],
            [['date_created', 'date_updated'], 'safe'],
            [['label', 'url'], 'string', 'max' => 255],
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
            'url' => 'Url',
            'user_id' => 'User ID',
            'user_update_id' => 'User Update ID',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }
}
