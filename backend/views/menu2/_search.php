<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MenuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'id') ?>

    <?php // $form->field($model, 'parent_id') ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'label') ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'position_id') ?>
        </div>
    </div>
    

    <?php // $form->field($model, 'menu_order') ?>

    <?php // $form->field($model, 'position_id') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'link') ?>

    <?php // echo $form->field($model, 'logo_file') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'user_update_id') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'date_updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
