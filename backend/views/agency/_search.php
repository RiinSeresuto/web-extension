<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ConnectedAgenciesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="connected-agencies-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'agency_type_id') ?>

    <?= $form->field($model, 'label') ?>

    <?= $form->field($model, 'agency_order') ?>

    <?= $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'logo') ?>

    <?php // echo $form->field($model, 'link') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'user_update_id') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'date_updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
