<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\wfh\models\Record */

$this->title = 'Create Record';
$this->params['breadcrumbs'][] = ['label' => 'Work From Home', 'url' => ['dashboard/index']];
$this->params['breadcrumbs'][] = ['label' => 'Attendance Records (Admin)', 'url' => ['index-admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="record-create box">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
