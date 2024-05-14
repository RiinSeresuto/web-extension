<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AttachedAgency */

$this->title = 'Update Attached Agency: ' . $model->label;
$this->params['breadcrumbs'][] = ['label' => 'Attached Agencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->label, 'url' => ['view', 'id' => $model->label]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="attached-agency-update">

    <?= $this->render('_form', [
        'model' => $model,
        'status' => $status
    ]) ?>

</div>