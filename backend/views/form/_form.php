<?php

use kartik\date\DatePicker;
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

            <?= $form->field($model, 'year_id')->widget(DatePicker::className(), [
                    'options' => ['placeholder' => "Select Year"],
                    'pluginOptions' => [
                        'format' => 'yyyy',
                        'autoclose' => true,
                        'minViewMode' => 'years',
                    ]
                ]) ?>
                    
            <?= $form->field($model, 'field_id')->widget(Select2::class, [
                'data' => ArrayHelper::map($field, 'id', 'label'),
                'options' => [
                    'placeholder' => 'Select Field',
                ]
            ])?>

            <!--  -->
            <div class="card card-body" id="added-fields">

            </div>

            <p>
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                Add Fields
            </a>
           
            </p>
            <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <?php if(!empty($field)): ?>
                    <?php foreach ($field as $field):?>
                        <div class="row">
                            <!-- <div class="r-button"><span>-</span></div> -->
                            <div onclick="addField(<?= $field->id?>, this.parentElement)" class="a-button"><span>+</span></div>
                            <div><span><?= $field->label?></span></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif;?>
            </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
$script = <<<JS
ids = []

window.addField = function(id, parent){
    ids = [...ids, id]
    console.log(parent)
    parent.remove()

    $('#added-fields').append(parent)
}
JS;
$this->registerJs($script)
?>
