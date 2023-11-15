<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\dialog\Dialog;
echo Dialog::widget(['overrideYiiConfirm' => true]);

/* @var $this yii\web\View */
/* @var $model common\modules\wfh\models\Record */

$this->title = date('F d, Y', strtotime($model->date)) . ' - ' . (($model->user && $model->user->userinfo) ? $model->user->userinfo->fullName : null);
$this->params['breadcrumbs'][] = ['label' => 'Work From Home', 'url' => ['dashboard/index']];
$this->params['breadcrumbs'][] = ['label' => 'Attendance Records (Admin)', 'url' => ['index-admin']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="record-view box">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
				'attribute' => 'user_id',
				'value' => function($model){
					return ($model->user && $model->user->userinfo) ? $model->user->userinfo->fullName : null; 
				},
			],
			[
				'attribute' => 'date',
				'value' => function($model){
					return date('F d, Y', strtotime($model->date));
				}
			],
			[
				'label' => 'Day',
				'value' => function($model){
					return date('l', strtotime($model->date));
				}
			],
            [
				'attribute' => 'time_in',
				'value' => function($model){
					return date('h:i A', strtotime($model->time_in));
				}
			],
            [
				'attribute' => 'time_out',
				'value' => function($model){
					return ($model->time_out) ? date('h:i A', strtotime($model->time_out)) : '-';
				}
			],
        ],
    ]) ?>

</div>
