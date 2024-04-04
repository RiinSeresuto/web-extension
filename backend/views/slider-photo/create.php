<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SliderPhoto */

$this->title = 'Create Slider Photo';
$this->params['breadcrumbs'][] = ['label' => 'Slider Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-photo-create">

    <?= $this->render('_form', [
        'model' => $model,
        'status' => $status
    ]) ?>

</div>
