<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Partners */

$this->title = 'Update Partners: ' . $model->label;
$this->params['breadcrumbs'][] = ['label' => 'Partners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->label, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="partners-update">

    <?= $this->render('_form', [
        'model' => $model,
        'status' => $status
    ]) ?>

</div>