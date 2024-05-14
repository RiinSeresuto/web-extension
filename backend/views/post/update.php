<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */

$this->title = 'Update Post: ' . $model->forms->category->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->forms->category->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="post-update">

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