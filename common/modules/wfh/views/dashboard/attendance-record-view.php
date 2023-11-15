<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\export\ExportMenu;

$notTimeOut = '#ff7f7f';
$nextDayTimeOut  = '#ffd281';
$recToday   = '#add8e6';

?>
<style>
	.btn-disabled {
		pointer-events: none;
	}

	.tdSpacing {
        padding: 2px 2px 1px 2px;
    }

	.filter {
		border: 2px solid #add8e6; 
		border-radius: 10px
	}

	.time-warning {
		border: 2px solid #ffd281; 
		border-radius: 10px
	}

</style>

	<div class="panel panel-primary" name="records">
		<div class="panel-heading">Staff Attendance Records</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-4">
					<div class="alert filter">
						<span><strong><i class="glyphicon glyphicon-info-sign"> </i> </strong> Legend :</span>
						<table>
							<tr><td class="tdSpacing"><div style="width:20px; height: 20px; background-color:<?= $recToday ?>;"></div></td><td class="tdSpacing">- Attendance for Today</td></tr>
							<tr><td class="tdSpacing"><div style="width:20px; height: 20px; background-color:<?= $nextDayTimeOut ?>;"></div></td><td class="tdSpacing">- Attendance Time Out is recorded on the following day</td></tr>
							<tr><td class="tdSpacing"><div style="width:20px; height: 20px; background-color:<?= $notTimeOut ?>;"></div></td><td class="tdSpacing">- Record with no Time Out</td></tr>
						</table>
					</div>
				</div>
				<div class="col-md-8">
					<?php $form = ActiveForm::begin([
						'action' => ['index'],
						'method' => 'get',
					]); ?>

					<?= $form->field($searchModel, 'user_id')->widget(
						Select2::className(), [
							'data' => ArrayHelper::map($employees, 'user_id', 'fullName'),
							'options' => ['placeholder' => 'Employee', 'multiple' => true, 'class'=>'form-select'],
							'pluginOptions' => [
								'allowClear' => true,
							],							
					]); ?>

					<div class="row">
						<div class="col-md-6">
							<?= $form->field($searchModel, 'time_in_range')->widget(
								DateRangePicker::className(), [
									'attribute' => 'time_in_range',
									'convertFormat'=>true,
									'startAttribute' => 'time_in_range_start',
									'endAttribute' => 'time_in_range_end',
									'pluginOptions'=>[
										'locale'=>['format' => 'Y-m-d'],
										'ranges'=>[
											'Today' => ["moment().startOf('day')", "moment().endOf('day')"],
											'Yesterday' => ["moment().startOf('day').subtract(1,'days')", "moment().endOf('day').subtract(1,'days')"],
											'This Week' => ["moment().startOf('week')", "moment().endOf('week')"],
											date('F 1-15, Y') => ["moment().startOf('month')", "moment().startOf('month').add(14,'days')"],
											date('F 16-t, Y') => ["moment().startOf('month').add(15,'days')", "moment().endOf('month')"],
											'All of '.date('F, Y') => ["moment().startOf('month')", "moment().endOf('month')"],
											'1st Quarter, '.date('Y') => ["moment().startOf('year')", "moment().startOf('year').add(2,'months').endOf('month')"],
											'2nd Quarter, '.date('Y') => ["moment().startOf('year').add(3,'months')", "moment().startOf('year').add(5,'months').endOf('month')"],
											'3rd Quarter, '.date('Y') => ["moment().startOf('year').add(6,'months')", "moment().startOf('year').add(8,'months').endOf('month')"],
											'4th Quarter, '.date('Y') => ["moment().startOf('year').add(9,'months')", "moment().endOf('year')"],
											'1st Semester, '.date('Y') => ["moment().startOf('year')", "moment().startOf('year').add(5,'months').endOf('month')"],
											'2nd Semester, '.date('Y') => ["moment().startOf('year').add(6,'months')", "moment().endOf('year')"],
											'All of '.date('Y') => ["moment().startOf('year')", "moment().endOf('year')"],
										],
									],
									'options' => ['class'=>'form-control', 'autocomplete'=>'off', 'readonly'=>true],			
							]); ?>
						</div>
						<div class="col-md-6">
							<?= $form->field($searchModel, 'without_time_out')->widget(
								Select2::className(), [
									'data' => ['0' => 'All Records', '1' => 'Records With Time In/Out', '2' => 'With No Time Out'],
									'options' => ['class'=>'form-select'],
									'pluginOptions' => [
										'allowClear' => false,
									],							
							])->label('Filter Options'); ?>
						</div>
					</div>

					<div class="form-group pull-right">
						<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
						<?= Html::a('Reset', ['index'], ['class' => 'btn btn-default']); ?>
					</div>

					<?php ActiveForm::end(); ?>
					<?php
						echo '<div class="pull-right">';
						echo ExportMenu::widget([
							'dropdownOptions' => [
								'label' => 'Export',
							],
							'showColumnSelector' => false,
							'dataProvider' => $dataProvider,
							'columns' => [
								[
									'attribute' => 'user_id',
									'value' => function($model){
										return ($model->user && $model->user->userinfo) ? strtoupper($model->user->userinfo->fullName) : null; 
									},
								],
								[
									'attribute' => 'date',
									'value' => function($model){
										return date('F d, Y', strtotime($model->date));
									}
								],
								[
									'label' => 'Day',
									'value' => function($model){
										return date('l', strtotime($model->date));
									}
								],
								[
									'attribute' => 'time_in',
									'value' => function($model){
										return date('h:i A', strtotime($model->time_in));
									},
								],
								[
									'attribute' => 'time_out',
									'value' => function($model){
										return ($model->time_out) ? date('h:i A', strtotime($model->time_out)) : '-';
									},
								],							
							]
						]);
						echo '</div>';
					?>
				</div>
			</div>
		</div>
		<?= GridView::widget([
			'dataProvider' => $dataProvider,
			'tableOptions' => ['class' => 'table table-bordered table-condensed'],
			'options' => ['class' => 'table-responsive'],
			'rowOptions' => function($model){
				$sDate = date('Ymd', strtotime($model->time_in));
				$eDate = ($model->time_out) ? date('Ymd', strtotime($model->time_out)) : '';
			
				if($sDate == date('Ymd')){
					return ['style' => 'background-color:#add8e6'];
				}else if ($model->time_out && $sDate != $eDate) {
					return ['style' => 'background-color:#ffd281'];
				}else{
					if(!$model->time_out){
						return ['style' => 'background-color:#ff7f7f'];
					}
				}
			},
			'columns' => [
				['class' => 'yii\grid\SerialColumn'],
				[
					'attribute' => 'user_id',
					'value' => function($model){
						return ($model->user && $model->user->userinfo) ? strtoupper($model->user->userinfo->fullName) : null; 
					},
					'options' => ['style' => 'width:250px'],
				],
				[
					'attribute' => 'date',
					'value' => function($model){
						return date('F d, Y', strtotime($model->date));
					}
				],
				[
					'label' => 'Day',
					'value' => function($model){
						return date('l', strtotime($model->date));
					}
				],
				[
					'attribute' => 'time_in',
					'value' => function($model){
						return date('h:i A', strtotime($model->time_in));
					},
				],
				[
					'attribute' => 'time_out',
					'value' => function($model){
						return ($model->time_out) ? date('h:i A', strtotime($model->time_out)) : '-';
					},
				],
			],
		]); ?>
	</div>
</div>
