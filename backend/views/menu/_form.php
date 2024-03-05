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
                    <?= $form->field($model, 'url_type')->widget(Select2::class, [
                                        'data' => ArrayHelper::map($url_type, 'id', 'url_type'),
                                        'options' => [
                                            'placeholder' => 'Select URL Type',
                                        ],
                                        'pluginEvents' => [
                                            'select2:select' => '
                                                    function(){
                                                        var url_type = this.value
                                                        urlFieldState(url_type)
                                                    }
                                                '
                                        ]                        
                                    ]) ?>
                </div>
            </div>


            <div class="row">
               

                <!-- Link -->
                <div class="col-md-10">
                    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'link')->hiddenInput(['class' => 'link_hidden'])->label(false) ?>
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
var radios = $('input:radio[name="Menu[is_new_tab]"]')
var radioValue, labelValue, transformedValue

// radios.change(function(){   //change & on = event listener -> nililisten if may change sa value or key up
//     radioValue = $('input:radio[name="Menu[is_new_tab]"]:checked').val()    // pag nagchange kukunin ung value
//     if(radioValue === 0){
//         $('#menu-link').val(transformedValue)
//     } else {
//         $('#menu-link').val('')
//     }
// })
var label = $('#menu-label')    //
label.on('keyup', function(){       //lalabas din ung value pag nagchange din
    labelValue = label.val()

    transformedValue = '/' + labelValue.toLowerCase().replace(/\s+/g, '-')      //simple concat, ung value change to lower case and replace to -

    $('#menu-link').val(transformedValue)
    $('.link_hidden').val(transformedValue)       
})

function urlFieldState(value){
    if(value == 1){
        $('#menu-link').prop('disabled', true)
        $('.link_hidden').prop('disabled', false)
    } else {
        $('#menu-link').prop('disabled', false)
        $('.link_hidden').prop('disabled', true)
    }
}
JS;
$this->registerJs($script)
?>
