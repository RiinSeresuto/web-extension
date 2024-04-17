<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */

$this->title = $model->forms->category->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-view">
    <div class="card border-primary mb-3">
        <div class="card-header">
            Post Details
        </div>

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
                    //'forms_id',
                    //'field_id',
                    //'tags',
                    [
                        'attribute' => 'status_id',
                        'value' => function ($model) {
                            return $model->status->status_type;
                        },
                    ],
                    [
                        'attribute' => 'visibility_id',
                        'value' => function ($model) {
                            return $model->visibility->visibility_type;
                        },
                    ],
                    [
                        'attribute' => 'publish_id',
                        'value' => function ($model) {
                            return $model->publish->publish_type;
                        },
                    ],
                    'page_id',
                    // [
                    //     'attribute' => 'page_id',
                    //     'value' => function ($model) {
                    //         return $model->page->;
                    //     }
                    // ],
                    //'start_date_time',
                    [
                        'attribute' => 'start_date_time',
                        'value' => function ($model) {
                            return $model->start_date_time == null ? "(not set)" : date('F d, Y h:i A', strtotime($model->start_date_time));
                        }
                    ],
                    //'end_date_time',
                    [
                        'attribute' => 'end_date_time',
                        'value' => function ($model) {
                            return $model->end_date_time == null ? "(not set)" : date('F d, Y h:i A', strtotime($model->end_date_time));
                        }
                    ],
                    'min_answer',
                    'max_answer',
                    [
                        'attribute' => 'user_id',
                        'value' => function ($model) {
                            return $model->user->username;
                        },
                    ],
                    [
                        'attribute' => 'date_created',
                        'value' => function ($model) {
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

    <div class="card">
        <div class="card-header">
            Post Content
        </div>

        <div class="card-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'body'
                ],
            ]) ?>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Post Attachment
        </div>

        <div class="card-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'body'
                ],
            ]) ?>
        </div>
    </div>
</div>