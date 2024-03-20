<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <div class="card">
        <div class="card-button">
            <?php // Html::a('<i class="fas fa-plus"></i> Create Category', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
            Add Category
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <?php $form = ActiveForm::begin(['action' => ['/category/create']]); ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">
                
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'status_id')->widget(Select2::class, [
                        'data' => ArrayHelper::map($status, 'id', 'status_type'),
                        'options' => [
                            'placeholder' => 'Select Status',
                        ],
                    ]) ?>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-sm']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

        <div class="card-body">
        <?= $this->render('_search', [
        'model' => $searchModel,
        'status' => $status]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            [
                'attribute' => 'status_id',
                'value' => function($data){
                    return $data->status->status_type;
                },
            ],
            [
                'attribute' => 'user_id',
                'value' => function($data){
                    return $data->user->username;
                },
            ],
            [
                'attribute' => 'date_created',
                'value' => function($data){
                    return ($data->date_created) ? date('F d, Y h:i A', strtotime($data->date_created)) : null; 
                },
            ],
            [
                'header' => 'Actions',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'headerOptions' => [
                    'class' => 'text-center px-2',
                    'style' => 'color: #0d6efd; width: 8rem;',
                ],
                'contentOptions' => ['class' => 'text-center px-2'],
                'visibleButtons' => [
                    'update' => true,
                    'view' => true,
                    'delete' => true,
                ],
                'buttons' =>
                    [
                        'view' => function ($url, $model) {
                            return Html::a('<i class="fas fa-eye fa-xs"></i> View', $url, [
                                'title' => Yii::t('yii', 'View'),
                                'class' => 'btn btn-info  btn-sm px-2 py-0',
                                'style' => 'width: 90px;'
                            ]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<i class="fas fa-pencil-alt fa-xs"></i> Update', $url, [
                                'title' => Yii::t('yii', 'Update'),
                                'class' => 'btn btn-success btn-sm px-2 py-0',
                                'style' => 'width: 90px;',
                                'onClick' => 'return editModal(this.href);'
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<i class="fas fa-trash fa-xs"></i> Delete', $url, [
                                'title' => Yii::t('yii', 'Delete'),
                                'class' => 'btn btn-danger btn-sm px-2 py-0',
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'data-method' => 'post',
                                'style' => 'width: 90px;'
                            ]);
                        },
                    ],
            ],
        ],
        'pager' => [
                        'class' => 'yii\bootstrap4\LinkPager',
                    ],
    ]); ?>

        </div>
    </div>
</div>

<!-- Modal -->
<!-- <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="update-modal-body">
        ...
      </div>
      
    </div>
  </div>
</div> -->

<?php 
// $script=<<<JS
// window.editModal = function(url){
//     $.get(url, function (data) {
//         $('.update-modal-body').html(data);
//         $('#updateModal').modal('show')
//     })
//     //$('#updateModal').modal('show').find('.update-modal-body').load(url);
//     return false;
// }
// JS;
// $this->registerJs($script);
?>