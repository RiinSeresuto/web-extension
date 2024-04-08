<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\ConnectedAgenciesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="connected-agencies-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'agency_type_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map($agency_type, 'id', 'agency_type'),
                    'options' => [
                        'placeholder' => 'Select Agency Type',
                    ],
                ]) ?>
        </div>
        
        <div class="col-md-6">
            <?= $form->field($model, 'label') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-search"></i> Search', ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
