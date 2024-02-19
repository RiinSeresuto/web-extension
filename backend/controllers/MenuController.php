<?php

namespace backend\controllers;

use Yii;
use backend\models\Menu;
use backend\models\MenuSearch;
use backend\models\Position;
use backend\models\Status;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;

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
    // public function actionView($id)
    // {
    //     $user =  Yii::$app->user->identity->FIRST_M;
    //     return $this->render('view', [
    //         'model' => $this->findModel($id),
    //         'user' => $user
    //     ]);
    // }
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

        //$model =  $this->findModel($id);
        //echo "<pre>";
        //print_r($model);
        //echo "</pre";
        //exit;

        return $this->render('view', [
            'model' => $this->findModel($id),
            'items' => $items
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

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save())
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'status' => $status,
            'position' => $position
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
}
