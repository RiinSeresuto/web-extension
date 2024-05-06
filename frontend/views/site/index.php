<?php

/* @var $this yii\web\View */

$this->title = 'DILG: Department of the Interior and Local Government';
?>

<div class="advisory-container">
    <?php //$this->render('_advisory_highlight', [
    //     'advisory_highlight' => $advisory[0]->body,
    //     'advisory_date' => $advisory[0]->date_created,
    //     'advisory' => $advisory,
    // ]); ?>
</div>

<div class="row">
    <div class="col-md-6 whats-new-container">

    </div>
</div>

<!-- <div class="container"> -->
<div class="central-news-container">
    <?= $this->render('_central_news_highlight', [
        'central_news_highlight' => $central_news[0]->body,
        'central_news_date' => $central_news[0]->date_created,
        'central_news_id' => $central_news[0]->id,
        'central_news' => $central_news,
    ]); ?>
</div>


<!-- <div class="container"> -->
<div class="regional-news-container">
    <?= $this->render('_regional_news_highlight', [
        'regional_news_highlight' => $regional_news[0]->body,
        'regional_news_date' => $regional_news[0]->date_created,
        'regional_news' => $regional_news,
    ]); ?>
</div>