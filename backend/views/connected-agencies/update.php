<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ConnectedAgencies */

$this->title = 'Update Connected Agencies: ' . $model->label;
$this->params['breadcrumbs'][] = ['label' => 'Connected Agencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->label, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="connected-agencies-update">

    <?= $this->render('_form', [
        'model' => $model,
        'agency_type' => $agency_type,
        'status' => $status
    ]) ?>

</div>
