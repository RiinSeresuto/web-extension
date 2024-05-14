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

<h4>Regional News</h4>
<hr>
<div class="row">
    <div class="col-7" id="regional-news-date">
        <div><em><?= Yii::$app->formatter->asDate($regional_news_date, 'long') ?></em></div>
        <h1><?= $regional_news_highlight_title ?></h1>
    </div>

    <div class="col-5" id="regional-news-summary">
        <?= $regional_news_highlight_summary ?>
    </div>
</div>
<div class="row">
    <?php foreach ($regional_news as $key => $news): ?>
        <?php if ($key > 0): ?>
            <?php
            $news_body = str_replace('\\"', '\\u201d', $news->body);
            $news_body = str_replace('\\/p', '</p>', $news_body);
            $news_body = json_decode($news_body, true);
            ?>
            <div class="col-md-3">
                <div class="card container-card">
                    <div class="card-body">
                        <div id="regional-news-list"><em><?= Yii::$app->formatter->asDate($news->date_created, 'long') ?></em>
                        </div>
                        <a href="/article?id=<?= $news->id ?>">
                            <div class="more-news">
                                <h6 class="news-list-title"><?= $news_body['Title'] ?></h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <div class="col-md-3 d-flex justify-content-center align-items-center">
        <a href="/article/lists?category_id=2"><span>more ...</span></a>
    </div>
</div>

<br>
<br>


<?php
$style = <<<CSS

#regional-news-date {
    font-size: 12px
}

#regional-news-title{
    font-size: 40px
}

#regional-news-summary{
    font-size: 15px;
}

#regional-news-list {
    font-size: 10px
}

CSS;

$this->registerCss($style);
?>