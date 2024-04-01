<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Page';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">
    <div class="card">
        <div class="card-button">
            <?= Html::a('<i class="fas fa-plus fa-sm"></i> Create Page', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        </div>

        <div class="card-body">
            <!-- <h5 class="card-title">Special title treatment</h5> -->
            <?= $this->render('_search', [
                'model' => $searchModel, 
                'url_type' => $url_type, 
                'type' => $type, 
                'status' => $status
                ]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'title',
                    [
                        'attribute' => 'url_type_id',
                        'value' => function($data){
                            return $data->urlType->url_type;
                        }
                    ],
                    [
                        'attribute' => 'status_id',
                        'value' => function($data){
                            return $data->status->status_type;
                        },
                    ],
                    [
                        'attribute' => 'type_id',
                        'value' => function($data){
                            return $data->type->type;
                        }
                    ],
                    [
                        'attribute' => 'user_id',
                        'value' => function($data){
                            return $data->user->username;
                        },
                    ],
                    [
                        'attribute' => 'date_created',
                        'value' => function($model){
                            return ($model->date_created) ? date('F d, Y h:i A', strtotime($model->date_created)) : null; 
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
