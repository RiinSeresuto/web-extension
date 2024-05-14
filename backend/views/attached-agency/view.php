<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AttachedAgency */

$this->title = $model->label;
$this->params['breadcrumbs'][] = ['label' => 'Attached Agencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="attached-agency-view">
    <div class="card">
        <div class="card-header">
            Agency Details
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
                    'label',
                    'order',
                    [
                        'attribute' => 'status_id',
                        'value' => function ($model) {
                            return $model->status->status_type;
                        },
                    ],
                    'url:url',
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
            Logo
        </div>

        <div class="card-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'label' => '',
                        'format' => 'raw',
                        'value' => function ($model) {
                            //return \file\components\AttachmentsTable::widget(['model' => $model]); 
                            return \attachment\components\AttachmentsInput::widget([
                                'id' => 'file-input', // Optional
                                'model' => $model,
                                'options' => [ // Options of the Kartik's FileInput widget
                                    'multiple' => true, // If you want to allow multiple upload, default to false
                                ],
                                'pluginOptions' => [
                                    'initialPreviewShowDelete' => false,
                                    'initialPreviewAsData' => true,
                                    'initialPreviewFileType' => 'pdf',
                                    'maxFileCount' => 10, // Client max files
                                    'showRemove' => false,
                                    'showCancel' => false,
                                    'showUpload' => false,
                                    'showBrowse' => false,
                                    'showCaption' => false,
                                    'showClose' => false,
                                    'fileActionSettings' => [
                                        'showRemove' => false,
                                        //'showDownload' => true,
                                    ],
                                    'previewFileType' => 'pdf'
                                ],
                            ]);
                        },
                    ]
                ]
            ])
                ?>
        </div>
    </div>
</div>