<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SliderBanner */

$this->title = 'Create Slider & Banner';
$this->params['breadcrumbs'][] = ['label' => 'Slider & Banner', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-banner-create">

    <?= $this->render('_form', [
        'model' => $model,
        'sliderBannerType' => $sliderBannerType
    ]) ?>

</div>
