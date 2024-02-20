<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "file".
 *
 * @property int $id
 * @property string $name
 * @property string $model
 * @property int $itemId
 * @property string $hash
 * @property int $size
 * @property string $type
 * @property string $mime
 * @property int|null $is_main
 * @property int|null $date_upload
 * @property int $sort
 * @property string|null $dbStorePath
 *
 * @property Content[] $contents
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'model', 'itemId', 'hash', 'size', 'type', 'mime'], 'required'],
            [['itemId', 'size', 'is_main', 'date_upload', 'sort'], 'integer'],
            [['name', 'model', 'hash', 'type', 'mime', 'dbStorePath'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'model' => 'Model',
            'itemId' => 'Item ID',
            'hash' => 'Hash',
            'size' => 'Size',
            'type' => 'Type',
            'mime' => 'Mime',
            'is_main' => 'Is Main',
            'date_upload' => 'Date Upload',
            'sort' => 'Sort',
            'dbStorePath' => 'Db Store Path',
        ];
    }

    /**
     * Gets query for [[Contents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContents()
    {
        return $this->hasMany(Content::className(), ['attached_file' => 'id']);
    }
}
