<?php

namespace common\modules\wfh\controllers;

use Yii;
use common\modules\wfh\models\Task;
use common\modules\wfh\models\TaskSearch;
use common\modules\wfh\models\Record;
use common\modules\wfh\models\RecordSearch;
use common\modules\wfh\models\EmployeeDashboard;
use common\modules\wfh\models\SupervisorDashboard;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class DashboardController extends \niksko12\auditlogs\classes\ControllerAudit
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
					[
						'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
					],
				]
            ],
        ];
    }
	
	public function actionIndex()
	{
		$userinfo = \Yii::$app->user->identity->userinfo;
		$countByStatus = Task::find()->select(['count(*) as count', 'status'])
			->andWhere(['user_id'=>$userinfo->user_id])
			->andWhere(['<=', 'start_date', date('Y-m-d 23:59:59')])
			->groupBy(['status'])->indexBy('status')->asArray()->all();

		$employeeDashboard = new EmployeeDashboard([
			'user_id' => $userinfo->user_id,
			'reference_date' => date('Y-m-d'),
		]);
		
		$supervisorDashboard = new SupervisorDashboard([
			'user_id' => $userinfo->user_id,
			'reference_date' => date('Y-m-d'),
		]);
		
		return $this->render('index', [
			'countByStatus' => $countByStatus,
			'status' => Task::getStatusList(),
			'employeeDashboard' => $employeeDashboard,
			'supervisorDashboard' => $supervisorDashboard,
			'attendanceRecordView' => $this->actionAttendanceRecordView(Yii::$app->request->queryParams, $supervisorDashboard)
		]);
	}
	
    public function actionAttendanceRecordView($params, $supervisorDashboard)
    {
		$employees = [];
		if(\Yii::$app->getModule('wfh')->isSupervisor){
			$employees = $supervisorDashboard->getMyStaff('object');
			if(!empty($params['RecordSearch']['user_id'])){
				$params['RecordSearch']['user_id'] = array_intersect($params['RecordSearch']['user_id'], ArrayHelper::getColumn($employees, 'user_id'));
			}

			$searchModel = new RecordSearch([
				'user_id' => Yii::$app->user->id,
				'time_in_range' => date('Y-m-d', strtotime('-1 month')) . ' - ' . date('Y-m-d'),
			]);
			
			if(empty($params['RecordSearch']['user_id'])){
				$employee_id = ArrayHelper::getColumn($employees, 'user_id');
				$params['RecordSearch']['user_id'] =  $employee_id;
			}
			
			$dataProvider = $searchModel->search($params);
			$dataProvider->sort->defaultOrder = ['time_in'=>SORT_DESC];

			return $this->renderPartial('attendance-record-view', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'employees' => $employees,
			]);
		}
    }
}
