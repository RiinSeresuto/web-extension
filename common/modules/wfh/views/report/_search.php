<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\modules\wfh\models\RecordSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="record-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Date</label>
				<?= DateRangePicker::widget([
					'name' => 'date-select',
					'value' => date('Y-m-d') . ' - ' . date('Y-m-d'), // to display default date range in widget
					'attribute' => 'start_date_range',
					'convertFormat'=>true,
					'startAttribute' => 'start_date_range_start',
					'endAttribute' => 'start_date_range_end',
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
					'options' => ['class'=>'form-control', 'autocomplete'=>'off', 'id' => 'date_select'],
				]);?>
			</div>
        </div>

        <div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Status</label>
				<?= Select2::widget([
					'name' => 'status-select',
					'value' => ['Completed'],
					'data' => [
						'Ongoing'  => 'Ongoing',
						'On Hold' => 'On Hold',
						'Completed' => 'Completed',
						'Cancelled' => 'Cancelled'
					],
					'options' => ['placeholder' => 'Please select a status','multiple' => true,'class'=>'', 'id' => 'status_select'],
					'pluginOptions' => [
						'allowClear' => false,
					],
				]); ?>
			</div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

    <div class="form-group" style="margin-top:10px;">
        <?= Html::submitButton('Generate', ['class' => 'btn btn-primary', 'id' => 'generate-report']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default', 'id' => 'reset-report']) ?>
    </div>
</div>
