<?php

namespace backend\controllers;

use kartik\form\ActiveForm;
use Yii;
use backend\models\Field;
use backend\models\FieldSearch;
use backend\models\DataType;
use backend\models\WidgetType;
use backend\models\WidgetSelect2Items;
use backend\models\Model;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\web\Controller;
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
        $data_type = DataType::find()->all();
        $widget_type = WidgetType::find()->all();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
        $model = new Field();
        $data_type = DataType::find()->all();
        $widget_type = WidgetType::find()->all();
        $modelParent = new Field();
        $modelsChildren = [new WidgetSelect2Items];

        // if ($model->load(Yii::$app->request->post())) {

        //     $model->user_id = Yii::$app->user->identity->id;

        //     if ($model->save())
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }

        if ($modelParent->load(Yii::$app->request->post())) {
            
            $modelsChildren = Model::createMultiple(WidgetSelect2Items::classname(), $modelsChildren);
            Model::loadMultiple($modelsChildren, Yii::$app->request->post());
           
            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsChildren),
                    ActiveForm::validate($modelParent)
                );
            }

            // validate all models
            $valid = $modelParent->validate();
            $valid = !empty($modelsChildren[0]) && $valid;
            //echo "<pre>"; print_r($valid); exit;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelParent->save(false)) {
                        foreach ($modelsChildren as $child) {
                            $child->form_id = $modelParent->id;
                            if (! ($flag = $child->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelParent->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

            $errors = $modelParent->getErrors();
            print_r($errors);
        }


        return $this->render('create', [
            'model' => $model,
            'data_type' => $data_type,
            'widget_type' => $widget_type,
            'modelParent' => $modelParent,
            'modelsChildren' => (empty($modelsChildren)) ? [new WidgetSelect2Items] : $modelsChildren
        ]);

        // return $this->render('create', [
        //     'model' => $model,
        //     'data_type' => $data_type,
        //     'widget_type' => $widget_type
        // ]);

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
        $model = $this->findModel($id);
        $data_type = DataType::find()->all();
        $widget_type = WidgetType::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'data_type' => $data_type,
            'widget_type' => $widget_type
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
