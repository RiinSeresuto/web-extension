<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ConnectedAgencies */

$this->title = 'Create Connected Agencies';
$this->params['breadcrumbs'][] = ['label' => 'Connected Agencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="connected-agencies-create">
    
    <?= $this->render('_form', [
        'model' => $model,
        'agency_type' => $agency_type,
        'status' => $status
    ]) ?>

</div>
