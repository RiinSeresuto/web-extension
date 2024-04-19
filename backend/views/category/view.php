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
    <div class="card">
        <h5 class="card-header">Category Details: <?= $this->title = $model->title; ?></h5>
            <div class="text-right buttons">
                <?= Html::a('<i class="fas fa-arrow-circle-left"></i> Back', ['index', 'id' => $model->id], ['class' => 'btn btn-secondary btn-sm']) ?>
                    <?= Html::a('<i class="fas fa-edit"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
                    <?= Html::a('<i class="fas fa-trash-alt"></i> Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger btn-sm',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
            </div>
            <div class="card-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'title',
                        [
                            'attribute' => 'status_id',
                            'value' => function($model){
                                return $model->status->status_type;
                            },
                        ],
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
                        [
                            'attribute' => 'user_update_id',
                            'value' => function ($model) {
                                return $model->user_update_id == null ? "(not set)" : $model->userUpdate->username;
                            },
                        ],
                        [
                            'attribute' => 'date_updated',
                            'value' => function ($model) {
                                return $model->date_updated == null ? "(not set)" : date('F d, Y h:i A', strtotime($model->date_updated));
                            }
                        ]
                    ],
                ]) ?>
            </div>
    </div>


    

</div>
