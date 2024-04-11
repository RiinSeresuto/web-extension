<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\PostSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'forms_id')->widget(Select2::class, [
                                'data' => ArrayHelper::map($category, 'id', 'title'),
                                'options' => [
                                    'placeholder' => 'Select Form',
                                ],
                            ]) ?>
        </div>
        
        <div class="col-md-6">
            <?php // $form->field($model, 'status_id') ?>
            <?= $form->field($model, 'status_id')->widget(Select2::class, [
                'data' => ArrayHelper::map($status, 'id', 'title'),
                'options' => [
                    'placeholder' => 'Select Form',
                ],
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-search"></i> Search', ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::resetButton('<i class="fas fa-undo-alt"></i> Reset', ['class' => 'btn btn-outline-secondary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
