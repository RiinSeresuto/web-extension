<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use common\modules\wfh\assets\AppAsset;

AppAsset::register($this);

$BASE_URL = Url::base(true);
$this->registerJs("const BASE_URL = '{$BASE_URL}';", View::POS_HEAD);

$this->beginContent('@app/views/layouts/main.php');
if(Yii::$app->user->can('WFH_Administrator')):
?>
<div class="box">
	<h1>WFH Admin Panel</h1>
	<div class="row">
		<div class="col-md-12">
			<p class="pull-right">
				<?= Html::a('View All Attendance Records', ['record/index-admin'], ['class' => 'btn btn-primary']);?>
				<?= Html::a('View All Tasks', ['task/index-admin'], ['class' => 'btn btn-primary']);?>
				<?= Html::a('Create Attendance Record', ['record/create'], ['class' => 'btn btn-success']);?>
			</p>
		</div>
	</div>
</div>
<?php
endif;
	echo $content;
?>
<?php $this->endContent(); ?>