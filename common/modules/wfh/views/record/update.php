<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\wfh\models\Record */

$title = date('F d, Y', strtotime($model->date)) . ' - ' . (($model->user && $model->user->userinfo) ? $model->user->userinfo->fullName : null);
$this->title = 'Update Record: ' . $title;
$this->params['breadcrumbs'][] = ['label' => 'Work From Home', 'url' => ['dashboard/index']];
$this->params['breadcrumbs'][] = ['label' => 'Attendance Records (Admin)', 'url' => ['index-admin']];
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="record-update box">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
