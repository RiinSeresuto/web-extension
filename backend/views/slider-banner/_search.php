<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\SliderBannerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-banner-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'title') ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'slider_banner_id')->widget(Select2::class, [
                'data' => ArrayHelper::map($sliderBannerType, 'id', 'slider_banner_type'),
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
