<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DilgInfoSystemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dilg Info Systems';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dilg-info-systems-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Dilg Info Systems', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'label',
            'order',
            'status_id',
            'logo',
            //'link',
            //'user_id',
            //'user_update_id',
            //'date_created',
            //'date_updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
