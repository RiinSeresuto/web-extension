<?php

namespace backend\controllers;

use Yii;
use backend\models\Field;
use backend\models\FieldSearch;
use backend\models\DataType;
use backend\models\WidgetType;
use backend\models\WidgetSelect2Items;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FieldController implements the CRUD actions for Field model.
 */
class FieldController extends \niksko12\auditlogs\classes\ControllerAudit
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
     * Lists all Field models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FieldSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ['date_created' => SORT_DESC];
        
        $data_type = DataType::find()->all();
        $widget_type = WidgetType::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data_type' => $data_type,
            'widget_type' => $widget_type
        ]);
    }

    /**
     * Displays a single Field model.
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
     * Creates a new Field model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelField = new Field();
        $modelWidgetSelect2Items = [];
        $data_type = DataType::find()->all();
        $widget_type = WidgetType::find()->all();

        if ($modelField->load(Yii::$app->request->post())) {

            $modelField->user_id = Yii::$app->user->identity->id;

            if ($modelField->save()) {
                if ($modelField->widget_type_id == 3) {
                    $count = count(Yii::$app->request->post("WidgetSelect2Items", []));

                    for ($i = 0; $i < $count; $i++) {
                        $modelWidgetSelect2Items[$i] = new WidgetSelect2Items();
                    }

                    if (WidgetSelect2Items::loadMultiple($modelWidgetSelect2Items, Yii::$app->request->post())) {
                        foreach ($modelWidgetSelect2Items as $model) {
                            $model->field_id = $modelField->id;

                            $model->save(false);
                        }
                    }
                }
                return $this->redirect(['view', 'id' => $modelField->id]);
            }
        }


        $modelWidgetSelect2Items = new WidgetSelect2Items();

        return $this->render('create', [
            'modelField' => $modelField,
            'data_type' => $data_type,
            'widget_type' => $widget_type,
            'modelWidgetSelect2Items' => $modelWidgetSelect2Items
        ]);

    }

    /**
     * Updates an existing Field model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $modelField = $this->findModel($id);
        $data_type = DataType::find()->all();
        $widget_type = WidgetType::find()->all();
        $modelWidgetSelect2Items = WidgetSelect2Items::find()->where(['field_id' => $id])->all();

        if ($modelField->load(Yii::$app->request->post())) {

            $modelField->user_update_id = Yii::$app->user->identity->id;

            if ($modelField->save()) {
                if ($modelField->widget_type_id == 3) {

                    if (WidgetSelect2Items::loadMultiple($modelWidgetSelect2Items, Yii::$app->request->post())) {
                        foreach ($modelWidgetSelect2Items as $model) {
                            $model->save(false);
                        }
                    }
                }

                return $this->redirect(['view', 'id' => $modelField->id]);
            }
        }


        return $this->render('update', [
            'modelField' => $modelField,
            'data_type' => $data_type,
            'widget_type' => $widget_type,
            'modelWidgetSelect2Items' => $modelWidgetSelect2Items
        ]);
    }

    /**
     * Deletes an existing Field model.
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
     * Finds the Field model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Field the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Field::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDisplayFiedView()
    {
        $model = new Field();
        if ($model->load(Yii::$app->request->post())) {

            return $this->render('field_view', [
                'label' => $model->label,
            ]);
        } else {
            return $this->render('_form', [
                'model' => $model
            ]);
        }
    }
}
