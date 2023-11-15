<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\dialog\Dialog;
use yii\helpers\Url;
use kartik\file\FileInput;
echo Dialog::widget(['overrideYiiConfirm' => true]);

/* @var $this yii\web\View */
/* @var $model common\modules\wfh\models\Task */

$this->title = Yii::$app->formatter->asHtml($model->shortDescription);
$this->params['breadcrumbs'][] = ['label' => 'Work From Home', 'url' => ['dashboard/index']];
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$files =  $model->Images;

$viewableFiles = array();
$downloadableFiles = array();
$config = array();

if ($files) {
    foreach ($files as $index => $image) {

        if ($image->file_type == 'Pdf') {
            $image_url = Url::to(['task/download', 'id'=>$image->id]);
            $config[] = ['type' => 'pdf', 'caption' => $image->file_name, 'url' => Yii::getAlias('@common'). '/../'. $image->file_path, 'key' => $image->id];
            $viewableFiles[] = $image_url;

        } else if ($image->file_type == 'Image') {
            $image_url = Url::to(['task/download', 'id'=>$image->id]);
            $config[] = ['caption' => $image->file_name, 'key' => $image->id];
            $viewableFiles[] = $image_url;

        } else if ($image->file_type == 'Xlsx' || $image->file_type == 'Docx' ) {
            $downloadableFiles[] = $image;
            // $image_url = Url::to(['task/download', 'id'=>$image->id]);
            // $config[] = ['type' => 'other', 'caption' => $image->file_name, 'url' => Yii::getAlias('@common'). '/../'. $image->file_path, 'key' => $image->id];
        }
    }
}

// echo "<pre>";
// print_r($files);
// exit;


?>
<style>
    .card {
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
		transition: 0.3s;
		padding: 1em;
		margin-bottom: 1em;
	}

    .file-caption-main {
        display: none;
    }

    .close.fileinput-remove {
        display     : none;
    }

    .file-drop-zone {
        /* pointer-events: none; */
        border: none;
    }

    .kv-file-remove {
        display     : none;
    }

    .file-drag-handle {
        display     : none;
    }

