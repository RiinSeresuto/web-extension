<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\AttachedAgencySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attached-agency-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'label') ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'status_id')->widget(Select2::class, [
                'data' => ArrayHelper::map($status, 'id', 'status_type'),
                'options' => [
                    'placeholder' => 'Select Status',
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