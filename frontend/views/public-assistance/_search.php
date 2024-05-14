<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PublicAssistanceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="public-assistance-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'contact_num') ?>

    <?= $form->field($model, 'subject') ?>

    <?php // echo $form->field($model, 'message') ?>

    <?php // echo $form->field($model, 'group') ?>

    <?php // echo $form->field($model, 'file_attachment') ?>

    <?php // echo $form->field($model, 'date_posted') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
