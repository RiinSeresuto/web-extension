<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cms_content_type".
 *
 * @property int $id
 * @property string $content_label
 */
class ContentType extends \niksko12\auditlogs\classes\ModelAudit
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_content_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content_label'], 'required'],
            [['content_label'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content_label' => 'Content Label',
        ];
    }
}
