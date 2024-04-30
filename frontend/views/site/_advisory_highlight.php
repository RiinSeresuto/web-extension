<?php

$advisory_highlight = str_replace('\\"', '\\201d', $advisory_highlight);
$advisory_highlight = str_replace("<\\/p>", "<p>", $advisory_highlight);

$advisory_highlight = json_decode($advisory_highlight, true);

$summary_length = 550;
$advisory_highlight_summary = $advisory_highlight['Content'];

if (mb_strlen($advisory_highlight_summary) > $summary_length) {
    $advisory_highlight_summary = mb_substr($advisory_highlight_summary, 0, $summary_length);
}

$advisory_highlight_summary .= "...";
$advisory_highlight_title = $advisory_highlight['Title'];
?>

<h4>Advisory</h4>
<hr>
<div class="row">
    <div class="col-7" id="advisory-date">
        <div><em><?= Yii::$app->formatter->asDate($advisory_date), 'long' ?></em></div>
        <h1 id="advisory-title"><?= $advisory_highlight_title ?></h1>
    </div>
    <div class="col-5" id="advisory-summary">
        <?= $advisory_highlight_summary ?>
    </div>
</div>
<div class="row">
    <?php foreach ($advisories as $key => $advisory): ?>
        <?php if ($key > 0): ?>
            <?php 
            $advisory_body = str_replace('\\"', '\\201d', $advisory->body);
            $advisory_body = str_replace("<\\/p>", "<p>", $advisory_body);
            $advisory_body = json_decode($advisory_body, true);
            ?>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div id="advisory-list"><em><?= Yii::$app->formatter->asDate($advisory->date_created, 'long') ?></em></div>
                        <h6><?= $advisory_body['Title'] ?></h6>
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
#advisory-date {
    font-size: 12px
}

#advisory-title {
    font-size: 40px
}

#advisory-summary {
    font-size: 15px
}

#advisory-list {
    font-size: 10px
}
CSS;
$this->registerCss($style);
?>