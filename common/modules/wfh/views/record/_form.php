<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\modules\wfh\models\Record */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="record-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
		if(!$model->id){
			echo $form->field($model, 'user_id')->textInput();
		}
	?>

	<?= $form->field($model, 'time_in')->widget(
			DateTimePicker::className(), [
				'pluginOptions' => [
					'autoclose' => true,
					'format' => 'yyyy-mm-dd hh:ii:00',
					'todayHighlight' => true,
				],
				'options' => ['autocomplete'=>'off']
		]);
	?>

	<?= $form->field($model, 'time_out')->widget(
			DateTimePicker::className(), [
				'pluginOptions' => [
					'autoclose' => true,
					'format' => 'yyyy-mm-dd hh:ii:00',
					'todayHighlight' => true,
				],
				'options' => ['autocomplete'=>'off']
		]);
	?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
