<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use attachment\components\AttachmentsInput;

/* @var $this yii\web\View */
/* @var $model backend\models\DilgInfoSystems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dilg-info-systems-form">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <div class="col-md-12">
                    <?php $form = ActiveForm::begin(['id' => 'content_form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
                    
                    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'order')->textInput() ?>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($model, 'status_id')->widget(Select2::class, [
                                'data' => ArrayHelper::map($status, 'id', 'status_type'),
                                'options' => [
                                    'placeholder' => 'Select Status',
                                ],
                            ]) ?>
                        </div>
                    </div>

                    <div>
                        <?=  '<label for="photo_attach">Logo</label>' ?>
                        <?= AttachmentsInput::widget([
                            'model' => $model,
                            'options' => [ 
                                'multiple' => true,
                                'accept' => 'application/pdf',
                            ],
                            'pluginOptions' => [
                                'initialPreviewAsData' =>  true,
                                //'initialPreviewFileType' => 'pdf',
                                'autoReplace' => false,
                                'overwriteInitial' => false,
                                'maxFileCount' => 3,
                                //'allowedFileExtensions' => ['pdf'],
                                'showUpload' => false,
                                //'showBrowse' => false,
                                'showCancel' => false,
                                'browseLabel' => 'Browse...',
                                'removeLabel' => '',
                                'mainClass' => 'input-group-lg',
                                'browseClass' => 'btn btn-info',
                                'uploadClass' => 'btn btn-info',
                                'fileActionSettings'=> [
                                    'showDrag' => false,
                                    'showRemove' => true,
                                    //'showBrowse' => true,
                                    'msgRemove' => 'Are you sure you want to delete this file?',
                                ]
                            ]
                        ]) ?>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'link')->hiddenInput(['class' => 'link_hidden', 'disabled' => true])->label(false) ?>
                        </div>
                    </div>

                    <?= Html::submitButton($model->isNewRecord ? '<i class="fas fa-save"></i> Create' : '<i class="fas fa-edit"></i> Update', [
                        'class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm',
                        'onclick' => "$('#file-input').fileinput('upload');"
                            ]) ?>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
