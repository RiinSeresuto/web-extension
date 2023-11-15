<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

?>
<h1>Staff Summary</h1>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Staff Summary (<?= $supervisorDashboard->taskSummary->totalCount; ?>)
			</div>
			<?= GridView::widget([
				'dataProvider' => $supervisorDashboard->taskSummary,
				'tableOptions' => ['class' => 'table table-bordered table-condensed table-hover'],
				'options' => ['class' => 'table-responsive'],
				'summary' => false,
				'columns' => [
					[
						'attribute' => 'name',
						'value' => function($model) use($supervisorDashboard){
							return Html::a(strtoupper($model['name']), ['task/index', 'TaskSearch[user_id][]'=>$model['user_id'], 'TaskSearch[start_date_range]'=>$supervisorDashboard->floor_date . ' - ' . $supervisorDashboard->ceil_date]);
						},
						'format' => 'raw',
					],
					[
						'attribute' => 'ongoing',
						'value' => function($model) use($supervisorDashboard){
							return Html::a(($model['ongoing']) ? $model['ongoing'] : 0, ['task/index', 'TaskSearch[user_id][]'=>$model['user_id'], 'TaskSearch[status]'=>'Ongoing', 'TaskSearch[start_date_range]'=>$supervisorDashboard->floor_date . ' - ' . $supervisorDashboard->ceil_date]);
						},
						'contentOptions' => function ($model, $key, $index, $column) {
							$options = [];
							if($model['ongoing'] > 0){
								$options = ['class'=>'bg-danger'];
							}
							return $options;
						},
						'format' => 'raw',
					],
					[
						'attribute' => 'onhold',
						'value' => function($model) use($supervisorDashboard){
							return Html::a(($model['onhold']) ? $model['onhold'] : 0, ['task/index', 'TaskSearch[user_id][]'=>$model['user_id'], 'TaskSearch[status]'=>'On Hold', 'TaskSearch[start_date_range]'=>$supervisorDashboard->floor_date . ' - ' . $supervisorDashboard->ceil_date]);
						},
						'contentOptions' => function ($model, $key, $index, $column) {
							$options = [];
							if($model['onhold'] > 0){
								$options = ['class'=>'bg-warning'];
							}
							return $options;
						},
						'format' => 'raw',
					],
					[
						'attribute' => 'completed',
						'value' => function($model) use($supervisorDashboard){
							return Html::a(($model['completed']) ? $model['completed'] : 0, ['task/index', 'TaskSearch[user_id][]'=>$model['user_id'], 'TaskSearch[status]'=>'Completed', 'TaskSearch[start_date_range]'=>$supervisorDashboard->floor_date . ' - ' . $supervisorDashboard->ceil_date]);
						},
						'format' => 'raw',
					],
					[
						'attribute' => 'cancelled',
						'value' => function($model) use($supervisorDashboard){
							return Html::a(($model['cancelled']) ? $model['cancelled'] : 0, ['task/index', 'TaskSearch[user_id][]'=>$model['user_id'], 'TaskSearch[status]'=>'Cancelled', 'TaskSearch[start_date_range]'=>$supervisorDashboard->floor_date . ' - ' . $supervisorDashboard->ceil_date]);
						},
						'format' => 'raw',
					],
				],
			]); ?>
		</div>
	</div>
</div>