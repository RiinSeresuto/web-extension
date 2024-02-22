<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">

    <p>
        <?= Html::a('<i class="fas fa-plus fa-sm"></i> Create Pages', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    </p>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'menu_id',
            'title',
            //'caption',
            //'body:ntext',
            'url_type_id:url',
            'status_id',
            'type_id',
            //'link',
            //'slider_photo',
            //'file_attachment',
            'user_id',
            //'user_update_id',
            'date_created',
            //'date_updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
