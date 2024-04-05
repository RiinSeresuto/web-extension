<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Field */

$this->title = 'Create Field';
$this->params['breadcrumbs'][] = ['label' => 'Fields', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="field-create">

    <?= $this->render('_form', [
        'modelField' => $modelField,
        'data_type' => $data_type,
        'widget_type' => $widget_type,
        'modelWidgetSelect2Items' => $modelWidgetSelect2Items
    ]) ?>

</div>