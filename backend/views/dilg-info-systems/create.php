<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DilgInfoSystems */

$this->title = 'Create DILG Information Systems';
$this->params['breadcrumbs'][] = ['label' => 'DILG Information Systems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dilg-info-systems-create">

    <?= $this->render('_form', [
        'model' => $model,
        'status' => $status
    ]) ?>

</div>
