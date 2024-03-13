<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <div class="form-group">
        <div class="col-md-12">

            <?php $form = ActiveForm::begin(['id' => 'content_form', 'options' => ['enctype' => 'multipart/form-data']]); ?><?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'category_id')->widget(Select2::class, [
                'data' => ArrayHelper::map($category, 'id', 'title'),
                'options' => [
                    'placeholder' => 'Select Category',
                ],
            ])?>

            <?= $form->field($model, 'forms_id')->textInput() ?>

            <?= $form->field($model, 'field_id')->textInput() ?>

            <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status_id')->textInput() ?>

            <?= $form->field($model, 'visibility_id')->textInput() ?>

            <?= $form->field($model, 'publish_id')->textInput() ?>

            <?= $form->field($model, 'page_id')->textInput() ?>

            <?= $form->field($model, 'start_date_time')->textInput() ?>

            <?= $form->field($model, 'end_date_time')->textInput() ?>

            <?= $form->field($model, 'min_answer')->textInput() ?>

            <?= $form->field($model, 'max_answer')->textInput() ?>

            <?= $form->field($model, 'user_id')->textInput() ?>

            <?= $form->field($model, 'user_update_id')->textInput() ?>

            <?= $form->field($model, 'date_created')->textInput() ?>

            <?= $form->field($model, 'date_updated')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
    
    

    <?php ActiveForm::end(); ?>

</div>
