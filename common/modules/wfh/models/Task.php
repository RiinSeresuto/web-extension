<?php

namespace common\modules\wfh\models;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "wfh_task".
 *
 * @property int $id
 * @property int $user_id
 * @property string $start_date
 * @property string $end_date
 * @property string $status
 * @property string $description
 * @property string $reason
 */
class Task extends \niksko12\auditlogs\classes\ModelAudit
{
    public $attachement_url;
    public $file_attachment;
    public $current_files;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wfh_task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'start_date', 'status', 'description', 'encoded_by'], 'required'],
            [['user_id', 'encoded_by'], 'integer'],
            [['start_date', 'end_date', 'current_files'], 'safe'],
            [['status', 'description', 'reason', 'attachement_url'], 'string'],
			['reason', 'required', 'when' => function ($model) {
				return in_array($model->status, ['Cancelled', 'On Hold']);
			}, 'whenClient' => "function (attribute, value) {
				return ($('#task-status').val() == 'Cancelled' || $('#task-status').val() == 'On Hold');
			}"],
			['end_date', 'required', 'when' => function ($model) {
				return ($model->status == 'Completed');
			}, 'whenClient' => "function (attribute, value) {
				return ($('#task-status').val() == 'Completed');
			}"],
            [['end_date'], 'checkBeforeStartDate'],
            [['file_attachment'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, pdf, xlsx, docx', 'maxFiles' => 4],
        ];
    }
	
	public function checkBeforeStartDate($attribute, $params)
	{
		if($this->end_date < $this->start_date){
			$this->addError('end_date', 'Date and Time selected is earlier than the Start Date for this task.');
		}
	}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'status' => 'Status',
            'description' => 'Description',
            'reason' => 'Reason',
            'attachement_url' => 'File URL',
			'encoded_by' => 'Encoded By',
          
        ];
    }
	
	public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);
		$this->uploadFiles();
	}
	
    public function getUser()
    {
        return $this->hasOne(\niksko12\user\models\User::className(), ['id' => 'user_id']);
    }
	
    public function getEncodedBy()
    {
        return $this->hasOne(\niksko12\user\models\User::className(), ['id' => 'encoded_by'])->alias('encodedBy');
    }

	public function getInterval()
	{
		$end_date = ($this->end_date) ? $this->end_date : date('Y-m-d H:i:s');
		$sDate = new \DateTime($this->start_date);
		$eDate = new \DateTime($end_date);
		return $sDate->diff($eDate);		
	}
	
	public function getDuration()
	{
		$str = '';
		if($this->status != 'Cancelled' && $this->start_date < date('Y-m-d H:i:s')){
			$str = $this->interval->days." Days ".$this->interval->format('%h')." Hours ".$this->interval->format('%i')." Minutes";					
		}
		return $str;		
    }
    
    public function getLink()
    {
        $record = Attachments::find()->where(['task_id' => $this->id, 'file_type' => 'URL']);
        return ($record) ? $record : '';
    }

	public function getUrl()
    {
        return $this->link;
        
    }
    
    public function getFiles()
    {
        // $record = Attachments::find()->where(['task_id' => $this->id, 'file_type' => 'Image'])->all();
        $record = Attachments::find()->where(['task_id' => $this->id, 'url' => null])->all();
        return ($record) ? $record : '';
    }

    public function getImages()
    {
        return $this->files;
    }
	
	public function getStatusList()
	{
		return [ 'Ongoing' => 'Ongoing', 'On Hold' => 'On Hold', 'Completed' => 'Completed', 'Cancelled' => 'Cancelled'];
	}
	
	public function getAttachments()
	{
        return $this->hasMany(Attachments::className(), ['task_id' => 'id']);
	}
	
	public function getShortDescription()
	{
		return (strlen($this->description) > 100) ? substr($this->description, 0, 100) . '...' : $this->description;
	}
	
	public function uploadFiles()
	{
		$this->file_attachment = UploadedFile::getInstances($this, 'file_attachment');
		$file_diff_id = array_diff(ArrayHelper::getColumn($this->attachments, 'id'),($this->current_files) ? $this->current_files : []);

		if ($file_diff_id) {
			foreach ($file_diff_id as $row) {
				$data = Attachments::findOne($row);
				$filePath = Yii::getAlias('@common'). '/../'. $data->file_path;
				@unlink($filePath);
				Attachments::find()->where(['id' =>$row])->one()->delete();
			}
		}
		
		$link = Attachments::find()->where(['task_id' => $this->id, 'file_type' => 'URL'])->one();
		if ($link) {
			$link->url = ($this->attachement_url) ? $this->attachement_url : '';
			$link->save();
			if ($this->attachement_url) {
				$link->url = $this->attachement_url;
				$link->save();
			} else {
				Attachments::find()->where(['id' =>$link->id])->one()->delete();
			}
		} else {
			if ($this->attachement_url) {
				$url_link = new Attachments();
				$url_link->task_id   = $this->id;
				$url_link->file_type = 'URL';
				$url_link->url = $this->attachement_url;
				$url_link->file_name = null;
				$url_link->file_path = null;
				$url_link->save(); 
			}
		}

		if (!empty($this->file_attachment)){
			foreach ($this->file_attachment as $key => $file) {
				$ext = pathinfo($file, PATHINFO_EXTENSION);
				$ext = strtolower($ext);
				$newfilename = $this->user_id .'-' . $this->id . '-' .date('dmYHis').'-'.str_replace(" ", "", basename($file->baseName));

				$attachemnt = new Attachments();
				$attachemnt->task_id = $this->id;

				if ($ext == 'pdf') {
					$attachemnt->file_type = 'Pdf';

				} else if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
					$attachemnt->file_type = 'Image';

				} else if ($ext == 'xlsx') {
					$attachemnt->file_type = 'Xlsx';

				} else if ($ext == 'docx') {
					$attachemnt->file_type = 'Docx';

				 }
				 $attachemnt->url = null;
				 $attachemnt->file_name = $file->name;
				 $attachemnt->file_path = 'common/uploads/wfh/' . $newfilename . '.' . $file->extension;
				 if($attachemnt->save()){
					 $file->saveAs(Yii::getAlias('@common').'/uploads/wfh/' . $newfilename . '.' . $file->extension, false);
				 }
			}
		 }		
	}
	
	public function checkAccess($action)
	{
		if($action == 'view'){
			if($this->user_id != Yii::$app->user->id && $this->encoded_by != Yii::$app->user->id){
				if(\Yii::$app->getModule('wfh')->isSupervisor){
					$supervisorDashboard = \Yii::$app->getModule('wfh')->supervisorDashboard;
					$employees = $supervisorDashboard->myStaff;
					if(in_array($this->user_id, $employees)){
						return true;
					}
				}
				return false;
			}
		}else if($this->user_id != Yii::$app->user->id && $this->encoded_by != Yii::$app->user->id){
			return false;
		}
		return true;
	}
}
