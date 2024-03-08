<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Field */

$this->title = 'Update Field: ' . $model->label;
$this->params['breadcrumbs'][] = ['label' => 'Fields', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->label, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="field-update">

    <?= $this->render('_form', [
        'model' => $model,
        'data_type' => $data_type,
        'widget_type' => $widget_type
    ]) ?>

</div>
