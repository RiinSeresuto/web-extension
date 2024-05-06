<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $user yii\web\View */
/* @var $items yii\web\View */
/* @var $model backend\models\Menu */

$this->title = $model->label;
$this->params['breadcrumbs'][] = ['label' => 'Menu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="menu-view">
    <div class="card">
        <div class="card-header">
            Menu Details: <?= $this->title = $model->label; ?>
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
                    [
                        'attribute' => 'parent_id',
                        'value' => function ($model) {
                            if ($model->parentLabel) {
                                return $model->parentLabel->label;
                            }
                        }
                    ],
                    'label',
                    'menu_order',
                    [
                        'attribute' => 'position_id',
                        'value' => function ($model) {
                            return $model->position->position;
                        },
                    ],
                    [
                        'attribute' => 'status_id',
                        'value' => function ($model) {
                            return $model->status->status_type;
                        },
                    ],
                    'link',
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
                            return $model->user_update_id == null ? "(not set)" : $model->updateUser->username;
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


            <div class="row">
                <div class="col-md-12">
                    <?php //  '<label for="photo_attach">File Attachment</label>' ?>
                    <?php // DetailView::widget([
                    //     'model' => $model,
                    //     'attributes' => [
                    //         [
                    //             'label' => 'File Attachment', 
                    //             'format' => 'raw',
                    //             'value' => function($model){
                    //             //return \file\components\AttachmentsTable::widget(['model' => $model]); 
                    //             return \attachment\components\AttachmentsInput::widget([
                    //                 'id' => 'file-input', // Optional
                    //                 'model' => $model,
                    //                 'options' => [ // Options of the Kartik's FileInput widget
                    //                     'multiple' => true, // If you want to allow multiple upload, default to false
                    //                 ],
                    //                 'pluginOptions' => [ 
                    //                     'initialPreviewShowDelete' => false,
                    //                     'initialPreviewAsData' =>  true,
                    //                     'initialPreviewFileType' => 'pdf',
                    //                     'maxFileCount' => 10, // Client max files
                    //                     'showRemove' => false,
                    //                     'showCancel' => false,
                    //                     'showUpload' => false,
                    //                     'showBrowse' => false,
                    //                     'showCaption' => false,
                    //                     'fileActionSettings' => [
                    //                         'showRemove' => false,
                    //                         //'showDownload' => true,
                    //                     ],
                    //                     'previewFileType' => 'pdf'
                    //                 ],
                    //                 ]);
                    //             },
                    //         ]
                    //     ]
                    // ])
                    // ?>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            File Attachment
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
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
    </div>
</div>