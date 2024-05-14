<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PublicAssistance */

$this->title = 'Update Public Assistance: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Public Assistances', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="public-assistance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
