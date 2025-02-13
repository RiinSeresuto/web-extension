<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Form */

$this->title = 'Update Form: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'category' => $category,
        'status' => $status,
        'field' => $field
    ]) ?>

</div>
