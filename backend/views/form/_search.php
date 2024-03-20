<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\FormSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'category_id')->widget(Select2::class, [
                'data' => ArrayHelper::map($category, 'id', 'title'),
                'options' => [
                    'placeholder' => 'Select Category',
                ],
            ])?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'status_id')->widget(Select2::class, [
                'data' => ArrayHelper::map($status, 'id', 'status_type'),
                'options' => [
                    'placeholder' => 'Select Status',
                ],
            ]) ?>
        </div>

        <div class="col-md-4">
        <?= $form->field($model, 'year')->widget(DatePicker::className(), [
                'options' => ['placeholder' => "Select Year"],
                'pluginOptions' => [
                    'format' => 'yyyy',
                    'autoclose' => true,
                    'minViewMode' => 'years',
                ]
            ]) ?>
        </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-search"></i> Search', ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::resetButton('<i class="fas fa-undo-alt"></i> Reset', ['class' => 'btn btn-outline-secondary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
