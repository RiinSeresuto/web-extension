<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model backend\models\Field */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="field-form">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <div class="col-md-12">
                    <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'data_type_id')->widget(Select2::class, [
                                    'data' => ArrayHelper::map($data_type, 'id', 'data_type'),
                                    'options' => [
                                        'placeholder' => 'Select Data Type',
                                    ]
                                ]) ?>
                            </div>

                            <div class="col-md-6">
                                <?= $form->field($model, 'widget_type_id')->widget(Select2::class, [
                                    'data' => ArrayHelper::map($widget_type, 'id', 'widget_type'),
                                    'options' => [
                                        'placeholder' => 'Select Widget Type',
                                    ],
                                    'pluginEvents' => [
                                        'select2:select' => '
                                            function(){
                                                var field_id = this.value
                                                selectFieldItems(field_id)
                                            }
                                        '
                                    ]
                                ]) ?>
                            </div>
                        </div>

                        <div class="field">
                            <label for="field-label" id="select2-selection">Field Items:</label>
                                <p><a class="badge badge-primary field-button">
                                        Add Item
                                    </a></p>
                                    <div class="panel panel-default">
                                        <!-- <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Addresses</h4></div> -->
                                        <div class="panel-body">
                                            <?php DynamicFormWidget::begin([
                                                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                                                'widgetBody' => '.container-items', // required: css class selector
                                                'widgetItem' => '.item', // required: css class
                                                //'limit' => 4, // the maximum times, an element can be cloned (default 999)
                                                'min' => 1, // 0 or 1 (default 1)
                                                'insertButton' => '.add-item', // css class
                                                'deleteButton' => '.remove-item', // css class
                                                'model' => $modelsChildren[0],
                                                'formId' => 'dynamic-form',
                                                'formFields' => [
                                                    'form_id',
                                                    'value',
                                                    'label'
                                                ],
                                            ]); ?>

                                            <div class="container-items"><!-- widgetContainer -->
                                            <?php foreach ($modelsChildren as $i => $child): ?>
                                                <div class="item panel panel-default"><!-- widgetBody -->
                                                    <div class="panel-heading">
                                                        <!-- <h3 class="panel-title pull-left">Address</h3> -->
                                                        <div class="pull-right">
                                                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="panel-body">
                                                        <?php
                                                            // // necessary for update action.
                                                            // if (! $modelsChildren->isNewRecord) {
                                                            //     echo Html::activeHiddenInput($modelAddress, "[{$i}]id");
                                                            // }
                                                        ?>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <?= $form->field($child, "[{$i}]form_id")->textInput(['maxlength' => true]) ?>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <?= $form->field($child, "[{$i}]value")->textInput(['maxlength' => true]) ?>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <?= $form->field($child, "[{$i}]label")->textInput(['maxlength' => true]) ?>
                                                            </div>
                                                        </div><!-- .row -->

                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                            </div>
                                            <?php DynamicFormWidget::end(); ?>
                                        </div>
                                    </div>
                        </div>

                        
                        <div class="form-group">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-sm']) ?>
                        </div>
                </div>
            </div>                         
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php
$script = <<<JS

function selectFieldItems(field_id){
    if (field_id == 3) {
        $('#select2-selection').show()
    } else {
        $('#select2-selection').hide()
    }
}

$('#select2-selection').hide()


$(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
    console.log("beforeInsert");
});

$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    console.log("afterInsert");
});

$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
    if (! confirm("Are you sure you want to delete this item?")) {
        return false;
    }
    return true;
});

$(".dynamicform_wrapper").on("afterDelete", function(e) {
    console.log("Deleted item!");
});

$(".dynamicform_wrapper").on("limitReached", function(e, item) {
    alert("Limit reached");
});

JS;
$this->registerJs($script);
?>