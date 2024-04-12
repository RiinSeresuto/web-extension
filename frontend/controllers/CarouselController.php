<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\File;

class CarouselController extends Controller
{
    public static function actionImageSlider($item_id)
    {
        $modelImg = File::find()->where(['item_id' => $item_id])->andWhere(['model' => "backend\models\SliderPhoto"])->one();

        $folder1 = substr(basename($modelImg->hash), 0, 2) . "/";
        $folder2 = substr(basename($modelImg->hash), 3, 2) . "/";
        $folder3 = substr(basename($modelImg->hash), 6, 2) . "/";
        $filename = $modelImg->hash . "." . $modelImg->type;

        $link = '@common/uploads/store/' . $folder1 . $folder2 . $folder3 . $filename;
        $path = Yii::getAlias($link);
        // $files = FileHelper::findFiles($path);

        if (file_exists($path)) {
            // return $path;
            $imageData = file_get_contents($path);
            $contentType = mime_content_type($path);
            Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
            Yii::$app->response->headers->add('Content-Type', $contentType);
            return $imageData;
        } else {
            return 'Image not found';
        }
    }
}
?>