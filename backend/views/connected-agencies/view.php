<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ConnectedAgencies */

$this->title = $model->label;
$this->params['breadcrumbs'][] = ['label' => 'Connected Agencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="connected-agencies-view">

    <p>
        <?= Html::a('<i class="fas fa-arrow-circle-left"></i> Back', ['index', 'id' => $model->id], ['class' => 'btn btn-secondary btn-sm']) ?>
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
            [
                'attribute' => 'agency_type_id',
                'value' => function($model){
                    return $model->agencyType->agency_type;
                },
            ],
            'label',
            'agency_order',
            [
                'attribute' => 'status_id',
                'value' => function($model){
                    return $model->status->status_type;
                }
            ],
            'logo',
            'link',
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
            //'user_id',
            'user_update_id',
            //'date_created',
            'date_updated',
        ],
    ]) ?>

</div>
