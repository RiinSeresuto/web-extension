<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PostSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'forms_id') ?>

    <?= $form->field($model, 'field_id') ?>

    <?php // $form->field($model, 'tags') ?>

    <?= $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'visibility_id') ?>

    <?php // echo $form->field($model, 'publish_id') ?>

    <?php // echo $form->field($model, 'page_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
