<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use attachment\components\AttachmentsInput;

/* @var $this yii\web\View */
/* @var $model frontend\models\PublicAssistance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="public-assistance-form">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <?php $form = ActiveForm::begin(['id' => 'content_form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'contact_num')->textInput() ?>

                <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'group')->widget(Select2::class, [
                    'data' => ArrayHelper::map($group, 'id', 'p_a_group'),
                    'options' => [
                        'placeholder' => 'Select Group',
                    ],
                ]) ?>

                <div>
                    <?= '<label for="photo_attach">File Attachment</label>' ?>
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

                <?= Html::submitButton($model->isNewRecord ? '<i class="fas fa-save"></i> Create' : '<i class="fas fa-edit"></i> Update', [
                    'class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm',
                    'onclick' => "$('#file-input').fileinput('upload');"
                ]) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>