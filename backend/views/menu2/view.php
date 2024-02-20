<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\file\FileInput;


/* @var $this yii\web\View */
/* @var $model backend\models\Menu */

$this->title = $model->label;
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$viewableFiles = array();
$downloadableFiles = array();
$config = array();

if ($model->file_attach) {
    foreach ($model->file_attach as $index => $file) {
        
        $image_url = Url::to(['menu/download', 'id'=>$file->id]);
        echo '<pre>';
        echo var_dump($image_url);
        exit;
        $config[] = ['type' => 'pdf', 'caption' => $file->name, 'url' => Yii::getAlias('@common/uploads/menu/'). $file_attachment->file_extension, 'key' => $file->id];
        $viewableFiles[] = $image_url;
    }
}

?>

<div class="menu-view">

    <div class="text-right">
        <p>
            <?= Html::a('<i class="fas fa-arrow-circle-left"></i> Back', ['index'], ['class' => 'btn btn-secondary btn-sm']) ?>
                <?= Html::a('<i class="fas fa-arrow-circle-left"></i> Detailed View', ['view', 'id' => $model->id], ['class' => 'btn btn-info btn-sm']) ?>
                <?= Html::a('<i class="fas fa-arrow-circle-left"></i> Actual View', ['view','id' => $model->id], ['class' => 'btn btn-success btn-sm']) ?>
                <?= Html::a('<i class="fas fa-pen"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
                <?= Html::a('<i class="fas fa-trash"></i> Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn-sm',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                    ]) 
            ?>
        </p>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'parent_id',
            'label',
            'menu_order',

            [
                'attribute' => 'position_id',
                'value' => function($model){
                    return $model->position->position;
                },
            ],
            [
                'attribute' => 'status_id',
                'value' => function($model){
                    return $model->status->status_type;
                },
            ],
            'link',
            //'logo_file',
            [
                'attribute' => 'user_id',
                'value' => function($model){
                    return $model->user->username;
                },
            ],
            [
                'attribute' => 'user_update_id',
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
                'attribute' => 'date_updated',
                'value' => function($model){
                    return ($model->date_updated) ? date('F d, Y h:i A', strtotime($model->date_updated)) : null; 
                },
            ],

            [
                'label' => 'File Upload', 'format' => 'raw',
                'value' => function($model){
                  //return \file\components\AttachmentsTable::widget(['model' => $model]); 
                //   return \file\components\AttachmentsInput::widget([
                //     'id' => 'file-input', // Optional
                //     'model' => $model,
                //     'options' => [ // Options of the Kartik's FileInput widget
                //         'multiple' => true, // If you want to allow multiple upload, default to false
                //     ],
                //     'pluginOptions' => [ // Plugin options of the Kartik's FileInput widget 
                //         'maxFileCount' => 10, // Client max files
                //         'showRemove' => false,
                //         'showCancel' => false,
                //         'showUpload' => false,
                //         'showBrowse' => false,
                //         'fileActionSettings' => [
                //             'showRemove' => false
                //         ],
                //         'previewFileType' => 'any'
                //     ]
                //     ]);
                return FileInput::widget([
                    'name' => 'attachment_49[]',
                    'options'=>[
                        'multiple'=>true
                    ],
                    'pluginOptions' => [
                        'initialPreview'=>[
                            "common\uploads\store\f1\3a\18\f153af18aa2262bbbf053a4a422add1f.pdf"
                        ],
                        //'initialPreview' => $viewableFiles,
                        'initialPreviewAsData'=>true,
                        'initialCaption'=>"The Moon and the Earth",
                        'initialPreviewConfig' => [
                            ['caption' => 'Model.jpg', 'size' => '873727'],
                        ],
                        'overwriteInitial'=>false,
                        'maxFileSize'=>2800
                    ]
                ]);
                },
            ]

        ],
    ]) ?>

<!-- Panel -->
<div class="panel panel-info">
        <div class="panel-heading">
            <b>Attached Files </b>
        </div>
        <div class="panel-body">
            <?php 
                // echo '<pre>';
                // echo var_dump($model->file_attach);
                // exit;
                        ?>
            <?php if ($model->file_attach) : ?>
            
                <div class="col-md-12">
                    <h5>
                        <b>Legends:</b>
                        <span style="margin-left: 10px;"> <i class="glyphicon glyphicon-zoom-in"> </i> View</span>
                        <span style="margin-left: 10px;"> <span> <i class="glyphicon glyphicon-download"></i> </span> Download</span>
                        
                    </h5>
                </div>

                <?php if ($viewableFiles) :?>
                    <div class="col-md-12" style="margin-top: 5px;">
                        <?php
                            // echo FileInput::widget([
                            //     'model' => $viewableFiles,
                            //     'name' => 'attachment_1[]',
                            //     'options'=>[
                            //         'multiple'=>true
                            //     ],
                            //     'pluginOptions' => [
                            //         // 'initialPreview' => $viewableFiles,
                            //         'initialPreviewDownloadUrl' => [
                            //             Url::to(['menu/download?id={key}'])
                            //         ],
                            //         'initialPreviewFileType' => 'image',
                            //         'initialPreviewAsData'=>true,
                            //         'initialPreviewConfig' => $config,
                            //         'overwriteInitial'=>false,
                            //     ],
                            // ]);
                            FileInput::widget([
                                'name' => 'attachment_49[]',
                                'options'=>[
                                    'multiple'=>true
                                ],
                                'pluginOptions' => [
                                    'initialPreview'=>[
                                        "common\uploads\store\f1\3a\18\f153af18aa2262bbbf053a4a422add1f.pdf"
                                    ],
                                    'initialPreviewAsData'=>true,
                                    'initialCaption'=>"The Moon and the Earth",
                                    'initialPreviewConfig' => [
                                        ['caption' => 'Model.jpg', 'size' => '873727'],
                                    ],
                                    'overwriteInitial'=>false,
                                    'maxFileSize'=>2800
                                ]
                            ]);
                        ?>
                    </div>
                <?php endif ?>


                
            <?php else : ?>
                <div class="col-md-12" style="padding: 0px;">
                    <div class="alert alert-info">
                    <i class="glyphicon glyphicon-info-sign"> </i>
                        No files/attachments to show.
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
<!-- End Panel -->

</div>
