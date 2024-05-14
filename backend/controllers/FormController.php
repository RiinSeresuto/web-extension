<?php

namespace backend\controllers;

use Yii;
use backend\models\Form;
use backend\models\FormSearch;
use backend\models\Category;
use backend\models\Status;
use backend\models\Field;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * FormController implements the CRUD actions for Form model.
 */
class FormController extends \niksko12\auditlogs\classes\ControllerAudit
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
     * Lists all Form models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FormSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ['date_created' => SORT_DESC];

        $category = Category::find()->all();
        $status = Status::find()->all();


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'category' => $category,
            'status' => $status,
        ]);
    }

    /**
     * Displays a single Form model.
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
     * Creates a new Form model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Form();
        $category = Category::find()->all();
        $status = Status::find()->all();
        $field = Field::find()->all();


        if ($model->load(Yii::$app->request->post())) {

            $model->user_id = Yii::$app->user->identity->id;

            if ($model->save()) {

                return $this->redirect(['view', 'id' => $model->id]);
            } else {

            }

        }

        return $this->render('create', [
            'model' => $model,
            'category' => $category,
            'status' => $status,
            'field' => $field
        ]);
    }

    /**
     * Updates an existing Form model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $category = Category::find()->all();
        $status = Status::find()->all();
        $field = Field::find()->all();

        if ($model->load(Yii::$app->request->post())) {

            $model->user_update_id = Yii::$app->user->identity->id;

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('update', [
            'model' => $model,
            'category' => $category,
            'status' => $status,
            'field' => $field
        ]);
    }

    /**
     * Deletes an existing Form model.
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
     * Finds the Form model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Form the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Form::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetField()
    {
        $data = Field::find()->all();
        return Json::encode($data);
    }
}
