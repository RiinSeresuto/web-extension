<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */

$this->title = 'Create Post';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">
    <?= $this->render("_create", [
        'model' => $model,
        'category' => $category,
        'forms' => $forms,
        'status' => $status,
        'visibility_type' => $visibility_type,
        'publish_type' => $publish_type,
        'page' => $page,
        'form_fields' => isset($form_fields) == null ? null : $form_fields,
        'form_title' => isset($form_title) == null ? null : $form_title
    ]) ?>
</div>