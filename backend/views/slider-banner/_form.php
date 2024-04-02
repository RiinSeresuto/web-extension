<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use attachment\components\AttachmentsInput;

/* @var $this yii\web\View */
/* @var $model backend\models\SliderBanner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-banner-form">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <div class="col-md-12">
                    <?php $form = ActiveForm::begin(['id' => 'content_form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

                    <div>
                        <?= $form->field($model, 'slider_banner_id')->widget(Select2::class, [
                                'data' => ArrayHelper::map($sliderBannerType, 'id', 'slider_banner_type'),
                                'options' => [
                                    'placeholder' => 'Select Status',
                                ],
                            ]) ?>
                    </div>

                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                    <div>
                        <?=  '<label for="photo_attach">Upload Photo</label>' ?>
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

                    <div>
                        <?= $form->field($model, 'url')->textInput() ?>
                    </div>

                    <?= Html::submitButton($model->isNewRecord ? '<i class="fas fa-save"></i> Create' : '<i class="fas fa-edit"></i> Update', [
                        'class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm',
                        'onclick' => "$('#file-input').fileinput('upload');"
                            ]) ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
