<?php

namespace backend\controllers;

use Yii;
use backend\models\Menu;
use backend\models\FileAttachment;
use backend\models\MenuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\db\Expression;
use yii\filters\VerbFilter;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends Controller
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
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Menu model.
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
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new Menu();

    //     if ($model->load(Yii::$app->request->post())){

    //         $model->logo_file = UploadedFile::getInstance($model, 'logo_file');

    //         $file_name = $model->file_name.rand(1, 4000).'.'.$model->logo_file->getExtension;
    //         $file_path = 'uploads/menu'.$file_name;
    //         $model->logo_file->saveAs($file_path);
    //         $model->logo_file = $file_path;

    //         $model->save();
    //         return $this->redirect(['view','id' => $model->id]);
    //     } 
    //         return $this->render('create', [
    //             'model' => $model,
    //         ]);
    // }

    public function actionCreate()
    {
    $model = new Menu();

    if ($this->request->isPost) {
        //$model->user = Yii::$app->user->identity->id;
        $model->load($this->request->post());
        $model->logo_file = UploadedFile::getInstances($model, 'logo_file');

        if ($model->validate()) {
           
            $model->date_created = new Expression('NOW()');
            $model->user = Yii::$app->user->identity->id;

            if ($model->save()) {

                if ($model->logo_file) {
    
                    foreach ($model->logo_file as $key => $value) {

                        $fname = explode(".", $value->name);

                        $newfilename = str_replace(" ","",$fname[0]).'-'.date('dmYHis');
                        $file_attachment = new FileAttachment();
                        $file_attachment->model = 'Menu'; 
                        $file_attachment->file_name = $value->name;
                        $file_attachment->file_type = pathinfo($value->name, PATHINFO_EXTENSION);
                        $file_attachment->file_extension = $newfilename . '.' . pathinfo($value->name, PATHINFO_EXTENSION);
                        
                        if ($file_attachment->save()) {
                            
                            $value->saveAs('@web/uploads/menu/' . $newfilename . '.' . pathinfo($value->name, PATHINFO_EXTENSION));
                        } else {
                            print_r($file_attachment->getErrors());
                            exit;
                        }
                    }
                  }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                print_r($model->getErrors());
                exit;
            }
            } else {
                print_r($model->getErrors());
                exit;
            }
        }

        // echo '<pre>';
        // print_r ($model);
        // exit;

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing Menu model.
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
     * Deletes an existing Menu model.
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
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDownload($id)
    {

    }
}
