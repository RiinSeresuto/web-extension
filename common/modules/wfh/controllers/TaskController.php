<?php

namespace common\modules\wfh\controllers;

use Yii;
use common\modules\wfh\models\Task;
use common\modules\wfh\models\TaskSearch;
use common\modules\wfh\models\SupervisorDashboard;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\modules\wfh\models\Attachments;
use yii\helpers\ArrayHelper;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends \niksko12\auditlogs\classes\ControllerAudit
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
						'actions' => ['index-admin'],
                        'allow' => true,
                        'roles' => ['WFH_Administrator'],
                    ],
					[
						'actions' => ['index', 'create', 'update', 'delete', 'view', 'download'],
						'allow' => true, 
						'roles' => ['@'],
					]
				]
            ],
        ];
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function actionIndex()
    {
		$employees = [];
		$params = Yii::$app->request->queryParams;

		if(\Yii::$app->getModule('wfh')->isSupervisor){
			$supervisorDashboard = \Yii::$app->getModule('wfh')->supervisorDashboard;
			$employees = $supervisorDashboard->getMyStaff('object');
			if(!empty($params['TaskSearch']['user_id'])){
				$params['TaskSearch']['user_id'] = array_intersect($params['TaskSearch']['user_id'], ArrayHelper::getColumn($employees, 'user_id'));
			}
		}else{
			$params['TaskSearch']['user_id'] = Yii::$app->user->id;
		}

        $searchModel = new TaskSearch([
			'user_id' => Yii::$app->user->id,
			'start_date_range' => date('Y-m-d', strtotime('-1 month')) . ' - ' . date('Y-m-d'),
		]);
		
		if(empty($params['TaskSearch']['user_id'])){
			$params['TaskSearch']['user_id'] =  Yii::$app->user->id;
		}

        $dataProvider = $searchModel->search($params);
		$dataProvider->sort->defaultOrder = ['start_date'=>SORT_DESC];
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'employees' => $employees,
        ]);
    }
	
    public function actionIndexAdmin()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->sort->defaultOrder = ['start_date'=>SORT_DESC];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		$model = $this->findModel($id);
		
		if(!$model->checkAccess('view')){
			\Yii::$app->session->setFlash('danger', 'You are not allowed to view this task.');
			return $this->redirect(Yii::$app->request->referrer ?: ['index']);
		}
		
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Task([
			'status' => 'Ongoing',
			'user_id' => Yii::$app->user->id,
			'encoded_by' => Yii::$app->user->id,
		]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
        }

		$employees = [];
		if(\Yii::$app->getModule('wfh')->isSupervisor){
			$supervisorDashboard = \Yii::$app->getModule('wfh')->supervisorDashboard;
			$employees = $supervisorDashboard->getMyStaff('object');
		}

        return $this->render('create', [
            'model' => $model,
			'employees' => $employees,
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $s=null)
    {
        $model = $this->findModel($id);
		$post = Yii::$app->request->post();

		if(!$model->checkAccess('update')){
			\Yii::$app->session->setFlash('danger', 'You are not allowed to update this task.');
			return $this->redirect(Yii::$app->request->referrer ?: ['index']);
		}
		
		if(!in_array($s, $model->statusList)){
			$s = null;
		}else if(in_array($s, $model->statusList)){
			$model->status = $s;
			if($post){
				$post['Task']['status'] = $s;
			}
		}

        if ($model->load($post) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
        }

		$employees = [];
		if(\Yii::$app->getModule('wfh')->isSupervisor){
			$supervisorDashboard = \Yii::$app->getModule('wfh')->supervisorDashboard;
			$employees = $supervisorDashboard->getMyStaff('object');
		}

        return $this->render('update', [
            'model' => $model,
			'employees' => $employees,
			's' => $s,
        ]);
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
		$model = $this->findModel($id);
		if(!$model->checkAccess('delete')){
			\Yii::$app->session->setFlash('danger', 'You are not allowed to delete this task.');
			return $this->redirect(Yii::$app->request->referrer ?: ['index']);
		}
  
		if($model->user_id == $model->encoded_by){
			$attachments = Attachments::find()->where(['task_id' =>$id])->all();
	  
			if ($attachments) {
				foreach ($attachments as $row) {
					$filePath = Yii::getAlias('@common'). '/../'. $row->file_path;
					@unlink($filePath);
					Attachments::find()->where(['id' =>$row->id])->one()->delete();
				}
			}

			$model->delete();
			\Yii::$app->session->setFlash('success', 'Encoded task removed.');
		}else{
			$message = ($model->encodedBy && $model->encodedBy->userinfo && $model->encodedBy->userinfo->fullName) ? 'This task was assigned to you by ' . $model->encodedBy->userinfo->fullName : 'Unabled to remove task. This tasked was assigned to you.';
			\Yii::$app->session->setFlash('danger', $message);
		}
		return $this->redirect(['index']);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	public function actionDownload($id)
	{
		$file = Attachments::find()->andWhere(['id'=>$id])->one();
		$filePath = Yii::getAlias('@common'). '/../'. $file->file_path;
		if(file_exists($filePath)){
			return Yii::$app->response->sendFile($filePath, $file->file_name, ['inline'=>true]);
		}
	}
}
