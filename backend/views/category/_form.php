<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <div class="form-group">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'status_id')->widget(Select2::class, [
                        'data' => ArrayHelper::map($status, 'id', 'status_type'),
                        'options' => [
                            'placeholder' => 'Select Status',
                        ],
                    ]) ?>

                <?= $form->field($model, 'year')->widget(DatePicker::className(), [
                                    'options' => ['placeholder' => "Select Year"],
                                    'pluginOptions' => [
                                        'format' => 'yyyy',
                                        'autoclose' => true,
                                        'minViewMode' => 'years',
                                    ]
                                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-sm']) ?>
                </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
