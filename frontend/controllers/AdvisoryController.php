<?php

namespace frontend\controllers;

use backend\models\Post;

class ArticleController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
        $post = Post::findOne($id);
        $advisory = Post::find()->where(['category_id' => 4])->limit(4)->orderBy(['id' => SORT_DESC])->all();

        return $this->render("index", [
            "post" => $post->body,
            'advisory' => $advisory,
        ]);
    }

}