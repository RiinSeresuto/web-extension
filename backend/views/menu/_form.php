<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use kartik\file\FileInput;
use kartik\select2\Select2;

use backend\models\Position;
use backend\models\Status;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'id')->textInput() ?>

    <?php // $form->field($model, 'parent_id')->textInput() ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'menu_order')->textInput() ?>

    <?php // $form->field($model, 'position_id')->textInput() ?>

    <?= $form->field($model, 'position_id')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Position::find()->all(), 'id', 'position'),
                        'options' => [
                            'placeholder' => 'Select Position',
                        ],
                    ]) ?>

    <?php // $form->field($model, 'status_id')->textInput() ?>

    <?= $form->field($model, 'status_id')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Status::find()->all(), 'id', 'status_type'),
                        'options' => [
                            'placeholder' => 'Select Status',
                        ],
                    ]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'logo_file')->textInput() ?>

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
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
