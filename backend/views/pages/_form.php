<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use attachment\components\AttachmentsInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-form">

    <div class="form-group">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(['id' => 'content_form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

            <?php // $form->field($model, 'menu_id')->textInput() ?>

            <?= $form->field($model, 'menu_id')->dropDownList(
                ArrayHelper::map(Menu::getParentMenus(), 'id', 'label'),
                ['prompt' => 'Select Parent Menu']
            ) ?>


            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'url_type_id')->widget(Select2::class, [
                                        'data' => ArrayHelper::map($url, 'id', 'url_type'),
                                        'options' => [
                                            'placeholder' => 'Select URL Type',
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

                <div class="col-md-4">
                    <?= $form->field($model, 'type_id')->widget(Select2::class, [
                                        'data' => ArrayHelper::map($type, 'id', 'type'),
                                        'options' => [
                                            'placeholder' => 'Select Type',
                                        ],
                                    ]) ?>
                </div>
            </div>

            <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'caption')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'slider_photo')->textInput() ?>

            <?= $form->field($model, 'file_attachment')->textInput() ?>
            
            <?= Html::submitButton($model->isNewRecord ? '<i class="fas fa-save"></i> Create' : 'Update', [
                                'class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm',
                                'onclick' => "$('#file-input').fileinput('upload');"
                                    ]) ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
