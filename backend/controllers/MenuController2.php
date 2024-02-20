<?php

namespace backend\controllers;

use Yii;
use backend\models\Menu;
use backend\models\FileAttachment;
use backend\models\MenuSearch;
use backend\models\Position;
use backend\models\Status;

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
        $query = Menu::find()->orderBy(['date_created' => SORT_DESC])->all();
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $query,
        ]);

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

    public function actionCreate()
    {
    $model = new Menu();

    $status = Status::find()->all();
    $position = Position::find()->all();

    if ($this->request->isPost) {
        
        $info = Yii::$app->user->identity;
        $model->load($this->request->post());
        $file = UploadedFile::getInstances($model, 'file_input');
        
        
        $model->date_created = new Expression('NOW()');
        $model->user_id = Yii::$app->user->identity->id;
        // echo '<pre>';
        // print_r ($model->user_id);
        // exit;

        if ($model->validate()) {

            if ($model->save()) {
    

                if ($file) {
    
                    foreach ($file as $key => $value) {

                        $fname = explode(".", $value->name);

                        $newfilename = str_replace(" ","",$fname[0]).'-'.date('dmYHis');

                        $file_attachment = new FileAttachment();
                        $file_attachment->model = 'Menu'; 
                        $file_attachment->file_name = $value->name;
                        $file_attachment->file_type = pathinfo($value->name, PATHINFO_EXTENSION);
                        $file_attachment->file_extension = $newfilename . '.' . pathinfo($value->name, PATHINFO_EXTENSION);
                        $file_attachment->user_id = $model->user_id;
                        $file_attachment->record_id = $model->id;
                        $file_attachment->file_path = '@common/uploads/menu/' . $newfilename . '.' . pathinfo($value->name, PATHINFO_EXTENSION);
                        
                        // echo '<pre>';
                        // echo var_dump($model->id);
                        // exit;
                        if ($file_attachment->save()) {
                            
                            $value->saveAs('@common/uploads/menu/' . $newfilename . '.' . pathinfo($value->name, PATHINFO_EXTENSION));
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
            } 
            else {
                print_r($model->getErrors());
                exit;
            }
        }
        return $this->render('create', [
            'model' => $model,
            'status' => $status,
            'position' => $position
        ]);

    }

    public 


    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $status = Status::find()->all();
        $position = Position::find()->all();

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'status' => $status,
            'position' => $position
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
