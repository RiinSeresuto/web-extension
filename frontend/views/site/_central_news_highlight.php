<?php
$central_news_highlight = str_replace("\\\"", "\"", $central_news_highlight);
$central_news_highlight = str_replace("<\\/p>", "</p>", $central_news_highlight);

$central_news_highlight = json_decode($central_news_highlight, true);

$summary_length = 550;
//$central_news_highlight_summary = strip_tags($central_news_highlight['Content']);
$central_news_highlight_summary = $central_news_highlight['Content'];

if (mb_strlen($central_news_highlight_summary) > $summary_length) {
    $central_news_highlight_summary = mb_substr($central_news_highlight_summary, 0, $summary_length);
}

$central_news_highlight_summary .= "...";
$central_news_highlight_title = $central_news_highlight['Title'];
?>

<div class="card">
    <div class="card-header">
        <h3>Central News</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-7">
                <div><em><?= Yii::$app->formatter->asDate($central_news_date, 'long') ?></em></div>
                <h1 id="central-news-title"><?= $central_news_highlight_title ?></h1>
            </div>
            <div class="col-5" id="central-news-summary">
                <?= $central_news_highlight_summary ?>
            </div>
        </div>
        <div class="row">
            <?php foreach ($central_news as $key => $news): ?>
                <?= $key ?> <br />
            <?php endforeach; ?>
        </div>
    </div>
</div>

<br />
<br />
<br />
<br />
<br />
<br />
<br />

<?php
$style = <<<CSS
#central-news-title{
    font-size: 64px
}

#central-news-summary{
    font-size: 20px;
}
CSS;

$this->registerCss($style);
?>