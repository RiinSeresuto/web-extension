<?php

namespace backend\controllers;

use Yii;
use backend\models\SliderBanner;
use backend\models\SliderBannerSearch;
use backend\models\SliderBannerType;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;

/**
 * SliderBannerController implements the CRUD actions for SliderBanner model.
 */
class SliderBannerController extends \niksko12\auditlogs\classes\ControllerAudit
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
     * Lists all SliderBanner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SliderBannerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $sliderBannerType = SliderBannerType::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'sliderBannerType' => $sliderBannerType
        ]);
    }

    /**
     * Displays a single SliderBanner model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        // return $this->render('view', [
        //     'model' => $this->findModel($id),
        // ]);

        $items = [];
        $path = Yii::getAlias('@common/uploads/store');
        $files = FileHelper::findFiles($path);
        //$menu = Menu::find()->all();

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
            //'menu' => $menu
        ]);
    }

    /**
     * Creates a new SliderBanner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SliderBanner();
        $sliderBannerType = SliderBannerType::find()->all();

        if ($model->load(Yii::$app->request->post())) {

            $model->user_id = Yii::$app->user->identity->id;

            if ($model->save())
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'sliderBannerType' => $sliderBannerType
        ]);
    }

    /**
     * Updates an existing SliderBanner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $sliderBannerType = SliderBannerType::find()->all();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->user_update_id = Yii::$app->user->identity->id;
            
            if ($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        }

        return $this->render('update', [
            'model' => $model,
            'sliderBannerType' => $sliderBannerType
        ]);
    }

    /**
     * Deletes an existing SliderBanner model.
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
     * Finds the SliderBanner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SliderBanner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SliderBanner::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
