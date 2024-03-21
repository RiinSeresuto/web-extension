<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;

use backend\models\ConnectedAgencies;
use backend\models\ConnectedAgenciesSearch;
use backend\models\AgencyType;
use backend\models\Status;
use backend\models\File;


/**
 * ConnectedAgenciesController implements the CRUD actions for ConnectedAgencies model.
 */
class ConnectedAgenciesController extends \niksko12\auditlogs\classes\ControllerAudit
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
        ];
    }

    /**
     * Lists all ConnectedAgencies models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ConnectedAgenciesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $agency_type = AgencyType::find()->all();
        $status = Status::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'agency_type' => $agency_type,
            'status' => $status
        ]);
    }

    /**
     * Displays a single ConnectedAgencies model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $items = [];
        $path = Yii::getAlias('@common/uploads/store');
        $files = FileHelper::findFiles($path);

        foreach ($files as $file) {
          $item = [
            "url"=>Yii::$app->urlManager->baseUrl . 'uploads/store/' . substr(basename($file), 0, 2) . '/' . substr(basename($file), 3, 2) . '/' . substr(basename($file), 6, 2) . '/' . basename($file),
            "src"=>Yii::$app->urlManager->baseUrl . 'uploads/store/' . substr(basename($file), 0, 2) . '/' . substr(basename($file), 3, 2) . '/' . substr(basename($file), 6, 2) . '/' . basename($file),
        ];
          $items[]=$item;
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'items' => $items
        ]);
    }

    /**
     * Creates a new ConnectedAgencies model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ConnectedAgencies();

        $agency_type = AgencyType::find()->all();
        $status = Status::find()->all();

        if ($model->load(Yii::$app->request->post())) {

            $model->user_id = Yii::$app->user->identity->id;

            if ($model->save())
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'agency_type' => $agency_type,
            'status' => $status
        ]);
    }

    /**
     * Updates an existing ConnectedAgencies model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $agency_type = AgencyType::find()->all();
        $status = Status::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'agency_type' => $agency_type,
            'status' => $status
        ]);
    }

    /**
     * Deletes an existing ConnectedAgencies model.
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
     * Finds the ConnectedAgencies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ConnectedAgencies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ConnectedAgencies::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
