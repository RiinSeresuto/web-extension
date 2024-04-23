<?php

$regional_news_highlight = str_replace('\\"', '\\u201d', $regional_news_highlight);
$regional_news_highlight = str_replace('<\\/p>', '</p>', $regional_news_highlight);

$regional_news_highlight = json_decode($regional_news_highlight, true);

$summary_length = 550;
$regional_news_highlight_summary = $regional_news_highlight['Content'];

if (mb_strlen($regional_news_highlight_summary) > $summary_length) {
    $regional_news_highlight_summary = mb_substr($regional_news_highlight_summary, 0, $summary_length);
}

$regional_news_highlight_summary .= "...";
$regional_news_highlight_title = $regional_news_highlight['Title'];

?>

<h3>Regional News</h3>
<hr>
<div class="row">
    <div class="col-7">
        <div><em><?= Yii::$app->formatter->asDate($central_news_date), 'long' ?></em></div>
        <h1 id="regional-news-title"><?= $regional_news_highlight_title ?></h1>
    </div>

    <div class="col-5" id="central-news-summary">
        <?= $regional_news_highlight_summary ?>
    </div>
</div>
<div class="row">
    <?php foreach ($regional_news as $key => $news): ?>
        <?php if ($key > 0): ?>
            <?php
            $news_body = str_replace('\\"', '\\u201d', $news_body);
            $news_body = str_replace('\\/p', '</p>', $news_body);
            $news_body = json_decode($news_body, true);
            ?>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div><em><?= Yii::$app->formatter->asDate($news->date_created, 'long') ?></em></div>
                        <h6><?= $news_body['Title'] ?></h6>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <div class="col-md-3 d-flex justify-content-center align-items-center">
        <span>more...</span>
    </div>
</div>

<br>
<br>
<br>
<br>
<br>

<?php
$style = <<<CSS
#regional-news-title{
    font-size: 64px
}

#central-news-summary{
    font-size: 20px;
}

CSS;

$this->registerCss($style);
?>