<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SliderBanner */

$this->title = 'Create Slider Banner';
$this->params['breadcrumbs'][] = ['label' => 'Slider Banners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-banner-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
