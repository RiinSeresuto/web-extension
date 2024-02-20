<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <h1><?php // Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus fa-sm"></i> Create Menu', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    </p>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'parent_id',
            'label',
            'menu_order',
            [
                'attribute' => 'position_id',
                'value' => function($data){
                    return $data->position->position;
                },
            ],
            [
                'attribute' => 'status_id',
                'value' => function($data){
                    return $data->status->status_type;
                },
            ],
            //'link',
            //'logo_file',
            //'user_id',
            [
                'attribute' => 'user_id',
                'value' => function($data){
                    return $data->user->username;
                },
            ],
            //'user_update_id',
            //'date_created',
            [
                'attribute' => 'date_created',
                'value' => function($data){
                    return ($data->date_created) ? date('F d, Y h:i A', strtotime($data->date_created)) : null; 
                },
            ],
            //'date_updated',

            //['class' => 'yii\grid\ActionColumn'],

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
                        'delete' => function ($url) {
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
    ]); ?>


</div>
