<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Field */

$this->title = $model->label;
$this->params['breadcrumbs'][] = ['label' => 'Fields', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="field-view">
    <div class="card">
        <div class="card-button">
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
                        'label',
                        [
                            'attribute' => 'data_type_id',
                            'value' => $model->dataType->data_type
                        ],
                        [
                            'attribute' => 'widget_type_id',
                            'value' => $model->widgetType->widget_type
                        ],
                        [
                            'attribute' => 'user_id',
                            'value' => $model->user->username
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
    </div>
</div>
