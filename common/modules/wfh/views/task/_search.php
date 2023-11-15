<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model common\modules\wfh\models\TaskSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

	<?php 
		if($employees){
			echo $form->field($model, 'user_id')->widget(
				Select2::className(), [
					'data' => ArrayHelper::map($employees, 'user_id', 'fullName'),
					'options' => ['placeholder' => 'Employee', 'multiple' => true, 'class'=>'form-select'],
					'pluginOptions' => [
						'allowClear' => true,
					],							
			]);
		}
	?>
	<div class="row">
		<div class="col-md-3">
			<?= $form->field($model, 'start_date_range')->widget(
				DateRangePicker::className(), [
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
					'options' => ['class'=>'form-control', 'autocomplete'=>'off', 'readonly'=>true],			
			]); ?>
		</div>
		<div class="col-md-3">
			<?= $form->field($model, 'status')->widget(
				Select2::className(), [
					'data' => ['Ongoing' => 'Ongoing', 'On Hold' => 'On Hold', 'Completed' => 'Completed', 'Cancelled' => 'Cancelled'],
					'options' => ['placeholder' => 'Status', 'multiple' => true, 'class'=>'form-select'],
					'pluginOptions' => [
						'allowClear' => true,
					],							
			]); ?>
		</div>
		<div class="col-md-3">
			<?= $form->field($model, 'description') ?>
		</div>
		<div class="col-md-3">
			<?= $form->field($model, 'reason') ?>
		</div>
	</div>
    <div class="form-group text-center">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Reset', ['index'], ['class' => 'btn btn-default']); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
