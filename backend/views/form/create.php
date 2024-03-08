<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Form */

$this->title = 'Create Form';
$this->params['breadcrumbs'][] = ['label' => 'Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-create">

    <?= $this->render('_form', [
        'model' => $model,
        'status' => $status,
        'category' => $category,
        'field' => $field
    ]) ?>

</div>
