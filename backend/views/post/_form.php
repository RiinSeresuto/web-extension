<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use kartik\editors\Summernote;
use common\helpers\Getter;
use attachment\components\AttachmentsInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <div class="col-md-12">

                    <?php $form = ActiveForm::begin(['id' => 'content_form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

                    <div class="row">
                        <div class="">
                            <?php $form->field($model, 'category_id')->widget(Select2::class, [
                                'data' => ArrayHelper::map($category, 'id', 'title'),
                                'options' => [
                                    'placeholder' => 'Select Category',
                                ],
                                'pluginEvents' => [
                                    'select2:select' => '
                                        function(){
                                            var categoryId = this.value
                                            fetchForm(categoryId)
                                        }
                                    '
                                ]
                            ]) ?>
                        </div>

                        <div class="">
                            <?php $form->field($model, 'forms_id')->widget(Select2::class, [
                                'data' => [],
                                'options' => [
                                    'placeholder' => 'Select form',
                                    'id' => 'form-id-dropdown',
                                ],
                                'pluginEvents' => [
                                    'select2:select' => '
                                        function(){
                                            var formId = this.value
                                            fetchInputForms(formId)
                                        }
                                    '
                                ]
                            ]) ?>
                        </div>

                        <div class="col-md-12">
                            <?= $form->field($model, 'year')->widget(DatePicker::className(), [
                                'options' => ['placeholder' => "Select Year"],
                                'pluginOptions' => [
                                    'format' => 'yyyy',
                                    'autoclose' => true,
                                    'minViewMode' => 'years',
                                ]
                            ]) ?>
                        </div>
                    </div>

                    <div id="forms-actual">
                        <?php foreach ($form_fields as $form_field): ?>
                            <?php if ($form_field->field->widget_type_id == 1): ?>
                                <?= Html::tag('label', $form_field->field->label, $options = ['class' => 'form-label']) ?>
                                <?= Summernote::widget(['name' => $form_field->field->label, 'container' => ['class' => 'kv-editor-container']]); ?>
                            <?php elseif ($form_field->field->widget_type_id == 2): ?>
                                <?= Html::tag('label', $form_field->field->label, $options = ['class' => 'form-label']) ?>
                                <?= Html::input('text', $form_field->field->label, '', $options = ['class' => 'form-control']) ?>
                            <?php elseif ($form_field->field->widget_type_id == 3): ?>
                                <?= Html::tag('label', $form_field->field->label, $options = ['class' => 'form-label']) ?>
                                <?= Select2::widget([
                                    'name' => $form_field->field->label,
                                    'data' => Getter::getOptions($form_field->field->id),
                                    'options' => [
                                        'placeholder' => 'Select provinces ...',
                                        'id' => 'test-select2'
                                        //'multiple' => true
                                    ],
                                ]); ?>
                            <?php elseif ($form_field->field->widget_type_id == 4): ?>
                                <?= Html::tag('label', $form_field->field->label, $options = ['class' => 'form-label']) ?>
                                <?= DatePicker::widget([
                                    'name' => 'dp_3',
                                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'dd-M-yyyy'
                                    ]
                                ]); ?>
                            <?php elseif ($form_field->field->widget_type_id == 5): ?>
                                <?= Html::tag('label', $form_field->field->label, $options = ['class' => 'form-label']) ?>
                                <?= AttachmentsInput::widget([
                                    'model' => $model,
                                    'id' => 'file_attach',
                                    'options' => [
                                        'multiple' => true,
                                        'accept' => 'application/pdf',
                                        'name' => 'file_attach'
                                    ],
                                    'pluginOptions' => [
                                        'initialPreviewAsData' => true,
                                        //'initialPreviewFileType' => 'pdf',
                                        'autoReplace' => false,
                                        'overwriteInitial' => false,
                                        'maxFileCount' => 3,
                                        //'allowedFileExtensions' => ['pdf'],
                                        'showUpload' => false,
                                        'showCancel' => false,
                                        'browseLabel' => 'Browse',
                                        'removeLabel' => '',
                                        'mainClass' => 'input-group-lg',
                                        'browseClass' => 'btn btn-info',
                                        'uploadClass' => 'btn btn-info',
                                        'fileActionSettings' => [
                                            'showDrag' => false,
                                            'showRemove' => true,
                                            'msgRemove' => 'Are you sure you want to delete this file?',
                                        ]
                                    ]
                                ]) ?>

                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                    <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>

                    <div class="row">
                        <div class="col-md-3">
                            <?= $form->field($model, 'status_id')->widget(Select2::class, [
                                'data' => ArrayHelper::map($status, 'id', 'status_type'),
                                'options' => [
                                    'placeholder' => 'Select Status',
                                ],
                            ]) ?>
                        </div>

                        <div class="col-md-3">
                            <?= $form->field($model, 'visibility_id')->widget(Select2::class, [
                                'data' => ArrayHelper::map($visibility_type, 'id', 'visibility_type'),
                                'options' => [
                                    'placeholder' => 'Select Visibility',
                                ],
                            ]) ?>
                        </div>

                        <div class="col-md-3">
                            <?= $form->field($model, 'publish_id')->widget(Select2::class, [
                                'data' => ArrayHelper::map($publish_type, 'id', 'publish_type'),
                                'options' => [
                                    'placeholder' => 'Select Publish',
                                ],
                                'pluginEvents' => [
                                    'select2:select' => '
                                        function(){
                                            var publishID = this.value
                                            showDateRange(publishID)
                                        }
                                    '
                                ]
                            ]) ?>
                        </div>

                        <div class="col-md-3">
                            <?= $form->field($model, 'page_id')->widget(Select2::class, [
                                'data' => ArrayHelper::map($page, 'id', 'title'),
                                'options' => [
                                    'placeholder' => 'Select Pages',
                                ],
                            ]) ?>
                        </div>
                    </div>

                    <div class="row" id="date_range">
                        <div class="col-md-6">
                            <?= $form->field($model, 'start_date_time')->widget(DateTimePicker::className(), [
                                'options' => ['placeholder' => "Select Start Date and Time"],
                                'pluginOptions' => [
                                    'format' => 'dd-M-yyyy hh:ii',
                                    'autoclose' => true,
                                ]
                            ]) ?>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($model, 'end_date_time')->widget(DateTimePicker::className(), [
                                'options' => ['placeholder' => "Select End Date and Time"],
                                'pluginOptions' => [
                                    'format' => 'dd-M-yyyy hh:ii',
                                    'autoclose' => true,
                                ]
                            ]) ?>
                        </div>
                    </div>

                    <?= Html::submitButton($model->isNewRecord ? '<i class="fas fa-save"></i> Save' : '<i class="fas fa-edit"></i> Update', [
                        'class' => $model->isNewRecord ? 'btn btn-success btn-sm' : 'btn btn-primary btn-sm',
                        'onclick' => "$('#file-input').fileinput('upload');"
                    ]) ?>

                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php

$script = <<<JS
const showDateRange = (publishID) => {
    if(publishID == 2){
        $('#date_range').show();
    }else{
        $('#date_range').hide();
    }
}

const fetchForm = (categoryId) => {
    $.ajax({
		url: "/form/get-forms",
		dataType: "json",
		data: {category_id: categoryId},
		beforeSend: () => {
			$("#form-id-dropdown").html("").select2({
				theme: "krajee-bs4",
				width: "100%",
				placeholder: "Loading..."
			})
		},
		success: (data) => {
			$("#form-id-dropdown").html("").select2({
				data: data,
				theme: "krajee-bs4",
				width: "100%",
				placeholder: "-",
				allowClear: true
			})
		}
	})
}

const fetchSingleField = (id) => {
    console.log(id)
}

const fetchInputForms = (formId) => {
    $.ajax({
		url: "/form/get-form-fields",
		dataType: "json",
		data: {id: formId},
		beforeSend: () => {
			
		},
		success: (data) => {
			$.each(data, (key, field) => {
                fetchSingleField(field.field_id);
            })
		},
        async: false
	})
}

$('#date_range').hide();
JS;

$this->registerJs($script);
?>