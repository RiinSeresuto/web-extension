<?php

namespace common\modules\wfh\models;

use Yii;

/**
 * This is the model class for table "wfh_attachments".
 *
 * @property int $id
 * @property int $task_id
 * @property string $file_type
 * @property string|null $url
 * @property string|null $file_name
 * @property string|null $file_path
 *
 * @property WfhTask $task
 */
class Attachments extends \niksko12\auditlogs\classes\ModelAudit
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wfh_attachments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'file_type'], 'required'],
            [['task_id'], 'integer'],
            [['url'], 'string'],
            [['file_type'], 'string', 'max' => 15],
            [['file_name', 'file_path'], 'string', 'max' => 255],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'Task ID',
            'file_type' => 'File Type',
            'url' => 'Url',
            'file_name' => 'File Name',
            'file_path' => 'File Path',
        ];
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(WfhTask::className(), ['id' => 'task_id']);
    }
}
