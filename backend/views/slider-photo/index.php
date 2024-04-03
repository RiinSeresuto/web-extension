<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SliderPhotoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Slider Photos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-photo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Slider Photo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'caption',
            'status_id',
            'upload_photo',
            'url:url',
            //'user_id',
            //'user_update_id',
            //'date_created',
            //'date_updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
