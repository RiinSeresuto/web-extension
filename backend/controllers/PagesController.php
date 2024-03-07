<?php

namespace backend\controllers;

use Yii;
use backend\models\Status;
use backend\models\UrlType;
use backend\models\Pages;
use backend\models\PagesSearch;
use backend\models\Type;
use backend\models\Menu;
use backend\models\File;

use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;

/**
 * PagesController implements the CRUD actions for Pages model.
 */
class PagesController extends Controller
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
     * Lists all Pages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $url_type = UrlType::find()->all();
        $status = Status::find()->all();
        $type = Type::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'url_type' => $url_type,
            'status' => $status,
            'type' => $type
        ]);
    }

    /**
     * Displays a single Pages model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
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

        return $this->render('view', [
            'model' => $this->findModel($id),
            'items' => $items
        ]);
    }

    /**
     * Creates a new Pages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pages();
        $url_type = UrlType::find()->all();
        $status = Status::find()->all();
        $type = Type::find()->all();
        $menu = Menu::find()->all();

        if ($model->load(Yii::$app->request->post())) {

            $model->user_id = Yii::$app->user->identity->id;

            if ($model->save())
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $menus = Menu::find()->where(['position_id' => 1])->orderBy(['menu_order' => SORT_ASC])->all();
        $children = [];
        $childrenPath = [];

        foreach($menus as $menu){
            if(empty($menu->menuChildren)){
                $children[] = $menu;
            }
        }
        
        foreach($children as $child){
            if(!empty($child->parent_id)){
                $label = $this->getParent($child->parent_id);

                $childrenPath[$child->id] = $label . ' / ' . $child->label;
            } else {
                $childrenPath[$child->id] = $child->label;
            }
        }

        return $this->render('create', [
            'model' => $model,
            'url_type' => $url_type,
            'status' => $status,
            'type' => $type,
            'menu' => $menu,
            'childrenPath' => $childrenPath
        ]);
    }

    /**
     * Updates an existing Pages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $url_type = UrlType::find()->all();
        $status = Status::find()->all();
        $type = Type::find()->all();
        $menu = Menu::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'url_type' => $url_type,
            'status' => $status,
            'type' => $type,
            'menu' => $menu
        ]);
    }

    /**
     * Deletes an existing Pages model.
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
     * Finds the Pages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function getParentMenus()
    {
        return Menu::find()
            ->select(['id', 'label'])
            ->where(['parent_id' => null])
            ->orderBy('menu_order')
            ->asArray()
            ->all();
    }

    

    private function getParent($parent_id){
        $parent = Menu::find()->where(['id' => $parent_id])->one();

        $parent_label = $parent->label;

        if(!empty($parent->parent_id)){
            $grand_parent = $this->getParent($parent->parent_id);

            return $grand_parent . ' / ' . $parent_label;
        } else {
            return $parent_label;
        }

        //print_r($parent_label);
        
        //return $string;
    }

}
