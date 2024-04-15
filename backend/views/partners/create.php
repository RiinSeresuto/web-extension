<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Partners */

$this->title = 'Create Partners';
$this->params['breadcrumbs'][] = ['label' => 'Partners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partners-create">

    <?= $this->render('_form', [
        'model' => $model,
        'status' => $status
    ]) ?>

</div>
