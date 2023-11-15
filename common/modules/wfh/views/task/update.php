<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\wfh\models\Task */

$this->title = 'Update Task: ' . Yii::$app->formatter->asHtml($model->shortDescription);
$this->params['breadcrumbs'][] = ['label' => 'Work From Home', 'url' => ['dashboard/index']];
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::$app->formatter->asHtml($model->shortDescription), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-update box">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
		$view = '_form_update';
		if($s == 'Ongoing'){
			$view = '_form_ongoing';
		}else if($s == 'On Hold'){
			$view = '_form_onhold';
		}else if($s == 'Completed'){
			$view = '_form_completed';
		}else if($s == 'Cancelled'){
			$view = '_form_cancelled';
		}

		echo $this->render($view, [
			'model' => $model,
			'employees' => $employees,
			's' => $s,
		]);
	?>

</div>
