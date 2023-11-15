<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use kartik\dialog\Dialog;
echo Dialog::widget(['overrideYiiConfirm' => true]);

/* @var $this yii\web\View */
/* @var $searchModel common\modules\wfh\models\RecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Attendance Records (Admin)';
$this->params['breadcrumbs'][] = ['label' => 'Work From Home', 'url' => ['dashboard/index']];
$this->params['breadcrumbs'][] = $this->title;

// $notTimeOut = '#ed8554';
// $nextDayTimeOut  = '#4fe0b6';
// $recToday   = '#f5eb6d';

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

<div class="record-index box">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<div class="alert filter">
		<span><strong><i class="glyphicon glyphicon-info-sign"> </i> </strong> Legend :</span>
		<table>
			<tr><td class="tdSpacing"><div style="width:20px; height: 20px; background-color:<?= $recToday ?>;"></div></td><td class="tdSpacing">- Attendance for Today</td></tr>
			<tr><td class="tdSpacing"><div style="width:20px; height: 20px; background-color:<?= $nextDayTimeOut ?>;"></div></td><td class="tdSpacing">- Attendance Time Out is recorded on the following day</td></tr>
			<tr><td class="tdSpacing"><div style="width:20px; height: 20px; background-color:<?= $notTimeOut ?>;"></div></td><td class="tdSpacing">- Record with no Time Out</td></tr>
		</table>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="pull-right">
				<?= \yii\bootstrap\ButtonDropdown::widget([
						'label' => '<span class="glyphicon glyphicon-menu-hamburger"></span> Menu',
						'dropdown' => [
							'items' => [
								['label' => '<span class="glyphicon glyphicon-dashboard"></span> Dashboard', 'url' => ['dashboard/index']],
								['label' => '<span class="glyphicon glyphicon-time"></span> My Attendance Records', 'url' => ['record/index']],
								['label' => '<span class="glyphicon glyphicon-tasks"></span> My Tasks', 'url' => ['task/index']],
								['label' => '<span class="glyphicon glyphicon-list-alt"></span> Generate Report', 'url' => ['report/index']],
								['label' => '<span class="glyphicon glyphicon-question-sign"></span> Users Manual', 'url' => 'https://drive.google.com/file/d/1A3Lb6BCYWfzsPbayicvmq2OHhf9_b3Fl/view?fbclid=IwAR3o7UsLS9kDy7QerhJIhneAmGJs_4lqVw0IO4Ty-JWU3s0qi8-FZxRFQac', 'linkOptions'=>['target'=>'blank']],
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
        'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'tableOptions' => ['class' => 'table table-bordered table-condensed'],
		'options' => ['class' => 'table-responsive'],
		'rowOptions' => function($model){
			$sDate = date('Ymd', strtotime($model->time_in));
			$eDate = ($model->time_out) ? date('Ymd', strtotime($model->time_out)) : '';
		
			if($sDate == date('Ymd')){
				// if($model->time_out){
				// 	return ['class' => 'success'];
				// }
				// return ['class' => 'warning'];
				return ['style' => 'background-color:#add8e6'];
			}else if ($model->time_out && $sDate != $eDate) {
				// return ['class' => 'warning'];
				return ['style' => 'background-color:#ffd281'];

			}else{
				if(!$model->time_out){
					// return ['class' => 'danger'];
					return ['style' => 'background-color:#ff7f7f'];
				}
			}
		},
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
				'attribute' => 'user_id',
				'value' => function($model){
					return ($model->user && $model->user->userinfo) ? $model->user->userinfo->fullName : null; 
				},
				'filter'=> Select2::widget([
					'data' => $names,
					'attribute' => 'user_id',
					'model' => $searchModel,
					'options' => ['multiple'=>true, 'placeholder' => 'Search name ...'],
					'pluginOptions' => [
						'allowClear' => true,
						'minimumInputLength' => 3,
						'language' => [
							'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
						],
						'ajax' => [
							'url' => \yii\helpers\Url::to(['record/name-list']),
							'dataType' => 'json',
							'delay' => 550,
							'cache' => true,
							'data' => new JsExpression('function(params) { return {q:params.term}; }')
						],
						'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
						'templateResult' => new JsExpression('function(name) { console.log(name); return name.text; }'),
						'templateSelection' => new JsExpression('function (name) { console.log(name); return name.text; }'),
					],
				]),
				'visible' => (Yii::$app->controller->action->id == 'index-admin') ? true : false,
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
				'filter' => DateRangePicker::widget([
					'model'=>$searchModel,
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
				])
			],
            [
				'attribute' => 'time_out',
				'value' => function($model){
					return ($model->time_out) ? date('h:i A', strtotime($model->time_out)) : '-';
				},
				'filter' => false,
			],
			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update}',
			],
        ],
    ]); ?>
</div>
