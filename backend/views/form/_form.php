<?php

use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Form */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-form">

    <div class="form-group">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(); ?>

             <?= $form->field($model, 'category_id')->widget(Select2::class, [
                'data' => ArrayHelper::map($category, 'id', 'title'),
                'options' => [
                    'placeholder' => 'Select Category',
                ],
            ])?>

            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'status_id')->widget(Select2::class, [
                                        'data' => ArrayHelper::map($status, 'id', 'status_type'),
                                        'options' => [
                                            'placeholder' => 'Select Status',
                                        ],
                                    ]) ?>

            <?= $form->field($model, 'year_id')->widget(DatePicker::className(), [
                    'options' => ['placeholder' => "Select Year"],
                    'pluginOptions' => [
                        'format' => 'yyyy',
                        'autoclose' => true,
                        'minViewMode' => 'years',
                    ]
                ]) ?>
                    
            <?= $form->field($model, 'field_id')->widget(Select2::class, [
                'data' => ArrayHelper::map($field, 'id', 'label'),
                'options' => [
                    'placeholder' => 'Select Field',
                ]
            ])?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    

    <?php ActiveForm::end(); ?>

</div>
