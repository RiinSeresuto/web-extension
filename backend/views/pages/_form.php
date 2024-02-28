<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use attachment\components\AttachmentsInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-form">

    <div class="form-group">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(['id' => 'content_form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

            <?= $form->field($model, 'menu_id')->widget(Select2::className(), [

                                        'data' => ArrayHelper::map($menu, 'id', 'label'),
                                        'options' => [
                                            'placeholder' => 'Select Parent Menu',
                                        ],
                                    ]) ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'url_type_id')->widget(Select2::class, [
                                        'data' => ArrayHelper::map($url, 'id', 'url_type'),
                                        'options' => [
                                            'placeholder' => 'Select URL Type',
                                        ],
                                    ]) ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'status_id')->widget(Select2::class, [
                                        'data' => ArrayHelper::map($status, 'id', 'status_type'),
                                        'options' => [
                                            'placeholder' => 'Select Status',
                                        ],
                                    ]) ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'type_id')->widget(Select2::class, [
                                        'data' => ArrayHelper::map($type, 'id', 'type'),
                                        'options' => [
                                            'placeholder' => 'Select Type',
                                        ],
                                    ]) ?>
                </div>
            </div>

            <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'caption')->textInput(['maxlength' => true]) ?>

            <?php // $form->field($model, 'slider_photo')->textInput() ?>

            <?php  AttachmentsInput::widget([
                        'model' => $model,
                        'options' => [ 
                            'multiple' => true,
                            'accept' => 'application/pdf',
                             'id' => 'photo_attach'
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
                            'browseLabel' => '',
                            'removeLabel' => '',
                            'mainClass' => 'input-group-lg',
                            'browseClass' => 'btn btn-info',
                            'uploadClass' => 'btn btn-info',
                            'fileActionSettings'=> [
                                'showDrag' => false,
                                'showRemove' => true,
                                'msgRemove' => 'Are you sure you want to delete this file?',
                            ],
                            //'id' => 'photo_attach'
                            'inputOptions' => [
                                'id' => 'photo_attach'
                            ]
                        ]
                    ]) ?>


            <?php // $form->field($model, 'file_attachment')->textInput() ?>

            <?php  AttachmentsInput::widget([
                        'model' => $model,
                        'options' => [ 
                            'multiple' => true,
                            'accept' => 'application/pdf',
                             'id' => 'file_attach'
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
                            'browseLabel' => '',
                            'removeLabel' => '',
                            'mainClass' => 'input-group-lg',
                            'browseClass' => 'btn btn-info',
                            'uploadClass' => 'btn btn-info',
                            'fileActionSettings'=> [
                                'showDrag' => false,
                                'showRemove' => true,
                                'msgRemove' => 'Are you sure you want to delete this file?',
                            ],
                            'id' => 'file_attach'
                        ]
                    ]) ?>

                    <!-- dummy -->

                    <?= $form->field($model, 'slider_photo')->widget(AttachmentsInput::classname(), [
                        'options' => [ 
                            'multiple' => true,
                            'accept' => 'application/pdf',
                            'id' => 'photo_attach'
                        ],
                        'pluginOptions' => [
                            'initialPreviewAsData' =>  true,
                            'autoReplace' => false,
                            'overwriteInitial' => false,
                            'maxFileCount' => 3,
                            'showUpload' => false,
                            'showCancel' => false,
                            'browseLabel' => '',
                            'removeLabel' => '',
                            'mainClass' => 'input-group-lg',
                            'browseClass' => 'btn btn-info',
                            'uploadClass' => 'btn btn-info',
                            'fileActionSettings'=> [
                                'showDrag' => false,
                                'showRemove' => true,
                                'msgRemove' => 'Are you sure you want to delete this file?',
                            ],
                        ]
                    ]) ?>

                    <?= $form->field($model, 'file_attachment')->widget(AttachmentsInput::classname(), [
                        'options' => [ 
                            'multiple' => true,
                            'accept' => 'application/pdf',
                            'id' => 'file_attach'
                        ],
                        'pluginOptions' => [
                            'initialPreviewAsData' =>  true,
                            'autoReplace' => false,
                            'overwriteInitial' => false,
                            'maxFileCount' => 3,
                            'showUpload' => false,
                            'showCancel' => false,
                            'browseLabel' => '',
                            'removeLabel' => '',
                            'mainClass' => 'input-group-lg',
                            'browseClass' => 'btn btn-info',
                            'uploadClass' => 'btn btn-info',
                            'fileActionSettings'=> [
                                'showDrag' => false,
                                'showRemove' => true,
                                'msgRemove' => 'Are you sure you want to delete this file?',
                            ],
                        ]
                    ]) ?>


            
            <?= Html::submitButton($model->isNewRecord ? '<i class="fas fa-save"></i> Create' : 'Update', [
                                'class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm',
                                'onclick' => "$('#file-input').fileinput('upload');"
                                    ]) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
