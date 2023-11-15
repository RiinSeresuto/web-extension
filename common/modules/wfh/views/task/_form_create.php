<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\dialog\Dialog;
echo Dialog::widget(['overrideYiiConfirm' => true]);

/* @var $this yii\web\View */
/* @var $model common\modules\wfh\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	<?php
		if($employees){
			echo $form->field($model, 'user_id')->widget(
				Select2::className(), [
					'data' => ArrayHelper::map($employees, 'user_id', 'fullName'),
			]); 
		}
	?>

    <?= $form->field($model, 'start_date')->widget(
				DateTimePicker::className(), [
					'pluginOptions' => [
						'autoclose' => true,
						'format' => 'yyyy-mm-dd hh:ii:00',
						'todayHighlight' => true,
					],
					'options' => ['autocomplete'=>'off', 'readonly' => true]
		]);	
	?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'placeholder'=>'Provide a description of the task to perform']); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'data'=>['confirm'=>'You are about to submit this form. Once submitted, <b>the start date cannot be updated</b>. </br></br>Click the OK button to continue with the submission. Otherwise, click the Cancel button to update the form.']]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
