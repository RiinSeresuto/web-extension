<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

use kartik\file\FileInput;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(['id' => 'content_form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'menu_order')->textInput() ?>

    <?= $form->field($model, 'position_id')->widget(Select2::class, [
                        'data' => ArrayHelper::map($position, 'id', 'position'),
                        'options' => [
                            'placeholder' => 'Select Position',
                        ],
                    ]) ?>

    <?= $form->field($model, 'status_id')->widget(Select2::class, [
                        'data' => ArrayHelper::map($status, 'id', 'status_type'),
                        'options' => [
                            'placeholder' => 'Select Status',
                        ],
                    ]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <!-- <div class="col-12">
    <?php // $form->field($model, 'file_attach[]')->widget(FileInput::classname(), [
        //     'id' => 'file-attach',
        //     'options' => ['multiple' => true],
        //     'pluginOptions' => [
        //         'showUpload' => false,
        //         'initialPreviewAsData' => true,
        //         'maxFileCount' => 5,
        //         'showPreview' => false,
        //     ]
        // ]); ?>
    </div> -->

        <?= \file\components\AttachmentsInput::widget([
        'id' => 'file-input', // Optional
        'model' => $model,
        'options' => [ // Options of the Kartik's FileInput widget
            'multiple' => true, // If you want to allow multiple upload, default to false
        ],
        'pluginOptions' => [ // Plugin options of the Kartik's FileInput widget 
            'maxFileCount' => 10 // Client max files
        ]
            ]) ?>


    <!-- <div>
        <?php //Html::submitButton($model->isNewRecord ? 'Create' : 'Update', [
        //     'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
        //     'onclick' => "$('#file-attach').fileinput('upload'); return false;"
        // ]) ?>
    </div> -->

        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', [
        'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
        'onclick' => "$('#file-input').fileinput('upload');"
            ]) ?>


    <?php ActiveForm::end(); ?>

</div>
