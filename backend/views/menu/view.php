<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $user yii\web\View */
/* @var $items yii\web\View */
/* @var $model backend\models\Menu */

$this->title = $model->label;
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

// $files =  $model->logoFile;

// // echo '<pre>';
// // print_r ($files);
// // exit;

// $viewableFiles = array();
// $downloadableFiles = array();
// $config = array();

// if ($files) {
//     foreach ($files as $index => $file) {

//         if (strtoupper($file->type) == 'PDF') {
//             $image_url = Url::to(['menu/download', 'id'=>$file->id]);
//                 // echo '<pre>';
//                 // print_r ($image_url);
//                 // exit;
//             $config[] = ['type' => 'pdf', 'caption' => $file->name, 'url' => $file->dbStorePath, 'key' => $file->id];
//             $viewableFiles[] = $image_url;

//         } else if (strtoupper($file->type) == 'PNG') {
//             $image_url = Url::to(['menu/download', 'id'=>$file->id]);
//             $config[] = ['caption' => $file->name, 'key' => $file->id];
//             $viewableFiles[] = $image_url;

//         } else if (strtoupper($file->type) == 'Xlsx' || $file->type == 'Docx' ) {
//             $downloadableFiles[] = $file;
//             // $image_url = Url::to(['task/download', 'id'=>$image->id]);
//             // $config[] = ['type' => 'other', 'caption' => $image->file_name, 'url' => Yii::getAlias('@common'). '/../'. $image->file_path, 'key' => $image->id];
//         }
//     }
// }
?>
<div class="menu-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

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
            [
                'label' => 'Uploaded By',
                'value' => function($model){
                    $user_info = yii::$app->user->identity->userinfo;
                    // echo '<pre>';
                    // print_r ($user_info->FIRST_M.' '.$user_info->LAST_M);
                    // exit;
                    return $user_info->FIRST_M.' '.$user_info->LAST_M;
                },
            ],
            // [
            //     'label' => 'uploaded_by',
            //     'value' => function($model){
            //         return $user;
            //     },
            // ],
            // [
            //     'attribute' => 'user_update_id',
            //     'value' => function($model){
            //         return $model->user->username;
            //     },
            // ],
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
                  return \file\components\AttachmentsInput::widget([
                    'id' => 'file-input', // Optional
                    'model' => $model,
                    'options' => [ // Options of the Kartik's FileInput widget
                        'multiple' => true, // If you want to allow multiple upload, default to false
                    ],
                    'pluginOptions' => [ // Plugin options of the Kartik's FileInput widget 
                        'maxFileCount' => 10, // Client max files
                        'showRemove' => false,
                        'showCancel' => false,
                        'showUpload' => false,
                        'showBrowse' => false,
                        'fileActionSettings' => [
                            'showRemove' => false
                        ],
                        'previewFileType' => 'pdf'
                    ]
                    ]);
                // return FileInput::widget([
                //     'name' => 'attachment_49[]',
                //     //'model' => $items,
                //     'options'=>[
                //         'multiple'=>true,
                //     ],
                //     'pluginOptions' => [
                        
                //         // 'initialPreview'=>[
                //         //     "common\uploads\store\0d\ee\4e\0d3ee74ea9159c5ad07e2b48d1051d01.pdf"
                //         // ],
                //         'initialPreview' => $items,
                //         //'initialPreviewAsData'=> false,
                //         //'initialCaption'=>"The Moon and the Earth",
                //         //'initialPreviewConfig' => [
                //           //  ['caption' => 'Model.jpg', 'size' => '873727'],
                //         //],
                //         'overwriteInitial'=>false,
                //         'maxFileSize'=>2800
                //     ]
                // ]);
                },
            ]
        ],
    ]) ?>

</div>

