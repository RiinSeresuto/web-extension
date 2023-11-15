<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\wfh\models\ReportDetails */

$this->title = 'View Details' ;
$this->params['breadcrumbs'][] = ['label' => 'Work From Home', 'url' => ['dashboard/index']];
$this->params['breadcrumbs'][] = ['label' => 'Accomplishment Report', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = ['label' => 'Report Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="report-details-view box">

    <h1><?= Html::encode($this->title) ?></h1>
	<div class="row">
		<div class="col-md-12">
			<div class="pull-right">
				<?= \yii\bootstrap\ButtonDropdown::widget([
						'label' => '<span class="glyphicon glyphicon-menu-hamburger"></span> Menu',
						'dropdown' => [
							'items' => [
								['label' => '<span class="glyphicon glyphicon-pencil"></span> Update', 'url' => ['update', 'id' => $model->id]],
								['label' => '<span class="glyphicon glyphicon-trash"></span> Delete', 'url' => ['delete', 'id' => $model->id], 
									'linkOptions' => [
										'data' => [
											'confirm' => 'Are you sure you want to delete this item?',
											'method' => 'post',
										],
									],
								],
							],
							'options' => ['class'=>'dropdown-menu scrollable-menu pull-right'],
							'encodeLabels' => false,
						],
						'options' => [
							'class' => 'btn btn-md btn-primary'
						],
						'encodeLabel' => false,
					]);
				?>
			</div>
		</div>
	</div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'user_id',
            'employee_position',
            'approval_name',
            'approval_position',
        ],
    ]) ?>

</div>
