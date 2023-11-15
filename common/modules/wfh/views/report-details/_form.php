<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\wfh\models\ReportDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'user_id')->textInput() ?> -->

    <?= $form->field($model, 'employee_position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approval_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approval_position')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
