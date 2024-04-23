<?php

/* @var $this yii\web\View */

$this->title = 'DILG: Department of the Interior and Local Government';

?>

<div class="container">
    <?= $this->render('_central_news_highlight', [
        'central_news_highlight' => $central_news[0]->body,
        'central_news_date' => $central_news[0]->date_created,
        'central_news' => $central_news,
    ]); ?>
</div>

<div class="container">
    <?php // $this->render('_regional_news_highlight', [
    //     'regional_news_highlight' => $regional_news[0]->body,
    //     'regional_news_date' => $regional_news[0]->date_created,
    //     'regional_news' => $regional_news,
    // ]); ?>
</div>