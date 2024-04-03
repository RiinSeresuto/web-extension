<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DilgInfoSystemsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dilg-info-systems-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'label') ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'status_id') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
