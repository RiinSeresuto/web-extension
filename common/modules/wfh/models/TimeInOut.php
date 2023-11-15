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
class TimeInOut extends \yii\base\Model
{
	public $user_id;
	public $time_in;
	public $time_out;
	public $error;
	public $allowTimeIn = false;
	public $allowTimeOut = false;
	
	public $sameDayRecord;
	public $diffDayRecord;
	public $dateDiff;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'time_in', 'time_out'], 'required'],
            [['user_id'], 'integer'],
            [['time_in', 'time_out'], 'safe'],
        ];
    }

	public function init()
	{
		$this->diffDayRecord = $this->diffDayRecord();

		if ($this->diffDayRecord) {
			if($this->diffDayRecord && !$this->diffDayRecord->time_out){
				$this->time_out = date('Y-m-d H:i:s');
				$this->allowTimeOut = true;
			}
		} else {
			$this->sameDayRecord = $this->sameDayRecord();
			if($this->sameDayRecord && $this->sameDayRecord->time_in && $this->sameDayRecord->time_out){		
				$this->time_in = $this->sameDayRecord->time_in;
				$this->time_out = $this->sameDayRecord->time_out;
			}else if($this->sameDayRecord && !$this->sameDayRecord->time_out){
				$this->time_out = date('Y-m-d H:i:s');
				$this->allowTimeOut = true;
			}else {
				$this->time_in = date('Y-m-d H:i:s');
				$this->time_out = date('Y-m-d H:i:s');
				$this->allowTimeIn = true;
			}
		}
	}
	
	public function timeIn()
	{
		$sameDayRecord = $this->sameDayRecord;
		
		if(!$sameDayRecord){
			$record = new Record();
			$record->user_id = Yii::$app->user->id;
			$record->time_in = $this->time_in;
			$record->save();
			return true;
		}
		return false;
	}	

	public function timeOut()
	{
		$sameDayRecord = $this->sameDayRecord;
		if($sameDayRecord && !$sameDayRecord->time_out){
			$sameDayRecord->time_out = $this->time_out;
			$sameDayRecord->save();
			return true;
		}if($sameDayRecord && $sameDayRecord->time_out){
			$this->error = 'Attendance Record not saved. You have an existing time out today at ' . date('h:i A', strtotime($sameDayRecord->time_out));
		}else{
			$this->error = 'Attendance Record not saved. You have an existing time out today';
		}
		return false;
	}
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function sameDayRecord()
    {
        return Record::find()
			->andWhere(['user_id'=>Yii::$app->user->id])
			->andWhere(['between', 'time_in', date('Y-m-d 00:00:00'), date('Y-m-d 23:23:59')])
			->one();
	}
	
	public function diffDayRecord()
	{
		$this->dateDiff =  date('Y-m-d',strtotime("-1 days"));
		return Record::find()
			->andWhere(['user_id'=>Yii::$app->user->id])
			->andWhere(['between', 'time_in', date('Y-m-d 00:00:00',strtotime("-1 days")),  date('Y-m-d 23:23:59',strtotime("-1 days"))])
			->andWhere(['time_out' => null])
			->one();
	}

	public function timeOutOther()
	{
		$diffDayRecord = $this->diffDayRecord();
		if($diffDayRecord && !$diffDayRecord->time_out){
			$diffDayRecord->time_out = $this->time_out;
			$diffDayRecord->save();
			return true;
		}if($diffDayRecord && $diffDayRecord->time_out){
			$this->error = 'Attendance Record not saved. You have an existing time out today at ' . date('h:i A', strtotime($diffDayRecord->time_out));
		}else{
			$this->error = 'Attendance Record not saved. You have an existing time out today';
		}
		return false;
	}
}
