<?php

//use backend\models\Position;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\MenuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'label') ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'position_id')->widget(Select2::class, [
                'data' => ArrayHelper::map($position, 'id', 'position'),
                'options' => [
                    'placeholder' => 'Select Position',
                ],
            ]) ?>

            <?php // echo $form->field($model, 'position_id')->widget(Select2::class, [
            //     'data' => Position::getPositionDropdown(),
            //     'options' => [
            //         'placeholder' => 'Select Position',
            //     ]
            // ]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-search"></i> Search', ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::resetButton('<i class="fas fa-undo-alt"></i> Reset', ['class' => 'btn btn-outline-secondary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>