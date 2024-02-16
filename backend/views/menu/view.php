<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\file\FileInput;
use backend\models\FileAttachment;

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
        $config[] = ['type' => 'pdf', 'caption' => $file->name, 'url' => Yii::getAlias('@common/uploads/menu/'). $file_attachment->file_extension, 'key' => $file->id];
        $viewableFiles[] = $image_url;
    }
}

?>

<div class="menu-view">

    <p>
        <?= Html::a('<i class="fas fa-arrow-circle-left"></i> Back', ['back', 'id' => $model->id], ['class' => 'btn btn-info btn-sm']) ?>
        <?= Html::a('<i class="fas fa-arrow-circle-left"></i> Detailed View', ['detailed', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a('<i class="fas fa-arrow-circle-left"></i> Actual View', ['actual', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a('<i class="fas fa-pen"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a('<i class="fas fa-trash"></i> Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'parent_id',
            'label',
            'menu_order',
            [
                'attribute' => 'position_id',
                'value' => function($data){
                    return $data->position->position;
                },
            ],
            [
                'attribute' => 'status_id',
                'value' => function($data){
                    return $data->status->status_type;
                },
            ],
            'link',
            //'logo_file',
            [
                'attribute' => 'user_id',
                'value' => function($data){
                    return $data->user->username;
                },
            ],
            [
                'attribute' => 'user_update_id',
                'value' => function($data){
                    return $data->user->username;
                },
            ],
            [
                'attribute' => 'date_created',
                'value' => function($data){
                    return ($data->date_created) ? date('F d, Y h:i A', strtotime($data->date_created)) : null; 
                },
            ],
            [
                'attribute' => 'date_updated',
                'value' => function($data){
                    return ($data->date_updated) ? date('F d, Y h:i A', strtotime($data->date_updated)) : null; 
                },
            ],

        ],
    ]) ?>

<!-- Panel -->
<div class="panel panel-info">
        <div class="panel-heading">
            <b>Attached Files </b>
        </div>
        <div class="panel-body">
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
                            echo FileInput::widget([
                                'name' => 'attachment_1[]',
                                'options'=>[
                                    'multiple'=>true
                                ],
                                'pluginOptions' => [
                                    'initialPreview' => $viewableFiles,
                                    'initialPreviewDownloadUrl' => [
                                        Url::to(['content/download?id={key}'])
                                    ],
                                    'initialPreviewFileType' => 'image',
                                    'initialPreviewAsData'=>true,
                                    'initialPreviewConfig' => $config,
                                    'overwriteInitial'=>false,
                                ],
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
