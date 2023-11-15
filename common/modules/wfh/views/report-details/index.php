<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\wfh\models\ReportDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Report Details';
$this->params['breadcrumbs'][] = ['label' => 'Work From Home', 'url' => ['dashboard/index']];
$this->params['breadcrumbs'][] = ['label' => 'Accomplishment Report', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-details-index box">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($dataProvider->getCount() == 0) : ?>
		<div class="row">
			<div class="col-md-12">
				<div class="pull-right">
					<p>
						<?= Html::a('Create Report Details', ['create'], ['class' => 'btn btn-success']) ?>
					</p>
				</div>
			</div>
		</div>
    <?php endif ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'user_id',
            'employee_position',
            'approval_name',
            'approval_position',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
