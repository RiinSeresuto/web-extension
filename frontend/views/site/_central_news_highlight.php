<?php

$central_news_highlight = str_replace('\\"', '\\u201d', $central_news_highlight);
$central_news_highlight = str_replace("<\\/p>", "</p>", $central_news_highlight);

$central_news_highlight = json_decode($central_news_highlight, true);

$summary_length = 550;
$central_news_highlight_summary = $central_news_highlight['Content'];

if (mb_strlen($central_news_highlight_summary) > $summary_length) {
    $central_news_highlight_summary = mb_substr($central_news_highlight_summary, 0, $summary_length);
}

$central_news_highlight_summary .= "...";
$central_news_highlight_title = $central_news_highlight['Title'];

?>
<h4>Central News</h4>
<hr>
<div class="row">
    <div class="col-7" id="central-news-date">
        <div><em><?= Yii::$app->formatter->asDate($central_news_date, 'long') ?></em></div>
        <a href="/article?id=<?= $central_news_id ?>" class="central-news-title-link">
            <h1><?= $central_news_highlight_title ?></h1>
        </a>
    </div>
    <div class="col-5" id="central-news-summary">
        <?= $central_news_highlight_summary ?>
    </div>
</div>
<hr>
<div class="row">
    <?php foreach ($central_news as $key => $news): ?>
        <?php if ($key > 0): ?>
            <?php
            $news_body = str_replace('\\"', '\\u201d', $news->body);
            $news_body = str_replace("<\\/p>", "</p>", $news_body);
            $news_body = json_decode($news_body, true);
            ?>
            <div class="col-md-3">
                <div class="card container-card">
                    <div class="card-body">
                        <div id="central-news-list"><em><?= Yii::$app->formatter->asDate($news->date_created, 'long') ?></em>
                        </div>
                        <a href="/article?id=<?= $news->id ?>">
                            <h6 class="news-list-title"><?= $news_body["Title"] ?></h6>
                        </a>
                    </div>
                </div>
            </div>

        <?php endif; ?>
    <?php endforeach; ?>
    <div class="col-md-3 d-flex justify-content-center align-items-center">
        <span>more ...</span>
    </div>
</div>

<br>
<br>

<?php
$style = <<<CSS

#central-news-date{
    font-size: 12px
}

#central-news-title{
    font-size: 40px
}

#central-news-summary{
    font-size: 15px 
}

#central-news-list {
    font-size: 10px
}
CSS;

$this->registerCss($style);
?>