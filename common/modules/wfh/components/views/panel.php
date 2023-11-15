<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use kartik\daterange\DateRangePicker;
use kartik\dialog\Dialog;
echo Dialog::widget(['overrideYiiConfirm' => true]);

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

    <h1>Attendance Records (WFH)</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<div class="alert filter">
		<span><strong><i class="glyphicon glyphicon-info-sign"> </i> </strong> Legend :</span>
		<table>
			<tr><td class="tdSpacing"><div style="width:20px; height: 20px; background-color:<?= $recToday ?>;"></div></td><td class="tdSpacing">- Attendance for Today</td></tr>
			<tr><td class="tdSpacing"><div style="width:20px; height: 20px; background-color:<?= $nextDayTimeOut ?>;"></div></td><td class="tdSpacing">- Attendance Time Out is recorded on the following day</td></tr>
			<tr><td class="tdSpacing"><div style="width:20px; height: 20px; background-color:<?= $notTimeOut ?>;"></div></td><td class="tdSpacing">- Record with no Time Out</td></tr>
		</table>
	</div>
	<?php if ($timeInOut->diffDayRecord) : ?>
		<div class="alert time-warning">
			<strong><i class="glyphicon glyphicon-info-sign"> </i> </strong> 
				The system found that your attendance last <?= date('F d, Y', strtotime($timeInOut->dateDiff)) ?> has no recorded time out.
				<br>
				<span style="margin-left: 18px;">To input Time Out please click the <code class="btn btn-xs btn-warning btn-disabled">Time Out</code> button.</span>
		</div>
		<p class="text-center">
			<?php 
				echo Html::a('TIME OUT', ['wfh/record/time-out-other'], ['
					class' => 'btn btn-md btn-warning',
					'data' => [
						'confirm' => 'Your time out for the day will  be recorded. Continue?',
						'method' => 'post',
					],
				]);
			?>
		</p>
	<?php else : ?>

		<p class="text-center">
			<?php 
				if ($timeInOut->diffDayRecord) {
					echo Html::a('TIME OUT', ['wfh/record/time-out-other'], ['
						class' => 'btn btn-md btn-warning',
						'data' => [
							'confirm' => 'Your time out for the day will  be recorded. Continue?',
							'method' => 'post',
						],
					]);
				}else if($timeInOut->allowTimeIn){
					echo Html::a('TIME IN', ['wfh/record/time-in'], [
						'class' => 'btn btn-md btn-success',
					]);
				}else if($timeInOut->allowTimeOut){
					echo Html::a('TIME OUT', ['wfh/record/time-out'], ['
						class' => 'btn btn-md btn-warning',
						'data' => [
							'confirm' => 'Your time out for the day will  be recorded. Continue?',
							'method' => 'post',
						],
					]);
				}
			?>
		</p>
	<?php endif ?>

	
	<div class="row">
		<div class="col-md-12">
			<div class="pull-right">
				<?= \yii\bootstrap\ButtonDropdown::widget([
						'label' => '<span class="glyphicon glyphicon-menu-hamburger"></span> Menu',
						'dropdown' => [
							'items' => [
								['label' => '<span class="glyphicon glyphicon-dashboard"></span> Dashboard', 'url' => ['wfh/dashboard/index']],
								['label' => '<span class="glyphicon glyphicon-time"></span> My Attendance Records', 'url' => ['wfh/record/index']],
								['label' => '<span class="glyphicon glyphicon-tasks"></span> My Tasks', 'url' => ['wfh/task/index']],
								['label' => '<span class="glyphicon glyphicon-list-alt"></span> Generate Report', 'url' => ['wfh/report/index']],
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
		'summary' => false,
		//'filterModel' => $searchModel,
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
            //['class' => 'yii\grid\SerialColumn'],
            [
				'attribute' => 'user_id',
				'value' => function($model){
					return ($model->user && $model->user->userinfo) ? $model->user->userinfo->fullName : null; 
				},
				'filter'=>false,
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
					],
					'options' => ['class'=>'form-control', 'autocomplete'=>'off', 'readonly'=>true],
				]),
				'enableSorting' => false
			],
            [
				'attribute' => 'time_out',
				'value' => function($model){
					return ($model->time_out) ? date('h:i A', strtotime($model->time_out)) : '-';
				},
				'filter' => false,
				'contentOptions' => function($model){
					return ['title'=> ($model->time_out) ? date('F d, h:i A', strtotime($model->time_out)) : '-' ];
				},
				'enableSorting' => false
			],
        ],
    ]); ?>
</div>
