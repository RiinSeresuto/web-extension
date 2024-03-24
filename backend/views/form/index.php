<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Forms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-index">
    <div class="card">
        <div class="card-button">
            <?= Html::a('<i class="fas fa-plus"></i> Create Form', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        </div>
        <div class="card-body">
            <?= $this->render('_search', [
                'model' => $searchModel,
                'category' => $category,
                'status' => $status,
            ]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'category_id',
                        'value' => function($data){
                            return $data->category->title;
                        },
                    ],
                    [
                        'attribute' => 'status_id',
                        'value' => function($data){
                            return $data->status->status_type;
                        }
                    ],
                    'year',
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
                                        'style' => 'width: 90px;'
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
                                // 'delete' => function ($url, $model) {
                                //     return Html::a(
                                //         '<i class="fas fa-trash fa-xs"></i> Delete <i class="fas fa-spinner fa-spin d-none"></i>', // Added spinner icon
                                //         $url,
                                //         [
                                //             'title' => Yii::t('yii', 'Delete'),
                                //             'class' => 'btn btn-danger btn-sm px-2 py-0 delete-btn', // Added delete-btn class
                                //             'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                //             'data-method' => 'post',
                                //             'style' => 'width: 90px;'
                                //         ]
                                //     );
                                // },                                
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

<?php
// $script = <<<JS
// document.addEventListener('DOMContentLoaded', function () {
//         document.querySelectorAll('.delete-btn').forEach(function (btn) {
//             btn.addEventListener('click', function () {
//                 var spinner = this.querySelector('.fa-spinner');
//                 spinner.classList.remove('d-none'); // Show spinner

//                 // You can also disable the button while the delete operation is in progress
//                 this.disabled = true;
//             });
//         });
//     });
// JS;
// $this->registerJs($script);
?>