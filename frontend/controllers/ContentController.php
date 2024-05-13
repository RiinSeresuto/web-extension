<?php

namespace frontend\controllers;

use backend\models\Pages;

class ContentController extends \yii\web\Controller
{
    public function actionIndex($type, $menu_id)
    {
        if ($type == 1) {
            $page = Pages::find()->where(['menu_id' => $menu_id])->one();

            return $this->render('index', ['page' => $page]);

        }
    }

}
