<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */

$this->title = 'Update Post: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="post-update">

    <h1>
        <?= Html::encode($this->title) ?>
    </h1>

    <?= $this->render('_form', [
        'model' => $model,
        'category' => $category,
        'form_fields' => $form_fields,
        'status' => $status,
        'visibility_type' => $visibility_type,
        'publish_type' => $publish_type,
        'page' => $page
    ]) ?>

</div>