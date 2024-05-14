<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PublicAssistanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Public Assistances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="public-assistance-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Public Assistance', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'email:email',
            'contact_num',
            'subject',
            //'message:ntext',
            //'group',
            //'file_attachment',
            //'date_posted',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
