<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Pages */

$this->title = 'Update Page: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pages-update">

    <?= $this->render('_form', [
        'model' => $model,
        'url_type' => $url_type,
        'status' => $status,
        'type' => $type,
        'menu' => $menu,
        'childrenPath' => $childrenPath,
    ]) ?>

</div>
