<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SliderBannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Slider & Banner';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-banner-index">

    <p>
        <?= Html::a('Create Slider Banner', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'caption',
            //'file_attachment',
            //'logo',
            'link',
            //'user_id',
            //'user_update_id',
            //'date_created',
            //'date_updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
