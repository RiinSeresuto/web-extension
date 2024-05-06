<?php

namespace frontend\controllers;

use backend\models\Post;

class ArticleController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
        $post = Post::findOne($id);
        $central_news = Post::find()->where(['category_id' => 1])->limit(4)->orderBy(['id' => SORT_DESC])->all();

        return $this->render("index", [
            "post" => $post->body,
            'central_news' => $central_news,
        ]);
    }

}