</style>
<div class="task-view box">

    <h1><?= Html::encode($this->title) ?></h1>

	<div class="row">
		<div class="col-md-12">
			<div class="pull-right">
				<?php
					$items = [];
							
					if($model->checkAccess('update')){
						$items[] = ['label' => '<span class="glyphicon glyphicon-ok-sign"></span> Update Task <span class="glyphicon glyphicon-chevron-right"></span> Completed', 'url' => ['task/update', 'id'=>$model->id, 's'=>'Completed']];							
						$items[] = ['label' => '<span class="glyphicon glyphicon-remove-circle"></span> Update Task <span class="glyphicon glyphicon-chevron-right"></span> On Hold', 'url' => ['task/update', 'id'=>$model->id, 's'=>'On Hold']];							
						$items[] = ['label' => '<span class="glyphicon glyphicon-remove-sign"></span> Update Task <span class="glyphicon glyphicon-chevron-right"></span> Cancelled', 'url' => ['task/update', 'id'=>$model->id, 's'=>'Cancelled']];							
						$items[] = ['label' => '<span class="glyphicon glyphicon-ok-circle"></span> Update Task <span class="glyphicon glyphicon-chevron-right"></span> Ongoing', 'url' => ['task/update', 'id'=>$model->id, 's'=>'Ongoing']];							
						$items[] = ['label' => '<hr>'];
					}
					if($model->checkAccess('delete')){
						$items[] = [	
							'label' => '<span class="glyphicon glyphicon-trash"></span> Delete', 'url' => ['task/delete', 'id'=>$model->id],
							'linkOptions' => [
								'data' => [
									'confirm' => 'Are you sure you want to delete this item?',
									'method' => 'post',
								],
							],
						];							
						$items[] = ['label' => '<hr>'];
					}
					
					if($model->user_id != \Yii::$app->user->id){
						$items = array_merge($items, [
								['label' => '<span class="glyphicon glyphicon-tasks"></span> View Tasks of ' . (($model->user && $model->user->userinfo) ? $model->user->userinfo->fullName : 'this employee'), 'url' => ['task/index', 'TaskSearch[user_id][]'=>$model['user_id']]],
								['label' => '<hr>'],
							]);
					}
					
					$items = array_merge($items, [
								['label' => '<span class="glyphicon glyphicon-plus"></span> Create Task', 'url' => ['task/create']],
								['label' => '<span class="glyphicon glyphicon-tasks"></span> My Tasks', 'url' => ['task/index']],
								['label' => '<span class="glyphicon glyphicon-dashboard"></span> Dashboard', 'url' => ['dashboard/index']],
							]);
					echo \yii\bootstrap\ButtonDropdown::widget([
						'label' => '<span class="glyphicon glyphicon-menu-hamburger"></span> Menu',
						'dropdown' => [
							'items' => $items,
							'options' => ['class'=>'dropdown-menu scrollable-menu pull-right'],
							'encodeLabels' => false,
						],
						'options' => [
							'class' => 'btn btn-md btn-primary'
						],
						'encodeLabel' => false,
					]);
				?>
			</div>
		</div>
	</div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
				'attribute' => 'user_id',
				'value' => function($model){
					return ($model->user && $model->user->userinfo) ? $model->user->userinfo->fullName : null; 
				},
				'visible' => (Yii::$app->user->id != $model->user_id) ? true : false,
			],
            [
				'attribute' => 'encoded_by',
				'value' => function($model){
					return ($model->encodedBy && $model->encodedBy->userinfo) ? $model->encodedBy->userinfo->fullName : null; 
				},
				'visible' => ($model->encoded_by != $model->user_id) ? true : false,
			],
            [
				'attribute' => 'start_date',
				'value' => function($model){
					return ($model->start_date) ? date('F d, Y h:i A', strtotime($model->start_date)) : null; 
				}
			],
            [
				'attribute' => 'end_date',
				'value' => function($model){
					return ($model->end_date) ? date('F d, Y h:i A', strtotime($model->end_date)) : null; 
				}
			],
			[
				'label' => 'Duration',
				'value' => function($model){
					return $model->duration;
				}
            ],
            'status',
            'description:ntext',
            'reason:ntext',
            [
				'label' => 'Document URL',
				'value' => function($model){
                    $result = $model->Url;

                    if ($result) {
                        return $model->link->url;
                    } else {
                        return '';
                    }
				}
			],
        ],
    ]) ?>

    <div class="panel panel-info">
        <div class="panel-heading">
            <b>Attached Files </b>
        </div>

        <div class="panel-body">
            <?php if ($files) : ?>
                <div class="col-md-12">
                    <h5>
                        <b>Legends:</b>
                        <?php if ($viewableFiles) :?>
                            <span style="margin-left: 10px;"> <i class="glyphicon glyphicon-zoom-in"> </i> View</span>
                        <?php endif ?>
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
                                        '/wfh/frontend/web/wfh/task/download?id={key}'
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

                <?php if ($downloadableFiles) :?>
                    <div class="col-md-12" style="margin-top: 10px;">

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">#</th>
                                    <th class="text-center" width="15%">Action</th>
                                    <th width="80%">File Name</th>
                                </tr>
                            </thead>
                            
                            <?php foreach ($downloadableFiles as $key => $rec) { ?>
                                <tr>
                                    <td class="text-center"><?php echo $key = $key + 1 ?></td>
                                
                                    <td class="text-center"><?= Html::a('<span class="glyphicon glyphicon-download" style="color:black;"></span>', ['/wfh/task/download', 'id' => $rec->id], ['class' => 'btn', 'style' => 'border: solid 1px 	#DCDCDC;']) ?></td>
                                    <td><?= $rec->file_name ?></td>
                                </tr>
                            <?php }?>
                        </table>
                    </div>
                <?php endif ?>

            <?php else : ?>
                <div class="col-md-12" style="padding: 0px;">
                    <div class="alert alert-info">
                    <i class="glyphicon glyphicon-info-sign"> </i>
                        No files/attachements to show.
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>

</div>