<?php

namespace backend\controllers;

use Yii;
use backend\models\Menu;
use backend\models\MenuSearch;
use backend\models\Position;
use backend\models\Status;
use backend\models\File;
use backend\models\UrlType;
use backend\models\ContentType;

use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends \niksko12\auditlogs\classes\ControllerAudit
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
        
        $status = Status::find()->all();
        $position = Position::find()->all();
        $url_type = UrlType::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'status' => $status,
            'position' => $position,
            'url_type' => $url_type
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
        $items = [];
        $path = Yii::getAlias('@common/uploads/store');
        $files = FileHelper::findFiles($path);
        $menu = Menu::find()->all();

        foreach ($files as $file) {
          $item = [
            "url"=>Yii::$app->urlManager->baseUrl . 'uploads/store/' . substr(basename($file), 0, 2) . '/' . substr(basename($file), 3, 2) . '/' . substr(basename($file), 6, 2) . '/' . basename($file),
            "src"=>Yii::$app->urlManager->baseUrl . 'uploads/store/' . substr(basename($file), 0, 2) . '/' . substr(basename($file), 3, 2) . '/' . substr(basename($file), 6, 2) . '/' . basename($file),
        ];
          $items[]=$item;
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'items' => $items,
            'menu' => $menu
        ]);
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Menu();

        $status = Status::find()->all();
        $position = Position::find()->all();
        $menu = Menu::find()->all();
        $url_type = UrlType::find()->all();
        $content_type = ContentType::find()->all();

        if ($model->load(Yii::$app->request->post())) {

            $model->user_id = Yii::$app->user->identity->id;

            if ($model->save())
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'status' => $status,
            'position' => $position,
            'menu' => $menu,
            'url_type' => $url_type,
            'content_type' => $content_type
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

        $status = Status::find()->all();
        $position = Position::find()->all();
        $menu = Menu::find()->all();
        $url_type = UrlType::find()->all();
        $content_type = ContentType::find()->all();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->user_update_id = Yii::$app->user->identity->id;
            
            if ($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        }

        return $this->render('update', [
            'model' => $model,
            'status' => $status,
            'position' => $position,
            'menu' => $menu,
            'url_type' => $url_type,
            'content_type' => $content_type
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
        $file = File::find()->andWhere(['id'=>$id])->one();
        // $filePath = Yii::getAlias('@common'). '/../'. $file->file_path;
        $filePath = $file->dbStorePath;
        if(file_exists($filePath)){
            return Yii::$app->response->sendFile($filePath, $file->file_name, ['inline'=>true]);
        }
    }
}
