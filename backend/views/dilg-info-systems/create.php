<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DilgInfoSystems */

$this->title = 'Create Dilg Info Systems';
$this->params['breadcrumbs'][] = ['label' => 'Dilg Info Systems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dilg-info-systems-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
