<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="category-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'title',
            //'status_id',
            [
                'attribute' => 'status_id',
                'value' => function($model){
                    return $model->status->status_type;
                },
            ],
            //'user_id',
            //'user_update_id',
            //'date_created',
            //'date_updated',
            [
                'attribute' => 'user_id',
                'value' => function($model){
                    return $model->user->username;
                },
            ],
            [
                'attribute' => 'date_created',
                'value' => function($model){
                    return ($model->date_created) ? date('F d, Y h:i A', strtotime($model->date_created)) : null; 
                },
            ],
        ],
    ]) ?>

</div>
