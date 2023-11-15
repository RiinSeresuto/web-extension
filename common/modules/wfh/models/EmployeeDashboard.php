<?php

namespace common\modules\wfh\models;

use Yii;

class EmployeeDashboard extends \Yii\base\Model
{
	public $user_id;
	public $reference_date;
	public $ceil_date;
	public $floor_date = '1900-01-01';
	
	private $ongoing;
	private $today;
	private $upcoming;
	
	public function init()
	{
		$this->ceil_date = date('Y-m-d', strtotime('+10 years'));
	}

	public function getOngoingTaskDataProvider()
	{
		if(!$this->ongoing){
			$searchModel = new TaskSearch([
				'user_id' => $this->user_id,
				'start_date_range' => $this->floor_date . ' - ' . $this->reference_date,
				'status' => 'Ongoing',
			]);
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			$dataProvider->sort->defaultOrder = ['start_date'=>SORT_ASC];
			$this->ongoing = $dataProvider;
		}
		return $this->ongoing;
	}
	
	public function getTodayTaskDataProvider()
	{
		if(!$this->today){
			$searchModel = new TaskSearch([
				'user_id' => $this->user_id,
				'start_date_range' => $this->reference_date . ' - ' . $this->reference_date,
				'status' => 'Ongoing',
			]);
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			$dataProvider->sort->defaultOrder = ['start_date'=>SORT_ASC];
			$this->today = $dataProvider;
		}
		return $this->today;
	}
	
	public function getUpcomingTaskDataProvider()
	{
		if(!$this->upcoming){
			$searchModel = new TaskSearch([
				'user_id' => $this->user_id,
				'start_date_range' => date('Y-m-d', strtotime($this->reference_date.' +1 day')) . ' - ' . $this->ceil_date,
				'status' => 'Ongoing',
			]);
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			$dataProvider->sort->defaultOrder = ['start_date'=>SORT_ASC];
			$this->upcoming = $dataProvider;
		}
		return $this->upcoming;
	}
}