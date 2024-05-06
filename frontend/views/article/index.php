<?php
// $post = str_replace("\\\"", "\"", $post);
$post = str_replace('\\"', '\\u201d', $post);
$post = str_replace("<\\/p>", "</p>", $post);

$post = json_decode($post, true);

$post_title = $post['Title'];

$this->title = $post_title;
?>

<div class="container">
    <h1><?= $post_title ?></h1>

    <section>
        <?= $post['Content'] ?>
    </section>

    <div class="row mb-3">
        <?php foreach ($central_news as $key => $news): ?>
            <?php
            // $news_body = str_replace("\\\"", "\"", $news->body);
            $news_body = str_replace('\\"', '\\u201d', $news->body);
            $news_body = str_replace("<\\/p>", "</p>", $news_body);
            $news_body = json_decode($news_body, true);
            ?>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div id="central-news-list">
                            <em><?= Yii::$app->formatter->asDate($news->date_created, 'long') ?></em>
                        </div>
                        <a href="/article?id=<?= $news->id ?>">
                            <h6><?= $news_body["Title"] ?></h6>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="col-md-3 d-flex justify-content-center align-items-center">
            <span>more ...</span>
        </div>
    </div>
</div>