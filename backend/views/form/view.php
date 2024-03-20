<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Form */

$this->title = $model->category->title;
$this->params['breadcrumbs'][] = ['label' => 'Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="form-view">

    <!-- <p>
        <?php // Html::a('<i class="fas fa-edit"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?php // Html::a('<i class="fas fa-trash-alt"></i> Delete', ['delete', 'id' => $model->id], [
        //     'class' => 'btn btn-danger btn-sm',
        //     'data' => [
        //         'confirm' => 'Are you sure you want to delete this item?',
        //         'method' => 'post',
        //     ],
        // ]) ?>
    </p> -->

    <div class="card">
        <div class="card-header">
            Form Details: <?= $this->title = $model->category->title; ?>
        </div>
        <p class="text-right buttons">
            <?= Html::a('<i class="fas fa-arrow-circle-left"></i> Back', ['index', 'id' => $model->id], ['class' => 'btn btn-info btn-sm']) ?>
            <?= Html::a('<i class="fas fa-edit"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::a('<i class="fas fa-trash-alt"></i> Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-sm',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
        <div class="card-body">
            <!-- <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute' => 'category_id',
                            'value' => function($model){
                                return $model->category->title;
                            },
                        ],
                        'description',
                        [
                            'attribute' => 'status_id',
                            'value' => function($model){
                                return $model->status->status_type;
                            },
                        ],
                        'year',
                        
                        [
                            'attribute' => 'user_id',
                            'value' => function($model){
                                return $model->user->username;
                            },
                        ],
                        // [
                        //     'attribute' => 'user_update_id',
                        //     'value' => function($model){
                        //         return $model->user->username;
                        //     },
                        // ],
                        'user_update_id',
                        [
                            'attribute' => 'date_created',
                            'value' => function($model){
                                return ($model->date_created) ? date('F d, Y h:i A', strtotime($model->date_created)) : null; 
                            },
                        ],
                        [
                            'attribute' => 'date_updated',
                            'value' => function($model){
                                return ($model->date_updated) ? date('F d, Y h:i A', strtotime($model->date_updated)) : null; 
                            },
                        ],
                    ],
                ]) ?>
            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
            <div class="row view-field">
                <div class="col-md-12">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'field_id',
                        ]
                    ])            
                    ?>
                </div>
            </div>
        </div>
    </div>

    

    

</div>
