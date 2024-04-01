<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\PagesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'title') ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'url_type_id')->widget(Select2::class, [
                'data' => ArrayHelper::map($url_type, 'id', 'url_type'),
                'options' => [
                    'placeholder' => 'Select URL Type',
                ],
            ]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'status_id')->widget(Select2::class, [
                'data' => ArrayHelper::map($status, 'id', 'status_type'),
                'options' => [
                    'placeholder' => 'Select Status',
                ],
            ]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'type_id')->widget(Select2::class, [
                'data' => ArrayHelper::map($type, 'id', 'type'),
                'options' => [
                    'placeholder' => 'Select Type',
                ],
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
