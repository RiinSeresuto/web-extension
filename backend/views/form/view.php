<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

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
            Form Details: <?= $this->title = $model->category->title; ?>
        </div>
        <div class="text-right buttons">
            <?= Html::a('<i class="fas fa-arrow-circle-left"></i> Back', ['index', 'id' => $model->id], ['class' => 'btn btn-info btn-sm']) ?>
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
                            'value' => function($model){
                                return $model->category->title;
                            },
                        ],
                        'description',
                        [
                            'attribute' => 'status_id',
                            'value' => function($model){
                                return $model->status->status_type;
                            },
                        ],
                        'year',
                        [
                            'attribute' => 'user_id',
                            'value' => function($model){
                                return $model->user->username;
                            },
                        ],
                        [
                            'attribute' => 'user_update_id',
                            'value' => function($model){
                                return $model->user->username;
                            }
                        ],
                        [
                            'attribute' => 'date_created',
                            'value' => function($model){
                                return ($model->date_created) ? date('F d, Y h:i A', strtotime($model->date_created)) : null; 
                            },
                        ],
                        [
                            'attribute' => 'date_updated',
                            'value' => function($model){
                                return ($model->date_updated) ? date('F d, Y h:i A', strtotime($model->date_updated)) : null; 
                            },
                        ],
                    ],
                ]) ?>
            <div class="row view-field">
                <div class="col-md-12">
                    
                    <?php
                        // echo '<pre>';
                        // print_r($model->formField);
                        // exit;

                        
                        // foreach ($model->formField as $key => $value) {
                        //     echo '<pre>';
                        //     print_r($value->widgetType);
                        //     exit;


                        // }
                    
                    ?>

                    <?php $form = ActiveForm::begin(); ?>
                        <?php foreach ($model->formField as $key => $value) : ?> <!-- model->function(model)->value -->
                            <!-- Text Area -->
                            <?php if($value->field_id == 1) : ?> 
                                <?= Html::tag('label', $value->field->label, $options=['class'=>'form-control','maxlength'=>10, 'style'=>'width:350px']) ?>
                                <?= Html::input('area','','', $options=['class'=>'form-control','maxlength'=>10, 'style'=>'width:350px']) ?>
                            <!-- Text Feild-->
                            <?php elseif ($value->field_id == 2) : ?>
                                <?= Html::tag('label', $value->field->label, $options=['class'=>'form-control','maxlength'=>10, 'style'=>'width:350px']) ?>
                                <?= Html::input('text','','', $options=['class'=>'form-control','maxlength'=>10, 'style'=>'width:350px']) ?>
                            <!-- Select2-->
                            <?php elseif ($value->field_id == 3) : ?>
                                <?= Html::tag('label', $value->field->label, $options=['class'=>'form-control','maxlength'=>10, 'style'=>'width:350px']) ?>
                                <?= Select2::widget([
                                    'name' => 'state_10',
                                    'data' => [1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five'],
                                    'options' => [
                                        'placeholder' => 'Select provinces ...',
                                        'multiple' => true
                                    ],
                                ]); ?>
                            <?php elseif ($value->field_id == 4) :?>
                                
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php ActiveForm::end(); ?>
                        
                </div>
            </div>
        </div>
    </div>
</div>
