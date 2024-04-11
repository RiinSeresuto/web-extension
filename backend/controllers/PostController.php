<?php

namespace backend\controllers;

use backend\models\FormField;
use Yii;
use backend\models\Post;
use backend\models\PostSearch;
use backend\models\Form;
use backend\models\Field;
use backend\models\Status;
use backend\models\VisibilityType;
use backend\models\PublishType;
use backend\models\Pages;
use backend\models\Category;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends \niksko12\auditlogs\classes\ControllerAudit
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
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $category = Category::find()->all();
        $forms = Form::find()->all();
        $status = Status::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'category' => $category,
            'forms' => $forms,
            'status' => $status
        ]);
    }

    /**
     * Displays a single Post model.
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
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($form_id = null)
    {
        $model = new Post();
        $category = Category::find()->all();
        $forms = Form::find()->all();
        $field = Field::find()->all();
        $status = Status::find()->all();
        $visibility_type = VisibilityType::find()->all();
        $publish_type = PublishType::find()->all();
        $page = Pages::find()->all();

        if ($form_id == null) {

            return $this->render('create', [
                'model' => $model,
                'category' => $category,
                'forms' => $forms,
                'field' => $field,
                'status' => $status,
                'visibility_type' => $visibility_type,
                'publish_type' => $publish_type,
                'page' => $page
            ]);
        } else {
            $form_fields = FormField::find()->where(['form_id' => $form_id])->all();

            $form_title = Form::find()->where(['id' => $form_id])->one();

            if ($model->load(Yii::$app->request->post())) {
                $data = Yii::$app->request->post();

                unset($data['_csrf-backend']);
                unset($data['Post']);

                // echo "<pre>";
                // print_r($data);
                // exit;

                $model->forms_id = $form_id;
                $model->body = json_encode($data);

                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    echo '<pre>';
                    print_r($model->errors);
                    exit;
                }
            }

            return $this->render('create', [
                'model' => $model,
                'category' => $category,
                'forms' => $forms,
                'field' => $field,
                'status' => $status,
                'visibility_type' => $visibility_type,
                'publish_type' => $publish_type,
                'page' => $page,
                'form_fields' => $form_fields,
                'form_title' => $form_title
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();

            unset($data['_csrf-backend']);
            unset($data['Post']);

            $model->body = json_encode($data);

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        // echo '<pre>';
        // print_r($model->forms_id);
        // exit;

        return $this->render('update', [
            'model' => $model,
            'category' => Category::find()->all(),
            'form_fields' => FormField::find()->where(['form_id' => $model->forms_id])->all(),
            'status' => Status::find()->all(),
            'visibility_type' => VisibilityType::find()->all(),
            'publish_type' => PublishType::find()->all(),
            'page' => Pages::find()->all()
        ]);
    }

    /**
     * Deletes an existing Post model.
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
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
