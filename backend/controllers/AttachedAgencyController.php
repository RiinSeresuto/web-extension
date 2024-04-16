<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\AttachedAgency;
use backend\models\AttachedAgencySearch;
use backend\models\Status;

/**
 * AttachedAgencyController implements the CRUD actions for AttachedAgency model.
 */
class AttachedAgencyController extends \niksko12\auditlogs\classes\ControllerAudit
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
     * Lists all AttachedAgency models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AttachedAgencySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $status = Status::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'status' => $status
        ]);
    }

    /**
     * Displays a single AttachedAgency model.
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

    /**
     * Creates a new AttachedAgency model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AttachedAgency();
        $status = Status::find()->all();

        if ($model->load(Yii::$app->request->post())) {

            $model->user_id = Yii::$app->user->identity->id;

            if ($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
        }

        //$menus = Menu::find()->where(['position_id' => 1])->orderBy(['menu_order' => SORT_ASC])->all();


        return $this->render('create', [
            'model' => $model,
            'status' => $status
        ]);
    }

    /**
     * Updates an existing AttachedAgency model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $status = Status::find()->all();

        if ($model->load(Yii::$app->request->post())) {

            $model->user_update_id = Yii::$app->user->identity->id;

            if ($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'status' => $status
        ]);
    }

    /**
     * Deletes an existing AttachedAgency model.
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
     * Finds the AttachedAgency model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AttachedAgency the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AttachedAgency::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
