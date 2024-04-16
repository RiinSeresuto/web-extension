<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\editors\Summernote;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use common\helpers\Getter;
use attachment\components\AttachmentsInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Form */
$this->title = $model->category->title;
$this->params['breadcrumbs'][] = ['label' => 'Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="form-view">
    <div class="card">
        <div class="card-header">
            Form Details:
            <?= $this->title = $model->category->title; ?>
        </div>
        <div class="text-right buttons">
            <?= Html::a('<i class="fas fa-arrow-circle-left"></i> Back', ['index', 'id' => $model->id], ['class' => 'btn btn-secondary btn-sm']) ?>
            <?= Html::a('<i class="fas fa-edit"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::a('<i class="fas fa-trash-alt"></i> Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-sm',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        <div class="card-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [

                    [
                        'attribute' => 'category_id',
                        'value' => function ($model) {
                            return $model->category->title;
                        },
                    ],
                    'description',
                    [
                        'attribute' => 'status_id',
                        'value' => function ($model) {
                            return $model->status->status_type;
                        },
                    ],
                    'year',
                    [
                        'attribute' => 'user_id',
                        'value' => function ($model) {
                            return $model->user->username;
                        },
                    ],
                    [
                        'attribute' => 'date_created',
                        'value' => function ($model) {
                            return ($model->date_created) ? date('F d, Y h:i A', strtotime($model->date_created)) : null;
                        },
                    ],
                    [
                        'attribute' => 'user_update_id',
                        'value' => function ($model) {
                            return $model->user_update_id == null ? "(not set)" : $model->userUpdate->username;
                        },
                    ],
                    [
                        'attribute' => 'date_updated',
                        'value' => function ($model) {
                            return $model->date_updated == null ? "(not set)" : date('F d, Y h:i A', strtotime($model->date_updated));
                        }
                    ]
                ],
            ]) ?>


        </div>
    </div>
    <div class="card">
        <div class="card-header">Form</div>
        <div class="card-body">
            <div class="row view-field">
                <div class="col-md-12">
                    <?php $form = ActiveForm::begin(); ?>

                    <?php foreach ($model->formField as $key => $value): ?> <!-- model->function(model)->value -->
                        <?php if ($value->field->widget_type_id == 1): ?> <!-- -->
                            <?= Html::tag('label', $value->field->label, $options = ['class' => 'form-label']) ?>
                            <?= Html::tag('img', '', $options = ['src' => Url::base() . '/images/summernote-ss.png', 'class' => 'input-preview']) ?>

                        <?php elseif ($value->field->widget_type_id == 2): ?>
                            <?= Html::tag('label', $value->field->label, $options = ['class' => 'form-label']) ?>
                            <?= Html::input('text', '', '', $options = ['class' => 'form-control', 'maxlength' => 10, 'readonly' => 'true']) ?>
                        <?php elseif ($value->field->widget_type_id == 3): ?>

                            <?= Html::tag('label', $value->field->label, $options = ['class' => 'form-label']) ?>
                            <?= Select2::widget([
                                'name' => 'state_10',
                                'data' => Getter::getOptions($value->field->id),
                                'options' => [
                                    'placeholder' => 'Select provinces ...',
                                    'id' => 'test-select2'
                                    //'multiple' => true
                                ],
                            ]); ?>
                        <?php elseif ($value->field->widget_type_id == 4): ?>
                            <div class="form-label">
                                <?= $value->field->label ?>
                            </div>
                            <?= DatePicker::widget([
                                'name' => 'dp_3',
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'value' => '23-Feb-1982',
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd-M-yyyy'
                                ]
                            ]); ?>
                        <?php elseif ($value->field->widget_type_id == 5): ?>
                            <div class="form-label">
                                <?= Html::tag('label', $value->field->label, $options = ['class' => 'form-label']) ?>
                                <?= Html::tag('img', '', $options = ['src' => Url::base() . '/images/file-input.png', 'class' => 'input-preview']) ?>
                            </div>

                        <?php endif; ?>

                    <?php endforeach; ?>
                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
$style = <<<'CSS'
.input-preview{
    width: 100%;
    display: block;
}
CSS;

$this->registerCss($style);
?>

<?php
$script = <<<JS

JS;
$this->registerJs($script);
?>