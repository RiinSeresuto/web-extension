<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $user yii\web\View */
/* @var $items yii\web\View */
/* @var $model backend\models\Menu */

$this->title = $model->label;
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="menu-view">

    <p>
        <?= Html::a('<i class="fas fa-arrow-circle-left"></i> Back', ['index', 'id' => $model->id], ['class' => 'btn btn-secondary btn-sm']) ?>
        <?= Html::a('<i class="fas fa-info-circle"></i> Detailed View', ['/', 'id' => $model->id], ['class' => 'btn btn-info btn-sm']) ?>
        <?= Html::a('<i class="fas fa-eye"></i> Actual View', ['/', 'id' => $model->id], ['class' => 'btn btn-success btn-sm']) ?>
        <?php // Html::a('<i class="fas fa-eye"></i> Actual View', ['/', 'id' => $model->id], ['class' => 'btn btn-sm', 'style' => 'background-color: green; color: white;']) ?>
        <?= Html::a('<i class="fas fa-edit"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a('<i class="fas fa-trash-alt"></i> Delete', ['delete', 'id' => $model->id], [
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
            // [
            //     'label' => 'Uploaded By',
            //     'value' => function($model){
            //         $user_info = yii::$app->user->identity->userinfo;
            //         return $user_info->FIRST_M.' '.$user_info->LAST_M;
            //     },
            // ],
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
                'attribute' => 'date_updated',
                'value' => function($model){
                    return ($model->date_updated) ? date('F d, Y h:i A', strtotime($model->date_updated)) : null; 
                },
            ],
            // [
            //     'label' => 'File Upload', 'format' => 'raw',
            //     'value' => function($model){
            //       //return \file\components\AttachmentsTable::widget(['model' => $model]); 
            //       return \attachment\components\AttachmentsInput::widget([
            //         'id' => 'file-input', // Optional
            //         'model' => $model,
            //         'options' => [ // Options of the Kartik's FileInput widget
            //             'multiple' => true, // If you want to allow multiple upload, default to false
            //         ],
            //         'pluginOptions' => [ // Plugin options of the Kartik's FileInput widget 
            //             'initialPreviewAsData' =>  true,
            //             'initialPreviewFileType' => 'pdf',
            //             'maxFileCount' => 10, // Client max files
            //             'showRemove' => false,
            //             'showCancel' => false,
            //             'showUpload' => false,
            //             'showBrowse' => false,
            //             'fileActionSettings' => [
            //                 'showRemove' => false,
            //             ],
            //             'previewFileType' => 'pdf'
            //         ]
            //         ]);
            //     },
            // ]
        ],
    ]) ?>
    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'File Attachment', 'format' => 'raw',
                'value' => function($model){
                  //return \file\components\AttachmentsTable::widget(['model' => $model]); 
                  return \attachment\components\AttachmentsInput::widget([
                    'id' => 'file-input', // Optional
                    'model' => $model,
                    'options' => [ // Options of the Kartik's FileInput widget
                        'multiple' => true, // If you want to allow multiple upload, default to false
                    ],
                    'pluginOptions' => [ // Plugin options of the Kartik's FileInput widget 
                        'initialPreviewAsData' =>  true,
                        'initialPreviewFileType' => 'pdf',
                        'maxFileCount' => 10, // Client max files
                        'showRemove' => false,
                        'showCancel' => false,
                        'showUpload' => false,
                        'showBrowse' => false,
                        'fileActionSettings' => [
                            'showRemove' => false,
                        ],
                        'previewFileType' => 'pdf'
                    ]
                    ]);
                },
            ]
        ]
    ])
    ?>
</div>