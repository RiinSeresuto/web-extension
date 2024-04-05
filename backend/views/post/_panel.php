<?php
use yii\helpers\Url;

?>

<h3>Forms</h3>

<ul class="nav flex-column">
    <?php foreach ($forms as $form): ?>
        <li class="nav-item">
            <a class="nav-link active" href="<?= Url::toRoute(['post/create', 'form_id' => $form->id]) ?>">
                <?php echo $form->category->title ?> <br>
            </a>
        </li>

    <?php endforeach; ?>
</ul>