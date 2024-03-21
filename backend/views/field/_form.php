<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Field */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="field-form">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <div class="col-md-12">
                    <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'data_type_id')->widget(Select2::class, [
                                    'data' => ArrayHelper::map($data_type, 'id', 'data_type'),
                                    'options' => [
                                        'placeholder' => 'Select Data Type',
                                    ]
                                ]) ?>
                            </div>

                            <div class="col-md-6">
                                <?= $form->field($model, 'widget_type_id')->widget(Select2::class, [
                                    'data' => ArrayHelper::map($widget_type, 'id', 'widget_type'),
                                    'options' => [
                                        'placeholder' => 'Select Widget Type',
                                    ]
                                ]) ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-sm']) ?>
                        </div>
                </div>
            </div>                         
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
