<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DilgInfoSystems */

$this->title = 'Update Dilg Info Systems: ' . $model->label;
$this->params['breadcrumbs'][] = ['label' => 'Dilg Info Systems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->label, 'url' => ['view', 'id' => $model->label]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dilg-info-systems-update">

    <?= $this->render('_form', [
        'model' => $model,
        'status' => $status
    ]) ?>

</div>
