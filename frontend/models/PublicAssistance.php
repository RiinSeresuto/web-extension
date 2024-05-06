<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cms_public_assistance".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $contact_num
 * @property string $subject
 * @property string $message
 * @property int $group
 * @property int $file_attachment
 * @property string $date_posted
 */
class PublicAssistance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_public_assistance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'contact_num', 'subject', 'message', 'group', 'file_attachment'], 'required'],
            [['contact_num', 'group', 'file_attachment'], 'integer'],
            [['message'], 'string'],
            [['date_posted'], 'safe'],
            [['name', 'email', 'subject'], 'string', 'max' => 255],
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
            'email' => 'Email',
            'contact_num' => 'Contact Num',
            'subject' => 'Subject',
            'message' => 'Message',
            'group' => 'Group',
            'file_attachment' => 'File Attachment',
            'date_posted' => 'Date Posted',
        ];
    }
}
