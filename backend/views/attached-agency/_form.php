<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use attachment\components\AttachmentsInput;

/* @var $this yii\web\View */
/* @var $model backend\models\AttachedAgency */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attached-agency-form">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
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
                    <?= '<label for="photo_attach">Logo</label>' ?>
                    <?= AttachmentsInput::widget([
                        'model' => $model,
                        'id' => 'logo_attach',
                        'options' => [
                            'multiple' => true,
                            'accept' => 'png,jpg,jpeg',
                        ],
                        'pluginOptions' => [
                            'initialPreviewAsData' => true,
                            //'initialPreviewFileType' => 'pdf',
                            'autoReplace' => false,
                            'overwriteInitial' => false,
                            'maxFileCount' => 3,
                            //'allowedFileExtensions' => ['pdf'],
                            'showUpload' => false,
                            //'showBrowse' => false,
                            'showCancel' => true,
                            'browseLabel' => 'Browse...',
                            'removeLabel' => '',
                            'mainClass' => 'input-group-lg',
                            'browseClass' => 'btn btn-info',
                            'uploadClass' => 'btn btn-info',
                            'fileActionSettings' => [
                                'showDrag' => true,
                                'showRemove' => true,
                                //'showBrowse' => true,
                                'msgRemove' => 'Are you sure you want to delete this file?',
                            ]
                        ]
                    ]) ?>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'url')->hiddenInput(['class' => 'link_hidden', 'disabled' => true])->label(false) ?>
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