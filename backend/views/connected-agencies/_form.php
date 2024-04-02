<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use attachment\components\AttachmentsInput;

/* @var $this yii\web\View */
/* @var $model backend\models\ConnectedAgencies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="connected-agencies-form">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <div class="col-md-12">
                    <?php $form = ActiveForm::begin(['id' => 'content_form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'agency_type_id')->widget(Select2::class, [
                                    'data' => ArrayHelper::map($agency_type, 'id', 'agency_type'),
                                    'options' => [
                                        'placeholder' => 'Select Agency Type',
                                    ],
                                ]) ?>
                        </div>

                        <div class="col-md-4">
                            <?= $form->field($model, 'agency_order')->textInput() ?>
                        </div>

                        <div class="col-md-4">
                            <?= $form->field($model, 'status_id')->widget(Select2::class, [
                                                    'data' => ArrayHelper::map($status, 'id', 'status_type'),
                                                    'options' => [
                                                        'placeholder' => 'Select Status',
                                                    ],
                                                ]) ?>
                        </div>
                    </div>

                    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

                    <div class="row">
                        <div class="col-md-12">
                            <?=  '<label for="photo_attach">Logo</label>' ?>
                            <?=  AttachmentsInput::widget([
                                        'model' => $model,
                                        'id' => 'photo_attach',
                                        'options' => [ 
                                            'multiple' => true,
                                            'accept' => 'application/pdf',
                                            'name' => 'photo_attach'
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
                            </div>

                            <!-- <div class="col-md-6">
                            <?php // '<label for="photo_attach">File Upload</label>' ?>
                                <?php //  AttachmentsInput::widget([
                                //     'model' => $model,
                                //     'id' => 'file_upload',
                                //     'options' => [ 
                                //         'multiple' => true,
                                //         'accept' => 'application/pdf',
                                //         'name' => 'file_upload'
                                //     ],
                                //     'pluginOptions' => [
                                //         'initialPreviewAsData' =>  true,
                                //         //'initialPreviewFileType' => 'pdf',
                                //         'autoReplace' => false,
                                //         'overwriteInitial' => false,
                                //         'maxFileCount' => 3,
                                //         //'allowedFileExtensions' => ['pdf'],
                                //         'showUpload' => false,
                                //         'showCancel' => false,
                                //         'browseLabel' => 'Browse',
                                //         'removeLabel' => '',
                                //         'mainClass' => 'input-group-lg',
                                //         'browseClass' => 'btn btn-info',
                                //         'uploadClass' => 'btn btn-info',
                                //         'fileActionSettings'=> [
                                //             'showDrag' => false,
                                //             'showRemove' => true,
                                //             'msgRemove' => 'Are you sure you want to delete this file?',
                                //         ]
                                //     ]
                                // ]) ?>
                            </div> -->
                    </div>
                    

                    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

                    <?= Html::submitButton($model->isNewRecord ? '<i class="fas fa-save"></i> Create' : '<i class="fas fa-edit"></i> Update', [
                                'class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm',
                                'onclick' => "$('#file-input').fileinput('upload');"
                                    ]) ?>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
