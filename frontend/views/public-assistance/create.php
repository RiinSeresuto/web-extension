<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PublicAssistance */

$this->title = 'Create Public Assistance';
$this->params['breadcrumbs'][] = ['label' => 'Public Assistances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="public-assistance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'group' => $group
    ]) ?>

</div>