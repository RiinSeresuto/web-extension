<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\wfh\models\ReportDetails */

$this->title = 'Create Report Details';
$this->params['breadcrumbs'][] = ['label' => 'Work From Home', 'url' => ['dashboard/index']];
$this->params['breadcrumbs'][] = ['label' => 'Accomplishment Report', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = ['label' => 'Report Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-details-create box">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
