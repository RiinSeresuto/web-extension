<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use kartik\daterange\DateRangePicker;
use kartik\dialog\Dialog;
echo Dialog::widget(['overrideYiiConfirm' => true]);

/* @var $this yii\web\View */
/* @var $searchModel common\modules\wfh\models\RecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accomplishment Report
';
$this->params['breadcrumbs'][] = ['label' => 'Work From Home', 'url' => ['dashboard/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
	.filter {
		border: 2px solid #f5f5f5; 
		margin-bottom: 20px; 
		padding-top:10px;
		padding-bottom:15px; 
		border-radius: 10px
	}
	
	.no-padding {
		padding : 0px;
	}

	td { 
		padding: 10px;
	}

	.hide {
		display:none;
	}
</style>


<div class="report-index box">

    <h1><?= Html::encode($this->title) ?></h1>
	<div class="row">
		<div class="col-md-12">
			<div class="pull-right">
				<?= \yii\bootstrap\ButtonDropdown::widget([
						'label' => '<span class="glyphicon glyphicon-menu-hamburger"></span> Menu',
						'dropdown' => [
							'items' => [
								['label' => '<span class="glyphicon glyphicon-cog"></span> Setup Report Details', 'url' => ['report-details/index']],
								['label' => '<span class="glyphicon glyphicon-dashboard"></span> Dashboard', 'url' => ['dashboard/index']],
								['label' => '<span class="glyphicon glyphicon-time"></span> My Attendance Records', 'url' => ['record/index']],
								['label' => '<span class="glyphicon glyphicon-tasks"></span> My Tasks', 'url' => ['task/index']],
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

	<div class="report-search col-md-12 filter">
		<?php echo $this->render('_search') ?>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="col-md-6">
				<h4><b>Search Result Preview</b> <span style="font-size: 15px;" id="pre-date"></span></h4> 
			</div>
			<div class="col-md-6">
				<a href="export" target='_blank' class="btn btn-success  pull-right hide" id="btn-form-export"> <i class="glyphicon glyphicon-export"> </i> Export</a>
			</div>
			<div class="col-md-12">
				<hr style="margin-top: 5px; margin-bottom: 0px;">
			</div>
		</div>
		<div class="col-md-12" id="result-div">
			<div class="alert alert-info">
    			<strong><i class="glyphicon glyphicon-info-sign"> </i> </strong> Please select an option from the dropdown/s above to generate a report.
    		</div>
		</div>
	</div>
</div>
