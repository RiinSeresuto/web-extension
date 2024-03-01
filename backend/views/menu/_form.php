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

            <?= $form->field($model, 'parent_id')->widget(Select2::className(), [
                'data' => ArrayHelper::map($menu, 'id', 'label'),
                'options' => [
                    'placeholder' => 'Select Parent Menu',
                    
                ],
                'pluginOptions' => [
                    'allowClear' => true
                 ]
            ]) ?>
        
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

            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($model, 'is_new_tab')->radioList(
                                        [
                                            1 => 'Yes',
                                            0 => 'No'
                                        ]
                                    ) ?>
                </div>

                <div class="col-md-10">
                    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div>
                <?=  '<label for="photo_attach">File Upload</label>' ?>
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
                            'browseLabel' => '',
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
            <?= Html::submitButton($model->isNewRecord ? '<i class="fas fa-save"></i> Create' : '<i class="fas fa-edit"></i> Update', [
                'class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm',
                'onclick' => "$('#file-input').fileinput('upload');"
                    ]) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
$script = <<<JS
var radios = $('input:radio[name="Menu[is_new_tab]"]')
var radioValue, labelValue, transformedValue

radios.change(function(){   //change & on = event listener -> nililisten if may change sa value or key up
    radioValue = $('input:radio[name="Menu[is_new_tab]"]:checked').val()    // pag nagchange kukunin ung value
    if(radioValue === 0){
        $('#menu-link').val(transformedValue)
    } else {
        $('#menu-link').val('')
    }
})
var label = $('#menu-label')    //
label.on('keyup', function(){       //lalabas din ung value pag nagchange din
    labelValue = label.val()

    transformedValue = '/' + labelValue.toLowerCase().replace(/\s+/g, '-')      //simple concat, ung value change to lower case and replace to -

    $('#menu-link').val(transformedValue)       
})
JS;
$this->registerJs($script)
?>