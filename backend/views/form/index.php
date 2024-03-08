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

    <p>
        <?= Html::a('Create Form', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    </p>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'category_id',
            'description',
            'status_id',
            'year_id',
            //'field_id',
            'user_id',
            //'user_update_id',
            'date_created',
            //'date_updated',

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
    ]); ?>


</div>
