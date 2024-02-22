<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use attachment\components\AttachmentsInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">

    <div class="form-group">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(['id' => 'content_form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
        
            <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

            
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'menu_order')->textInput() ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'position_id')->widget(Select2::class, [
                                        'data' => ArrayHelper::map($position, 'id', 'position'),
                                        'options' => [
                                            'placeholder' => 'Select Position',
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
            </div>

                <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

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
                            ]
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
