<?php

namespace common\modules\wfh\models;

use Yii;

/**
 * This is the model class for table "wfh_record".
 *
 * @property int $id
 * @property int $user_id
 * @property string $time_in
 * @property string $time_out
 */
class Record extends \niksko12\auditlogs\classes\ModelAudit
{
	public $date;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wfh_record';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'time_in'], 'required'],
            [['user_id'], 'integer'],
            [['time_in', 'time_out', 'date'], 'safe'],
            [['time_out'], 'checkBeforeStartDate'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'time_in' => 'Time In',
            'time_out' => 'Time Out',
            'date' => 'Date',
        ];
    }
	
	public function checkBeforeStartDate($attribute, $params)
	{
		if($this->time_out < $this->time_in){
			$this->addError('time_out', 'Time Out DateTime selected is earlier than the Time in DateTime');
		}
	}
	
	public function afterFind()
	{
		$this->date = date('Y-m-d', strtotime($this->time_in));
	}
	
    public function getUser()
    {
        return $this->hasOne(\niksko12\user\models\User::className(), ['id' => 'user_id']);
    }
}
