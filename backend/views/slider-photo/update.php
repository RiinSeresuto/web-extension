<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SliderPhoto */

$this->title = 'Update Slider Photo: ' . $model->caption;
$this->params['breadcrumbs'][] = ['label' => 'Slider Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->caption, 'url' => ['view', 'id' => $model->caption]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="slider-photo-update">

    <?= $this->render('_form', [
        'model' => $model,
        'status' => $status
    ]) ?>

</div>
