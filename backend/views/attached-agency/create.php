<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AttachedAgency */

$this->title = 'Create Attached Agency';
$this->params['breadcrumbs'][] = ['label' => 'Attached Agencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attached-agency-create">

    <?= $this->render('_form', [
        'model' => $model,
        'status' => $status
    ]) ?>

</div>