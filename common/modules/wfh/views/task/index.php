<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\daterange\DateRangePicker;
use kartik\export\ExportMenu;
use kartik\dialog\Dialog;
echo Dialog::widget(['overrideYiiConfirm' => true]);

/* @var $this yii\web\View */
/* @var $searchModel common\modules\wfh\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = ['label' => 'Work From Home', 'url' => ['dashboard/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index box">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel, 'employees' => $employees, 'dataProvider' => $dataProvider]); ?>

	<div class="row">
		<div class="col-md-12">
			<div class="pull-right">
				<?= \yii\bootstrap\ButtonDropdown::widget([
						'label' => '<span class="glyphicon glyphicon-menu-hamburger"></span> Menu',
						'dropdown' => [
							'items' => [
								['label' => '<span class="glyphicon glyphicon-plus"></span> Create Task', 'url' => ['task/create']],
								['label' => '<hr>'],
								['label' => '<span class="glyphicon glyphicon-dashboard"></span> Dashboard', 'url' => ['dashboard/index']],
								['label' => '<span class="glyphicon glyphicon-time"></span> My Attendance Records', 'url' => ['record/index']],
								['label' => '<span class="glyphicon glyphicon-list-alt"></span> Generate Report', 'url' => ['report/index']],
								['label' => '<span class="glyphicon glyphicon-question-sign"></span> Users Manual', 'url' => 'https://drive.google.com/file/d/1A3Lb6BCYWfzsPbayicvmq2OHhf9_b3Fl/view?fbclid=IwAR3o7UsLS9kDy7QerhJIhneAmGJs_4lqVw0IO4Ty-JWU3s0qi8-FZxRFQac', 'linkOptions'=>['target'=>'blank']],
								['label' => '<hr>'],
								ExportMenu::widget([
									'asDropdown' => false,
									'showColumnSelector' => false,
									'dropdownOptions' => [
										'label' => 'Export',
									],
									'dataProvider' => $dataProvider,
									'columns' => [
										[
											'attribute' => 'user_id',
											'value' => function($model){
												return ($model->user && $model->user->userinfo) ? strtoupper($model->user->userinfo->fullName) : null; 
											},
											'visible' => ($employees) ? true : false,
											'options' => ['style' => 'width:250px'],
										],
										[
											'attribute' => 'start_date',
											'value' => function($model){
												return ($model->start_date) ? date('F d, Y h:i A', strtotime($model->start_date)) : null; 
											},
										],
										[
											'attribute' => 'end_date',
											'value' => function($model){
												return ($model->end_date) ? date('F d, Y h:i A', strtotime($model->end_date)) : null; 
											},
										],
										[
											'attribute' => 'status',	
										],
										[
											'attribute' => 'description',
											'value' => function($model){
												return Yii::$app->formatter->asHtml($model->description);
											},
											'contentOptions' => function ($model, $key, $index, $column) {
												$options = ['title'=>Yii::$app->formatter->asHtml($model->description)];
												return $options;
											},
										],
										'reason:ntext',
										[
											'label' => 'Duration',
											'value' => function($model){
												return $model->duration;
											}
										],						
									]
								]),
							],
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

    <?= GridView::widget([
		'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed'],
		'options' => ['class' => 'table-responsive'],
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
				'attribute' => 'user_id',
				'value' => function($model){
					return ($model->user && $model->user->userinfo) ? strtoupper($model->user->userinfo->fullName) : null; 
				},
				'visible' => ($employees) ? true : false,
				'options' => ['style' => 'width:250px'],
			],
            [
				'attribute' => 'start_date',
				'value' => function($model){
					return ($model->start_date) ? date('F d, Y h:i A', strtotime($model->start_date)) : null; 
				},
			],
            [
				'attribute' => 'end_date',
				'value' => function($model){
					return ($model->end_date) ? date('F d, Y h:i A', strtotime($model->end_date)) : null; 
				},
			],
            [
				'attribute' => 'status',	
			],
			[
				'attribute' => 'description',
				'value' => function($model){
					return Yii::$app->formatter->asHtml($model->shortDescription);
				},
				'contentOptions' => function ($model, $key, $index, $column) {
					$options = ['title'=>Yii::$app->formatter->asHtml($model->description)];
					return $options;
				},
			],
            'reason:ntext',
			[
				'label' => 'Duration',
				'value' => function($model){
					return $model->duration;
				}
			],
			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{actions}',
				'buttons'=>[
					'actions' => function ($url, $model){
						
						$items = [];
						if($model->checkAccess('view')){
							$items[] = ['label' => '<span class="glyphicon glyphicon-eye-open"></span> View Task', 'url' => ['task/view', 'id'=>$model->id]];							
						}
						if($model->checkAccess('update')){
							$items[] = ['label' => '<hr>'];
							$items[] = ['label' => '<span class="glyphicon glyphicon-ok-sign"></span> Update Task <span class="glyphicon glyphicon-chevron-right"></span> Completed', 'url' => ['task/update', 'id'=>$model->id, 's'=>'Completed']];							
							$items[] = ['label' => '<span class="glyphicon glyphicon-remove-circle"></span> Update Task <span class="glyphicon glyphicon-chevron-right"></span> On Hold', 'url' => ['task/update', 'id'=>$model->id, 's'=>'On Hold']];							
							$items[] = ['label' => '<span class="glyphicon glyphicon-remove-sign"></span> Update Task <span class="glyphicon glyphicon-chevron-right"></span> Cancelled', 'url' => ['task/update', 'id'=>$model->id, 's'=>'Cancelled']];							
							$items[] = ['label' => '<span class="glyphicon glyphicon-ok-circle"></span> Update Task <span class="glyphicon glyphicon-chevron-right"></span> Ongoing', 'url' => ['task/update', 'id'=>$model->id, 's'=>'Ongoing']];													
						}
						if($model->checkAccess('delete')){
							$items[] = ['label' => '<hr>'];
							$items[] = ['label' => '<span class="glyphicon glyphicon-trash"></span> Delete', 'url' => ['task/delete', 'id'=>$model->id],
										'linkOptions' => [
											'data' => [
												'confirm' => 'Are you sure you want to delete this item?',
												'method' => 'post',
											],
										],							
							];							
						
						}
						
						
						return \yii\bootstrap\ButtonDropdown::widget([
							'label' => '<span class="glyphicon glyphicon-menu-hamburger"></span>',
							'dropdown' => [
								'items' => $items,
								'options' => ['class'=>'dropdown-menu scrollable-menu pull-right'],
								'encodeLabels' => false,
							],
							'options' => [
								'class' => 'btn btn-sm btn-default'						
							],
							'encodeLabel' => false,
						]);
					},
				],			
			]
        ],
    ]); ?>
</div>
