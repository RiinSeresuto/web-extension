<?php

namespace common\modules\wfh\models;

use Yii;

/**
 * This is the model class for table "wfh_report_details".
 *
 * @property int $id
 * @property int $user_id
 * @property string $employee_position
 * @property string $approval_name
 * @property string $approval_position
 *
 * @property User $user
 */
class ReportDetails extends \niksko12\auditlogs\classes\ModelAudit
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wfh_report_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'employee_position', 'approval_name', 'approval_position'], 'required'],
            [['user_id'], 'integer'],
            [['employee_position', 'approval_name'], 'string', 'max' => 255],
            [['approval_position'], 'string', 'max' => 45],
            // [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'employee_position' => 'Employee Position',
            'approval_name' => 'Approval Name',
            'approval_position' => 'Approval Position',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\niksko12\user\models\User::className(), ['id' => 'user_id']);
    }
}
