<?php
use yii\widgets\ListView;

$this->title = 'Archive';
?>

<div class="container">
    <h2><?= $this->title ?></h2>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_item',
        'summary' => false,
        'pager' => [
            'class' => 'yii\bootstrap4\LinkPager'
        ]
    ]); ?>
</div>