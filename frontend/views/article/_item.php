<?php
$body = json_decode($model->body, true);
$title = $body['Title'];
?>

<a class="archive-list mb-3 shadow p-3 rounded" href="/article?id=<?= $model->id ?>">
    <span class="date">
        <small><em><?= Yii::$app->formatter->asDate($model->date_created, 'long') ?></em></small>
    </span>
    <br>
    <span class="title">
        <h4><?= $title ?></h4>
    </span>
</a>

<?php
$style = <<<CSS
.archive-list{
    color: black;
    text-decoration: none;
    display: block;
}

.archive-list:hover{
    text-decoration: none;
    color: #545454;
}
CSS;

$this->registerCss($style);
?>