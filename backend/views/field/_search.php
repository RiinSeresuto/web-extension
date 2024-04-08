<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\FieldSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="field-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'label') ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'data_type_id')->widget(Select2::class, [
                'data' => ArrayHelper::map($data_type, 'id', 'data_type'),
                'options' => [
                    'placeholder' => 'Select Data Type',
                ]
            ]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'widget_type_id')->widget(Select2::class, [
                'data' => ArrayHelper::map($widget_type, 'id', 'widget_type'), 
                'options' => [
                    'placeholder' => 'Select Widget Type',
                ]
            ])?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-search"></i> Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
