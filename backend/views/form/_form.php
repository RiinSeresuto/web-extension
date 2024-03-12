<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Form */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-form">

    <div class="form-group">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(); ?>

             <?= $form->field($model, 'category_id')->widget(Select2::class, [
                'data' => ArrayHelper::map($category, 'id', 'title'),
                'options' => [
                    'placeholder' => 'Select Category',
                ],
            ])?>

            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'status_id')->widget(Select2::class, [
                                        'data' => ArrayHelper::map($status, 'id', 'status_type'),
                                        'options' => [
                                            'placeholder' => 'Select Status',
                                        ],
                                    ]) ?>

            <div class="field">
                <label for="field-label">Field</label>
                    <p>
                        <a class="badge badge-primary field-button" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Add Field
                        </a>
                    </p>
            </div>

            <!--  Field Selected -->
            <div class="card card-body" id="added-fields">
                <div>Selected Fields</div>
            </div>

            <!-- Adding of Fields -->
            <div class="collapse" id="collapseExample">
                <div class="card card-body" id="choices-fields">
                    
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-sm']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
$script = <<<JS
// ids = []

// window.addField = function(id, parent){
//     checkEmpty()
//     ids = [...ids, id]

//     parent.remove()

//     var removeElement = $('<div class="r-button" onclick="removeField(' + id + ', this.parentElement)"><span>-</span></div>')

//     $(parent).find('.a-button').replaceWith(removeElement);
//     $('#added-fields').append(parent)

//     console.log(ids)
// }

// window.removeField = function(id, parent){
//     checkEmpty()
//     ids = ids.filter(e => e !== id)

//     parent.remove()

//     var removeElement = $('<div class="a-button" onclick="addField(' + id + ', this.parentElement)"><span>+</span></div>')

//     $(parent).find('.r-button').replaceWith(removeElement);
//     $('#choices-fields').append(parent)

//     console.log(ids)
// }

// function checkEmpty() {
//     if (ids.length == 0) {
//         $('#selected-fields').empty()
//     }
// }
$.ajax({
        url: "/form/get-field",
        dataType: 'json',
       
        success: data => {
            // console.log(data)
            //$('#displayTerms').empty()
            
            $.each(data, function(key, value) {
                var element = $('<div class="row"><div class="a-button" onclick="addField(' + value.id + ', this.parentElement)"><span>+</span></div><div><span>' + value.label + '</span></div></div>')
                $('#choices-fields').append(element)
            })

        }
    })

JS;
$this->registerJs($script)
?>
