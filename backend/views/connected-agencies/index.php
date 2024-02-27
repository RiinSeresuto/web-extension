<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ConnectedAgenciesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Connected Agencies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="connected-agencies-index">

    <p>
        <?= Html::a('Create Connected Agencies', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    </p>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'agency_type_id',
            'label',
            'agency_order',
            'status_id',
            //'logo',
            //'link',
            'user_id',
            //'user_update_id',
            'date_created',
            //'date_updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
