<?php

namespace frontend\controllers;

use backend\models\Post;
use yii\data\ActiveDataProvider;

class ArticleController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
        $post = Post::findOne($id);
        $central_news = Post::find()->where(['category_id' => 1])->limit(3)->orderBy(['id' => SORT_DESC])->all();

        return $this->render("index", [
            "post" => $post->body,
            'central_news' => $central_news,
        ]);
    }

    public function actionLists($category_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->where(['category_id' => $category_id])->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('lists', [
            'dataProvider' => $dataProvider,
        ]);
    }

}