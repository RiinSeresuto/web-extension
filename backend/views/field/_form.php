<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

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

                    <?= $form->field($modelField, 'label')->textInput(['maxlength' => true]) ?>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($modelField, 'data_type_id')->widget(Select2::class, [
                                'data' => ArrayHelper::map($data_type, 'id', 'data_type'),
                                'options' => [
                                    'placeholder' => 'Select Data Type',
                                ]
                            ]) ?>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($modelField, 'widget_type_id')->widget(Select2::class, [
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

                    <?php if ($modelField->isNewRecord): ?>

                        <div class="" id="select2-selection">
                            <label for="field-label">Field Items:</label>
                            <p>
                                <a class="badge badge-primary field-button" onClick="addInputs()">
                                    Add Item
                                </a>
                            </p>
                            <div class="panel">
                                <div class="panel-body dynamic-form" id="dynamicItems"></div>
                            </div>
                        </div>

                    <?php else: ?>
                        <?php if ($modelField->widget_type_id == 3): ?>
                            <h3>Select 2 Options</h3>
                            <?php foreach ($modelWidgetSelect2Items as $id => $value): ?>
                                <div class="row">
                                    <div class="col-6">
                                        <?= $form->field($value, "[$id]value")->textInput(['maxlength' => true])->label() ?>
                                    </div>
                                    <div class="col-6">
                                        <?= $form->field($value, "[$id]label")->textInput(['maxlength' => true])->label() ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>


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
$script = <<<'JS'
function selectFieldItems(field_id){
    if (field_id == 3) {
        $('#select2-selection').show()
    } else {
        $('#select2-selection').hide()
    }
}

$('#select2-selection').hide()
JS;

$dynamicInputScript = <<<'JS'
var dynamicSelect2Items = [
    {value: "", label: ""}
]

window.addInputs =  function(){
    var emptyItem = {value: "", label: ""}

    dynamicSelect2Items.push(emptyItem)

    mapInputs()
}

window.removeInput = function(index){
    dynamicSelect2Items.splice(index, 1)
    mapInputs()
}

window.mapInputs = function(){
    $("#dynamicItems").empty()

    $.each(dynamicSelect2Items, (index, item) => {
        let labelValue = `<label for="widgetselect2items-${index}-value">Value:</label>`

        let valueField = `<input 
                            type="text"
                            id="widgetselect2items-${index}-value"
                            class="form-control"
                            name="WidgetSelect2Items[${index}][value]"
                            maxlength="255" aria-required="true"
                            onChange="editValue(this.value, ${index})"
                            value="${item.value}"
                        >`
        let labelLabel = `<label for="widgetselect2items-${index}-label">Label:</label>` 

        let labelField = `<input
                            type="text"
                            id="widgetselect2items-${index}-label"
                            class="form-control"
                            name="WidgetSelect2Items[${index}][label]"
                            maxlength="255"
                            aria-required="true"
                            onChange="editLabel(this.value, ${index})"
                            value="${item.label}"
                        >`

        let removeButton = `<a class="badge badge-danger field-button" onClick="removeInput(${index})">Remove Item</a>`
        
        let rowElement = `<div class="row">
                                    <div class="col-4">
                                        ${labelValue}
                                        ${valueField}
                                    </div>
                                    <div class="col-4">
                                        ${labelLabel}
                                        ${labelField}
                                    </div>
                                    <div class="col-4">
                                        ${removeButton}
                                    </div>
                            </div>`
        
        $("#dynamicItems").append(rowElement)
    })

    log(dynamicSelect2Items)
}

window.editValue = function(value, index){
    dynamicSelect2Items[index].value = value
    mapInputs()
}

window.editLabel = function(label, index){
    dynamicSelect2Items[index].label = label
    mapInputs()
}
JS;

if ($modelField->isNewRecord) {
    $this->registerJs($script);
    $this->registerJs($dynamicInputScript);
}

?>