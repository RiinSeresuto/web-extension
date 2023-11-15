<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\dialog\Dialog;
echo Dialog::widget(['overrideYiiConfirm' => true]);

$counter = 0; 

/* @var $this yii\web\View */
/* @var $model common\modules\wfh\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>
<style>

	.file-caption form-control kv-fileinput-caption {
        display      :none;
    }
    .file-preview {
        height       : 322px;
    }

    .file-drop-zone {
        height       : 280px;
    }

    .close.fileinput-remove {
        display     : none;
    }

    .fileinput-upload-button {
        display      :none;
    }

	.card {
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
		transition: 0.3s;
		padding: 1em;
		margin-bottom: 1em;
	}

	.btn-file {
		float:right;
	}
</style>

<div class="task-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	<?php
		if($employees && !$model->id){
			echo $form->field($model, 'user_id')->widget(
				Select2::className(), [
					'data' => ArrayHelper::map($employees, 'user_id', 'fullName'),
			]); 
		}
	?>
	
	<?php if($model->user_id == Yii::$app->user->id && $model->user_id != $model->encoded_by): ?>
		<label>Encoded By</label>
		<p><?= $model->encodedBy->userinfo->fullName; ?></p>
		
	<?php endif; ?>
	
	<?php if($model->encoded_by == Yii::$app->user->id && $model->user_id != $model->encoded_by): ?>
		<label>Employee</label>
		<p><?= $model->user->userinfo->fullName; ?></p>
	<?php endif; ?>

	<label>Status</label>
	<p><?= ($model->oldAttributes['status'] == $model->status) ? $model->status : 'Change from <b>'.$model->oldAttributes['status'] . '</b> to <b>' . $model->status .'</b>';?></p>
	<?= $form->field($model, 'status')->hiddenInput()->label(false); ?>
	
    <?php
		if(!$model->id):
			echo $form->field($model, 'start_date')->widget(
				DateTimePicker::className(), [
					'pluginOptions' => [
						'autoclose' => true,
						'format' => 'yyyy-mm-dd hh:ii:00',
						'todayHighlight' => true,
					],
					'options' => ['autocomplete'=>'off', 'readonly' => true]
			]);	
		else:
	?>
		<label>Start Date</label>
		<p><?= date('F d, Y h:i A', strtotime($model->start_date)); ?></p>
	<?php endif; ?>
	
	<?php
		if($model->id):
			echo $form->field($model, 'end_date')->widget(
				DateTimePicker::className(), [
					'pluginOptions' => [
						'autoclose' => true,
						'format' => 'yyyy-mm-dd hh:ii:00',
						'todayHighlight' => true,
					],
					'options' => ['autocomplete'=>'off', 'readonly' => true]
			]);	
		endif;
	?>

    <?php
		if($model->encoded_by == Yii::$app->user->id):
			echo $form->field($model, 'description')->textarea(['rows' => 6, 'placeholder'=>'Provide a description of the task to perform']); 
		else:
	?>
		<label>Description</label>
		<p><?= Html::encode($model->description); ?></p>
	<?php
		endif;
	?>
	<?php
		if($model->id):
			echo $form->field($model, 'reason')->textarea(['rows' => 6, 'placeholder'=>'State the reason for delays or cancellation of this task']);
		endif;
	?>

	<?php
		if($model->id):
			echo $form->field($model, 'attachement_url')->textInput(['placeholder'=>'File URL/link', 'maxlength' => true, 'value' => ($model->Url) ? $model->link->url : null, 'autocomplete' => 'off']);
		endif;
	?>

	<?php if($model->id): ?>
		<label>Upload Files</label>
		<?php
			\yii\bootstrap\Alert::begin([
				'options' => [
					'class' => 'alert-info',
				],
					'closeButton' => false,
			]);
			echo 'Please limit the attachments to less than <b>5MB</b> for each file.';
			yii\bootstrap\Alert::end();
		?>
		<?php if(!empty($model->Images)) : ?>
			<div class="row">
				<div class="col-md-12">
					<?php foreach ($model->Images as $image): ?>
						<div id="image-item-<?= $counter; ?>">
							<div class = "card col-md-3" align="center" style="width: 230px; height: 250px; margin: 10px 15px;">
								<?php if ($image->file_type == 'Image') :?>
									<div style="height: 110px; overflow:hidden;">
										<?= Html::img(Url::to(['task/download', 'id'=>$image->id]), ['style' => 'width: 100%; object-fit: contain']) ?>
									</div>
								<?php elseif ($image->file_type == 'Pdf' || $image->file_type == 'Xlsx' || $image->file_type == 'Docx') :?>
									<div style="height: 110px; overflow:hidden;">
										<div style="width: 100%; object-fit: contain">
											<?php if ($image->file_type == 'Pdf') : ?>
												<div style="height: 110px; overflow:hidden;">
													<embed class="kv-preview-data file-preview-pdf" src="<?php echo Url::to(['task/download', 'id'=>$image->id]) ?>" type="application/pdf" style="width:100%;height:160px;">
												</div>
												
											<?php elseif ($image->file_type == 'Xlsx') :?>
												<i class="glyphicon glyphicon-file text-success" style="margin-top: 15px; font-size: 6em;"></i>

											<?php elseif ($image->file_type == 'Docx') :?>
												<i class="glyphicon glyphicon-file text-info" style="margin-top: 15px; font-size: 6em;"></i>
												
											<?php endif ?>
										</div>
									</div>
								<?php endif ?>
								
								<div class = "card-body" style="font-size: 11px; color: #777; padding-top:50px;"> <?= $image->file_name ?></div>
								<?php 
									echo $form->field($model, 'current_files[]')->hiddenInput(['maxlength' => true,'value' =>$image->id, 'id' => 'image-val-'.$counter])->label(false);
									echo Html::a('<i class="glyphicon glyphicon-trash"></i>', ['#'], [
										'class' => 'btn btn-danger btn-xs btn-img-delete ' .$image->id,
										'id' => 'btn-img-delete-'.$counter,
										'title' => 'Delete',
										'counter' => $counter,
										'style' => 'position: relative;left:95px;bottom:-15px; position: relative;',
									]);
								$counter++;
								?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif ?>
		<div class="row">
			<div class="col-md-12">
				<?php echo $form->field($model, 'file_attachment[]')->widget(FileInput::classname(), [
					'options' => ['multiple' => true, 'accept' => ''],
					'pluginOptions' => [
						'previewFileType' => 'image',
						'showCaption' => false,
						'maxFileCount' => 4
						]
					])->label(false); 
				?> 
			</div>
		</div>
	<?php endif ?> 
    <div class="form-group">
        <?= Html::submitButton((!$model->id) ? 'Save' : 'Update', ['class' => (!$model->id) ? 'btn btn-success' : 'btn btn-primary', 'data'=>['confirm'=>(!$model->id) ? 'You are about to submit this form. Once submitted, the start date cannot be updated. </br></br>Click the OK button to continue with the submission. Otherwise, click the Cancel button to update the form.' : 'You are about to submit this form. Make sure input fields are answered correctly. </br></br>Click the OK button to continue. Otherwise, click the Cancel button to update the form.']]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJs(<<<JS
     $('.btn-img-delete').click(function (e){
        e.preventDefault();
        var image_counter = $(this).attr('counter');
        var buttonId = $(this).attr('id');
        //Image value
        $('#image-val-'+ image_counter).remove();
        //Image preview
        $('#image-item-'+ image_counter).remove();
        $('#'+buttonId).remove();
        if($.trim($(".image-container").html())==''){
            $('#uploaded-images').hide();
        }
        if (ccount != 0) {
            ccount = ccount - 1;
            console.log(ccount)
            if ($('.hidden-form').hasClass('hidden')) {
                $('.hidden-form').removeClass('hidden').show();
            }
        }
        
        // if ($(this).hasClass('left')) {
        //     $('.imageLeft').show();
        // } else if ($(this).hasClass('right')) {
        //     $('.imageRight').show();
        // }
        console.log(buttonId);
    });
JS
);
?>
