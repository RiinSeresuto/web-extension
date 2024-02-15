<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ConnectedAgencies */

$this->title = 'Create Connected Agencies';
$this->params['breadcrumbs'][] = ['label' => 'Connected Agencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="connected-agencies-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
