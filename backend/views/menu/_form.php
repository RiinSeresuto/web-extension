<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;
use attachment\components\AttachmentsInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">

    <div class="form-group">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(['id' => 'content_form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

            <!-- Parent Menu -->
            <?= $form->field($model, 'parent_id')->widget(Select2::className(), [
                'data' => ArrayHelper::map($menu, 'id', 'label'),
                'options' => [
                    'placeholder' => 'Select Parent Menu',
                ],
                'pluginOptions' => [
                    'allowClear' => true
                 ]
            ]) ?>
        
            <!-- Label -->
            <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

            <div class="row">
                <!-- Menu Order -->
                <div class="col-md-3">
                    <?= $form->field($model, 'menu_order')->textInput() ?>
                </div>

                <!-- Position -->
                <div class="col-md-3">
                    <?= $form->field($model, 'position_id')->widget(Select2::class, [
                                        'data' => ArrayHelper::map($position, 'id', 'position'),
                                        'options' => [
                                            'placeholder' => 'Select Position',
                                        ],
                                    ]) ?>
                </div>
                
                <!-- Status -->
                <div class="col-md-3">
                    <?= $form->field($model, 'status_id')->widget(Select2::class, [
                                        'data' => ArrayHelper::map($status, 'id', 'status_type'),
                                        'options' => [
                                            'placeholder' => 'Select Status',
                                        ],
                                    ]) ?>
                </div>

                <!-- URL Type -->
                <div class="col-md-3">
                    <?= $form->field($model, 'url_type')->widget(SwitchInput::class, [
                        'pluginOptions' => [
                            'onText'=>'Internal',
                            'offText'=>'External'
                        ]
                    ]); ?> 
                </div>
            </div>


            <div class="row">
                <!-- New Tab -->
                <div class="col-md-2">
                    <?= $form->field($model, 'is_new_tab')->radioList(
                                        [
                                            1 => 'Yes',
                                            0 => 'No'
                                        ]
                                    ) ?>
                </div>

                <!-- Link -->
                <div class="col-md-10">
                    <?php // $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-md-10">
                    <?= $form->field($model, 'link')->textInput(['maxlength' => true, 'id' => 'menu-link', 'disabled' => $model->url_type == 1]) ?>
                </div>

            </div>

            <!-- Attachment -->
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
var switchInput = $('#menu-url_type');  //newly added
var linkField = $('#menu-link');        //newly added
var radios = $('input:radio[name="Menu[is_new_tab]"]')
var radioValue, labelValue, transformedValue



// Function to set link field state based on switch state
function setLinkFieldState(state) {
    if (state) { // External
        linkField.prop('disabled', false);
    } else { // Internal
        linkField.prop('disabled', true).val(''); // Clear and disable the field
    }
}

// When the URL type switch is changed
switchInput.on('switchChange.bootstrapSwitch', function(event, state) {
    setLinkFieldState(state);
});

// Initially set the state based on the default URL type
setLinkFieldState({$model->url_type});


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