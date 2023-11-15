<?php

namespace common\modules\wfh\components;

use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use common\modules\wfh\models\TimeInOut;
use common\modules\wfh\models\Record;
use common\modules\wfh\models\RecordSearch;

class WfhWidget extends Widget
{	
	public function init()
	{
		parent::init();
	}

	public function run()
	{
		return $this->timeIn();
	}

	public function timeIn(){
		if(!$this->isAllowed()){
			return;
		}
        $searchModel = new RecordSearch();
		$searchModel->user_id = Yii::$app->user->id;
		$searchModel->time_in_range = date('Y-m-d', strtotime('-1 month')) . ' - ' . date('Y-m-d');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->sort->defaultOrder = ['time_in'=>SORT_DESC];

		return $this->render('panel', [
			'timeInOut' => new TimeInOut(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
		]);	
	}
	
	private function isAllowed()
	{
		$userinfo = \Yii::$app->user->identity->userinfo;
		if($userinfo->OFFICE_C == 5){
		//	$service = $userinfo->getCurrentService($userinfo->user_id);
		//	if($service && in_array($service->SERVICE_C, [1, 2, 8, 21])){
		//		return true;
		//	}
		    return true;
		}
		return false;
	}
}

?>