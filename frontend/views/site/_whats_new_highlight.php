<?php

$whats_new_highlight = str_replace('\\"', '\\u201d', $whats_new_highlight);
$whats_new_highlight = str_replace("<\\/p>", "</p>", $whats_new_highlight);

$whats_new_highlight = json_decode($whats_new_highlight, true);

$summary_length = 550;
$whats_new_highlight_summary = $whats_new_highlight['Content'];

if (mb_strlen($whats_new_highlight_summary) > $summary_length) {
    $whats_new_highlight_summary = mb_substr($whats_new_highlight_summary, 0, $summary_length);
}

$whats_new_highlight_summary .= "...";
$whats_new_highlight_title = $whats_new_highlight['Title'];
?>

<h4>What's New</h4>
<hr>
<div class="row">
    <div class="col-7" id="whats_new_date">
        <div><em><?= Yii::$app->formatter->asDate($whats_new_date, 'long') ?></em></div>
        <h1 id="whats-new-title"><?= $whats_new_highlight_title ?></h1>
    </div>
    <div class="col-5" id="whats-new-summary">
        <?= $whats_new_highlight_summary ?>
    </div>
</div>
<div class="row">
    <?php foreach ($whats_news as $key => $whats_new): ?>
        <?php if ($key > 0): ?>
            <?php
            $whats_new_body = str_replace('\\"', '\\u201d', $whats_new->body);
            $whats_new_body = str_replace("<\\/p>", "</p>", $whats_new_body);
            $whats_new_body = json_decode($whats_new_body, true);
            ?>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div id="whats-new-list"><em><?= Yii::$app->formatter->asDate($whats_new->date_created, 'long') ?></em>
                        </div>
                        <h6><?= $whats_new_body['Title'] ?></h6>
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

<?php
$style = <<<CSS

#whats-new-date{
    font-size: 12px
}

#whats-new-title{
    font-size: 40px
}

#whats-new-summary{
    font-size: 15px
}

#whats-new-list {
    font-size: 10px
}

CSS;
$this->registerCss($style);
?>