<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Field */

$this->title = 'Update Field: ' . $modelField->label;
$this->params['breadcrumbs'][] = ['label' => 'Fields', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelField->label, 'url' => ['view', 'id' => $modelField->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="field-update">

    <?= $this->render('_form', [
        'modelField' => $modelField,
        'data_type' => $data_type,
        'widget_type' => $widget_type,
        'modelWidgetSelect2Items' => $modelWidgetSelect2Items
    ]) ?>

</div>