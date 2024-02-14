<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menu';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="menu-index">

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Create Menu', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        <?php // Html::button('<i class="fa fa-plus"></i> Create Menu', ['value' => Url::to('index.php?r=menu/create'), 'class' => 'btn btn-success btn-sm', 'id' => 'modalButton']) ?>
    </p>

    <?php 
       // Modal::begin([
         //   'header' => '<h4>Menu</h4>',
           // 'id' => 'modal',
            //'size' => 'modal-lg',
        //]);

        //echo "<div id='modalContent'></div>";
        //Modal::end();
    ?>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'parent_id',
            'label',
            'menu_order',
            'position_id',
            //'status_id',
            //'link',
            //'logo_file',
            'user_id',
            //'user_update_id',
            'date_created',
            //'date_updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

   


</div>
