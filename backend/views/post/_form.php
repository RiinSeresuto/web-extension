<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
            <div class="col-md-12">

                <?php $form = ActiveForm::begin(['id' => 'content_form', 'options' => ['enctype' => 'multipart/form-data']]); ?><?php $form = ActiveForm::begin(); ?>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'category_id')->widget(Select2::class, [
                            'data' => ArrayHelper::map($category, 'id', 'title'),
                            'options' => [
                                'placeholder' => 'Select Category',
                            ],
                        ])?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($model, 'year')->widget(DatePicker::className(), [
                            'options' => ['placeholder' => "Select Year"],
                            'pluginOptions' => [
                                'format' => 'yyyy',
                                'autoclose' => true,
                                'minViewMode' => 'years',
                            ]
                        ]) ?>
                    </div>
                </div>

                <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($model, 'status_id')->widget(Select2::class, [
                            'data' => ArrayHelper::map($status, 'id', 'status_type'),
                            'options' => [
                                'placeholder' => 'Select Status',
                            ],
                        ]) ?>
                    </div>
                    
                    <div class="col-md-3">
                        <?= $form->field($model, 'visibility_id')->widget(Select2::class, [
                            'data' => ArrayHelper::map($visibility_type, 'id', 'visibility_type'),
                            'options' => [
                                'placeholder' => 'Select Visibility',
                            ],
                        ]) ?>
                    </div>

                    <div class="col-md-3">
                        <?= $form->field($model, 'publish_id')->widget(Select2::class, [
                            'data' => ArrayHelper::map($publish_type, 'id', 'publish_type'),
                            'options' => [
                                'placeholder' => 'Select Publish',
                            ],
                        ]) ?>
                    </div>

                    <div class="col-md-3">
                        <?= $form->field($model, 'page_id')->widget(Select2::class, [
                            'data' => ArrayHelper::map($page, 'id', 'title'),
                            'options' => [
                                'placeholder' => 'Select Pages',
                            ],
                        ]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($model, 'start_date_time')->widget(DateTimePicker::className(), [
                            'options' => ['placeholder' => "Select Start Date and Time"],
                            'pluginOptions' => [
                                'format' => 'dd-M-yyyy hh:ii',
                                'autoclose' => true,
                            ]
                        ]) ?>
                    </div>

                    <div class="col-md-3">
                        <?= $form->field($model, 'end_date_time')->widget(DateTimePicker::className(), [
                            'options' => ['placeholder' => "Select End Date and Time"],
                            'pluginOptions' => [
                                'format' => 'dd-M-yyyy hh:ii',
                                'autoclose' => true,
                            ]
                        ]) ?>
                    </div>
                    
                    <div class="col-md-3">
                        <?= $form->field($model, 'min_answer')->textInput() ?>
                    </div>
                    
                    <div class="col-md-3">
                        <?= $form->field($model, 'max_answer')->textInput() ?>
                    </div>
                </div>

                <?= Html::submitButton($model->isNewRecord ? '<i class="fas fa-save"></i> Save' : '<i class="fas fa-edit"></i> Update', [
                    'class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm',
                    'onclick' => "$('#file-input').fileinput('upload');"
                        ]) ?>
                
            </div>
        </div>

        <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
