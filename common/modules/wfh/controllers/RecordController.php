<?php

namespace common\modules\wfh\controllers;

use Yii;
use common\modules\wfh\models\TimeInOut;
use common\modules\wfh\models\Record;
use common\modules\wfh\models\RecordSearch;
use niksko12\user\models\UserInfo;
use niksko12\user\models\ServiceUserHistory;
use common\modules\usermanagement\models\HrisUser;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * RecordController implements the CRUD actions for Record model.
 */
class RecordController extends \niksko12\auditlogs\classes\ControllerAudit
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
						'actions' => ['index-admin', 'update', 'view', 'name-list'],
                        'allow' => true,
                        'roles' => ['SuperAdministrator'],
                    ],
					[
						'actions' => ['index', 'time-in', 'time-out', 'time-out-other'],
                        'allow' => true,
                        'roles' => ['@'],
					],
				]
            ],
        ];
    }

    /**
     * Lists all Record models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RecordSearch();
		$searchModel->user_id = Yii::$app->user->id;
		$searchModel->time_in_range = date('Y-m-d', strtotime('-1 month')) . ' - ' . date('Y-m-d');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->sort->defaultOrder = ['time_in'=>SORT_DESC];

        return $this->render('index', [
			'timeInOut' => new TimeInOut(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
    /**
     * Lists all Record models.
     * @return mixed
     */
    public function actionIndexAdmin()
    {
        $searchModel = new RecordSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		$dataProvider->sort->defaultOrder = ['time_in'=>SORT_DESC];


		$names = [];
		if(!empty(Yii::$app->request->queryParams['RecordSearch']['user_id'])){
			$user_id = Yii::$app->request->queryParams['RecordSearch']['user_id'];
			$names = $this->actionNameList(null, $user_id);
		}
        return $this->render('index-admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'names' => $names,
			
        ]);
    }

    /**
     * Displays a single Record model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	
	public function actionTimeIn()
	{
		$model = new TimeInOut();
        if ($model->timeIn()) {
			\Yii::$app->session->setFlash('success', 'Attendance Record saved. Your recorded time in is ' . date('h:i A', strtotime($model->time_in)));
        }else{
			\Yii::$app->session->setFlash('danger', 'Attendance Record not saved. You have an existing time in today at ' . date('h:i A', strtotime($model->sameDayRecord->time_in)));
		}
		//return $this->redirect(['index']);
		return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
	}
	
	public function actionTimeOut()
	{
		$model = new TimeInOut();
        if ($model->timeOut()) {
			\Yii::$app->session->setFlash('success', 'Attendance Record saved. Your recorded time out is ' . date('h:i A', strtotime($model->time_out)));
        }else{
			\Yii::$app->session->setFlash('danger', $model->error);
		}
		//return $this->redirect(['index']);
		return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
	}

    /**
     * Creates a new Record model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Record();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Record model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Record model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Record model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Record the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Record::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionTimeOutOther()
	{
        $model = new TimeInOut();
        
        if ($model->timeOutOther()) {
			\Yii::$app->session->setFlash('success', 'Attendance Record saved. Your recorded time out is ' . date('h:i A', strtotime($model->time_out)));
        }else{
			\Yii::$app->session->setFlash('danger', $model->error);
		}
		//return $this->redirect(['index']);
		return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
	}
	
	public function actionNameList($q = null, $user_id = null) {
		$out = ['results' => ['id' => '', 'text' => '']];
		if (!is_null($q)) {
			\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			$users = UserInfo::find()
				->joinWith(['user', 'userservice', 'userservice.service'])
				->innerJoin(HrisUser::tableName(), UserInfo::tableName().'.user_id = '.HrisUser::tableName().'.user_id')								
				->select([ServiceUserHistory::tableName().'.user_id', UserInfo::tableName().'.user_id as id', 'UPPER(concat(SERVICE_ACRONYM, ": ", '.UserInfo::tableName().'.LAST_M, ",  ", '.UserInfo::tableName().'.FIRST_M, " ", '.UserInfo::tableName().'.MIDDLE_M)) as text']);

				$nameArray = explode(' ', $q);
				foreach($nameArray as $name):
					$users = $users->andWhere(['or', ['like', 'FIRST_M', $name], ['like', 'MIDDLE_M', $name], ['like', 'LAST_M', $name]]);
				endforeach;

			$users = $users->asArray()->orderBy(['SERVICE_ACRONYM'=>SORT_ASC, 'LAST_M'=>SORT_ASC, 'FIRST_M'=>SORT_ASC])->all();
			$out['results'] = array_values($users);
		} elseif ($user_id > 0) {
			$users = UserInfo::find()
				->joinWith(['user', 'userservice', 'userservice.service'])
				->innerJoin(HrisUser::tableName(), UserInfo::tableName().'.user_id = '.HrisUser::tableName().'.user_id')								
				->select([ServiceUserHistory::tableName().'.user_id', UserInfo::tableName().'.user_id as id', 'UPPER(concat(SERVICE_ACRONYM, ": ", '.UserInfo::tableName().'.LAST_M, ",  ", '.UserInfo::tableName().'.FIRST_M, " ", '.UserInfo::tableName().'.MIDDLE_M)) as text'])
				->andWhere([UserInfo::tableName().'.user_id' => $user_id])
				->asArray()->orderBy(['SERVICE_ACRONYM'=>SORT_ASC, 'LAST_M'=>SORT_ASC, 'FIRST_M'=>SORT_ASC])->all();
				
			return ArrayHelper::map($users, 'id', 'text');
		}
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $out;
	}
}
