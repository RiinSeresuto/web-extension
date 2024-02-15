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

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'forms_id') ?>

    <?= $form->field($model, 'field_id') ?>

    <?= $form->field($model, 'tags') ?>

    <?= $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'visibility_id') ?>

    <?php // echo $form->field($model, 'publish_id') ?>

    <?php // echo $form->field($model, 'page_id') ?>

    <?php // echo $form->field($model, 'start_date_time') ?>

    <?php // echo $form->field($model, 'end_date_time') ?>

    <?php // echo $form->field($model, 'min_answer') ?>

    <?php // echo $form->field($model, 'max_answer') ?>

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
