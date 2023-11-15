<?php
use yii\helpers\Html;
use yii\helpers\Url;

$panelClass = [ 'Ongoing' => 'danger', 'On Hold' => 'warning', 'Completed' => 'success', 'Cancelled' => 'info'];

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = ['label' => 'Work From Home', 'url' => ['dashboard/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dashboard-index box">
	<h1 class="title">Dashboard</h1>
	<div class="row">
		<div class="col-md-12">
			<div class="pull-right">
				<?= \yii\bootstrap\ButtonDropdown::widget([
						'label' => '<span class="glyphicon glyphicon-menu-hamburger"></span> Menu',
						'dropdown' => [
							'items' => [
								['label' => '<span class="glyphicon glyphicon-time"></span> My Attendance Records', 'url' => ['record/index']],
								['label' => '<span class="glyphicon glyphicon-tasks"></span> My Tasks', 'url' => ['task/index']],
								['label' => '<span class="glyphicon glyphicon-list-alt"></span> Generate Report', 'url' => ['report/index']],
								['label' => '<span class="glyphicon glyphicon-question-sign"></span> Users Manual', 'url' => 'https://drive.google.com/file/d/1A3Lb6BCYWfzsPbayicvmq2OHhf9_b3Fl/view?fbclid=IwAR3o7UsLS9kDy7QerhJIhneAmGJs_4lqVw0IO4Ty-JWU3s0qi8-FZxRFQac', 'linkOptions'=>['target'=>'blank']],
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
	<?= $this->render('_employee', [
	    'countByStatus' => $countByStatus,
		'panelClass' => $panelClass,
		'employeeDashboard' => $employeeDashboard,
		'status' => $status,
	]); ?>
	
	<?php
		if($supervisorDashboard->taskSummary){
			echo $this->render('_staff_summary', [
				'panelClass' => $panelClass,
				'supervisorDashboard' => $supervisorDashboard,
				'status' => $status,
			]);
			
		}
			echo $attendanceRecordView;

	?>
</div>