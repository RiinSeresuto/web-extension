<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\wfh\models\Task */

$this->title = 'Create Task';
$this->params['breadcrumbs'][] = ['label' => 'Work From Home', 'url' => ['dashboard/index']];
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-create box">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_create', [
        'model' => $model,
		'employees' => $employees,
    ]) ?>

</div>
