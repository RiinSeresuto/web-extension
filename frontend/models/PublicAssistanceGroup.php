<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cms_public_assistance_group".
 *
 * @property int $id
 * @property string $p_a_group
 */
class PublicAssistanceGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_public_assistance_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'p_a_group'], 'required'],
            [['id'], 'integer'],
            [['p_a_group'], 'string', 'max' => 255],
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
            'p_a_group' => 'P A Group',
        ];
    }
}
