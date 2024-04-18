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
