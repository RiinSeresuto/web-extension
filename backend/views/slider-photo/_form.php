<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use attachment\components\AttachmentsInput;

/* @var $this yii\web\View */
/* @var $model backend\models\SliderPhoto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-photo-form">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <?php $form = ActiveForm::begin(['id' => 'content_form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

                <?= $form->field($model, 'caption')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'status_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map($status, 'id', 'status_type'),
                    'options' => [
                        'placeholder' => 'Select Status',
                    ],
                ]) ?>

                <?=  '<label for="photo_attach">Upload Photo</label>' ?>
                <?=  AttachmentsInput::widget([
                    'model' => $model,
                    'id' => 'upload_photo',
                    'options' => [ 
                        'multiple' => true,
                        'accept' => 'png,jpg,jpeg',
                    ],
                    'pluginOptions' => [
                        'initialPreviewAsData' =>  true,
                        //'initialPreviewFileType' => 'pdf',
                        'autoReplace' => false,
                        'overwriteInitial' => false,
                        'maxFileCount' => 3,
                        //'allowedFileExtensions' => ['pdf'],
                        'showUpload' => false,
                        'showCancel' => false,
                        'browseLabel' => 'Browse',
                        'removeLabel' => '',
                        'mainClass' => 'input-group-lg',
                        'browseClass' => 'btn btn-info',
                        'uploadClass' => 'btn btn-info',
                        'fileActionSettings'=> [
                            'showDrag' => false,
                            'showRemove' => true,
                            'msgRemove' => 'Are you sure you want to delete this file?',
                        ]
                    ]
                ]) ?>

                <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

                <?= Html::submitButton($model->isNewRecord ? '<i class="fas fa-save"></i> Create' : '<i class="fas fa-edit"></i> Update', [
                        'class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm',
                        'onclick' => "$('#file-input').fileinput('upload');"
                            ]) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
