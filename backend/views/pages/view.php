<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Pages */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pages-view">

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
            'menu_id',
           
            'title',
            'caption',
            'body:raw',
            [
                'attribute' => 'url_type_id',
                'value' => function($model){
                    return $model->urlType->url_type;
                },
            ],
            [
                'attribute' => 'status_id',
                'value' => function($model){
                    return $model->status->status_type;
                },
            ],
            [
                'attribute' => 'type_id',
                'value' => function($model){
                    return $model->type->type;
                },
            ],
            'link',
            'slider_photo',
            //'file_attachment',
            'user_id',
            [
                'attribute' => 'user_id',
                'value' => function($model){
                    return $model->user->username;
                },
            ],
            //'user_update_id',
            [
                'attribute' => 'date_created',
                'value' => function($model){
                    return ($model->date_created) ? date('F d, Y h:i A', strtotime($model->date_created)) : null; 
                },
            ],
            //'date_updated',
        ],
    ]) ?>

    <div class="row">
        <div class="col-md-12">
            <?=  '<label for="photo_attach">File Attachment</label>' ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'label' => 'File Attachment', 
                        'format' => 'raw',
                        'value' => function($model){
                        //return \file\components\AttachmentsTable::widget(['model' => $model]); 
                        return \attachment\components\AttachmentsInput::widget([
                            'id' => 'file-input', // Optional
                            'model' => $model,
                            'options' => [ // Options of the Kartik's FileInput widget
                                'multiple' => true, // If you want to allow multiple upload, default to false
                            ],
                            'pluginOptions' => [ // Plugin options of the Kartik's FileInput widget 
                                'initialPreviewShowDelete' => false,
                                'initialPreviewAsData' =>  true,
                                'initialPreviewFileType' => 'pdf',
                                'maxFileCount' => 10, // Client max files
                                'showRemove' => false,
                                'showCancel' => false,
                                'showUpload' => false,
                                'showBrowse' => false,
                                'showCaption' => false,
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

    <div class="row">
        <div class="col-md-12">
            <?=  '<label for="photo_attach">Slider Photo</label>' ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'label' => 'File Attachment', 
                        'format' => 'raw',
                        'value' => function($model){
                        //return \file\components\AttachmentsTable::widget(['model' => $model]); 
                        return \attachment\components\AttachmentsInput::widget([
                            'id' => 'file-input', // Optional
                            'model' => $model,
                            'options' => [ // Options of the Kartik's FileInput widget
                                'multiple' => true, // If you want to allow multiple upload, default to false
                            ],
                            'pluginOptions' => [ // Plugin options of the Kartik's FileInput widget 
                                'initialPreviewShowDelete' => false,
                                'initialPreviewAsData' =>  true,
                                'initialPreviewFileType' => 'pdf',
                                'maxFileCount' => 10, // Client max files
                                'showRemove' => false,
                                'showCancel' => false,
                                'showUpload' => false,
                                'showBrowse' => false,
                                'showCaption' => false,
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
