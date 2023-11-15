<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

?>
<style>
.table-responsive{
	padding-bottom : 200px!important;
}
</style>
<h1>My Tasks</h1>

<div class="row">
	<?php foreach($status as $title): ?>
	<div class="col-md-3">
		<div class="panel panel-<?= $panelClass[$title]; ?>">
			<div class="panel-heading">
				<?= $title ?>
			</div>
			<div class="panel-body">
				<p class="text-center" style="font-size:2em;">
					<?php
						$count = !empty($countByStatus[$title]) ? $countByStatus[$title]['count'] : 0;
						echo Html::a($count, ['task/index', 'TaskSearch[status]'=>$title, 'TaskSearch[start_date_range]'=>$employeeDashboard->floor_date . ' - ' . $employeeDashboard->reference_date], ['class' => 'btn btn-lg btn-'.$panelClass[$title]]);
					?>
				</p>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-danger">
			<div class="panel-heading">
				Ongoing
			</div>
			<?= GridView::widget([
				'dataProvider' => $employeeDashboard->ongoingTaskDataProvider,
				'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed'],
				'options' => ['class' => 'table-responsive'],
				'summary' => false,
				'columns' => [
					[
						'attribute' => 'start_date',
						'value' => function($model){
							return ($model->start_date) ? date('F d, Y h:i A', strtotime($model->start_date)) : null; 
						},
						'enableSorting' => false,
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
						'enableSorting' => false,
					],
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{actions}',
						'buttons'=>[
							'actions' => function ($url, $model){
								return \yii\bootstrap\ButtonDropdown::widget([
									'label' => '<span class="glyphicon glyphicon-menu-hamburger"></span>',
									'dropdown' => [
										'items' => [
											['label' => '<span class="glyphicon glyphicon-eye-open"></span> View Task', 'url' => ['task/view', 'id'=>$model->id]],
											['label' => '<hr>'],
											['label' => '<span class="glyphicon glyphicon-ok-sign"></span> Update Task <span class="glyphicon glyphicon-chevron-right"></span> Completed', 'url' => ['task/update', 'id'=>$model->id, 's'=>'Completed']],						
											['label' => '<span class="glyphicon glyphicon-remove-circle"></span> Update Task <span class="glyphicon glyphicon-chevron-right"></span> On Hold', 'url' => ['task/update', 'id'=>$model->id, 's'=>'On Hold']],							
											['label' => '<span class="glyphicon glyphicon-remove-sign"></span> Update Task <span class="glyphicon glyphicon-chevron-right"></span> Cancelled', 'url' => ['task/update', 'id'=>$model->id, 's'=>'Cancelled']],							
											['label' => '<span class="glyphicon glyphicon-ok-circle"></span> Update Task <span class="glyphicon glyphicon-chevron-right"></span> Ongoing', 'url' => ['task/update', 'id'=>$model->id, 's'=>'Ongoing']],							
										],
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
					],
				],
			]); ?>
			<?php if($employeeDashboard->ongoingTaskDataProvider->count): ?>
			<p class="text-center">
				<?= Html::a('View All', ['task/index', 'TaskSearch[status]'=>'Ongoing', 'TaskSearch[start_date_range]'=>$employeeDashboard->floor_date . ' - ' . $employeeDashboard->reference_date], ['class' => 'btn btn-default']);?>
			</p>
			<?php endif; ?>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-danger">
			<div class="panel-heading">
				Scheduled For the Day
			</div>
			<?= GridView::widget([
				'dataProvider' => $employeeDashboard->todayTaskDataProvider,
				'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed'],
				'options' => ['class' => 'table-responsive'],
				'summary' => false,
				'columns' => [
					[
						'attribute' => 'start_date',
						'value' => function($model){
							return ($model->start_date) ? date('F d, Y h:i A', strtotime($model->start_date)) : null; 
						},
						'enableSorting' => false,
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
						'enableSorting' => false,
					],
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{actions}',
						'buttons'=>[
							'actions' => function ($url, $model){
								return \yii\bootstrap\ButtonDropdown::widget([
									'label' => '<span class="glyphicon glyphicon-menu-hamburger"></span>',
									'dropdown' => [
										'items' => [
											['label' => '<span class="glyphicon glyphicon-eye-open"></span> View Task', 'url' => ['task/view', 'id'=>$model->id]],
											['label' => '<hr>'],
											['label' => '<span class="glyphicon glyphicon-ok-sign"></span> Update Task <span class="glyphicon glyphicon-chevron-right"></span> Completed', 'url' => ['task/update', 'id'=>$model->id, 's'=>'Completed']],						
											['label' => '<span class="glyphicon glyphicon-remove-circle"></span> Update Task <span class="glyphicon glyphicon-chevron-right"></span> On Hold', 'url' => ['task/update', 'id'=>$model->id, 's'=>'On Hold']],							
											['label' => '<span class="glyphicon glyphicon-remove-sign"></span> Update Task <span class="glyphicon glyphicon-chevron-right"></span> Cancelled', 'url' => ['task/update', 'id'=>$model->id, 's'=>'Cancelled']],							
											['label' => '<span class="glyphicon glyphicon-ok-circle"></span> Update Task <span class="glyphicon glyphicon-chevron-right"></span> Ongoing', 'url' => ['task/update', 'id'=>$model->id, 's'=>'Ongoing']],							
										],
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
					],
				],
			]); ?>
			<?php if($employeeDashboard->todayTaskDataProvider->count): ?>
			<p class="text-center">
				<?= Html::a('View All', ['task/index', 'TaskSearch[status]'=>'Ongoing', 'TaskSearch[start_date_range]'=>$employeeDashboard->reference_date . ' - ' . $employeeDashboard->reference_date], ['class' => 'btn btn-default']);?>
			</p>
			<?php endif; ?>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-info">
			<div class="panel-heading">
				Upcoming Tasks
			</div>
			<?= GridView::widget([
				'dataProvider' => $employeeDashboard->upcomingTaskDataProvider,
				'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed'],
				'options' => ['class' => 'table-responsive'],
				'summary' => false,
				'columns' => [
					[
						'attribute' => 'start_date',
						'value' => function($model){
							return ($model->start_date) ? date('F d, Y h:i A', strtotime($model->start_date)) : null; 
						},
						'enableSorting' => false,
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
						'enableSorting' => false,
					],
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{actions}',
						'buttons'=>[
							'actions' => function ($url, $model){
								return \yii\bootstrap\ButtonDropdown::widget([
									'label' => '<span class="glyphicon glyphicon-menu-hamburger"></span>',
									'dropdown' => [
										'items' => [
											['label' => '<span class="glyphicon glyphicon-eye-open"></span> View Task', 'url' => ['task/view', 'id'=>$model->id]],
											['label' => '<hr>'],
											['label' => '<span class="glyphicon glyphicon-ok-sign"></span> Update Task <span class="glyphicon glyphicon-chevron-right"></span> Completed', 'url' => ['task/update', 'id'=>$model->id, 's'=>'Completed']],						
											['label' => '<span class="glyphicon glyphicon-remove-circle"></span> Update Task <span class="glyphicon glyphicon-chevron-right"></span> On Hold', 'url' => ['task/update', 'id'=>$model->id, 's'=>'On Hold']],							
											['label' => '<span class="glyphicon glyphicon-remove-sign"></span> Update Task <span class="glyphicon glyphicon-chevron-right"></span> Cancelled', 'url' => ['task/update', 'id'=>$model->id, 's'=>'Cancelled']],							
											['label' => '<span class="glyphicon glyphicon-ok-circle"></span> Update Task <span class="glyphicon glyphicon-chevron-right"></span> Ongoing', 'url' => ['task/update', 'id'=>$model->id, 's'=>'Ongoing']],							
										],
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
					],
				],
			]); ?>
			<?php if($employeeDashboard->upcomingTaskDataProvider->count): ?>
			<p class="text-center">
				<?= Html::a('View All', ['task/index', 'TaskSearch[status]'=>'Ongoing', 'TaskSearch[start_date_range]'=>date('Y-m-d', strtotime($employeeDashboard->reference_date.' +1 day')) . ' - ' . $employeeDashboard->ceil_date], ['class' => 'btn btn-default']);?>
			</p>
			<?php endif; ?>
		</div>
	</div>
</div>