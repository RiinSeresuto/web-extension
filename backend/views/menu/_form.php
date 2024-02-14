<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\file\FileInput;

use app\models\Position;
use app\models\Status;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(['id' => 'content_form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php // $form->field($model, 'id')->textInput() ?>

    <?php // $form->field($model, 'parent_id')->textInput() ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'menu_order')->textInput() ?>

    <?= $form->field($model, 'position_id')->widget(Select2::class, [
                            'data' => ArrayHelper::map(Position::find()->all(), 'id', 'position'),
                            'options' => ['placeholder' => 'Select Position'],
                    ]) ?>

    <?= $form->field($model, 'status_id')->widget(Select2::class, [
                            'data' => ArrayHelper::map(Status::find()->all(), 'id', 'status_type'),
                            'options' => ['placeholder' => 'Select Status'],
                    ]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    

    <?= $form->field($model, 'logo_file[]')->widget(FileInput::classname(), [
            'options' => ['multiple' => true],
            'pluginOptions' => [
                'showUpload' => false,
                'initialPreviewAsData' => true,
            ]
        ]); ?>

    <?php // $form->field($model, 'user_id')->textInput() ?>

    <?php // $form->field($model, 'user_update_id')->textInput() ?>

    <?php // $form->field($model, 'date_created')->textInput() ?>

    <?php // $form->field($model, 'date_updated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> Save', ['class' => 'btn btn-success btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
