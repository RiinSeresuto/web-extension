<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Pages */

$this->title = 'Create Page';
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-create">

    <?= $this->render('_form', [
        'model' => $model,
        'url_type' => $url_type,
        'status' => $status,
        'type' => $type,
        'menu' => $menu,
        'childrenPath' => $childrenPath,
    ]) ?>

</div>
