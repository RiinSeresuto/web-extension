<?php

/* @var $this \yii\web\View */
/* @var $content string */

//use Yii;
use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\widgets\ActiveForm;
use backend\models\Menu;

AppAsset::register($this);
$menus = Menu::find()->andWhere(['parent_id' => null])->all();

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap">

        <div class="separator-one"></div>
        <div class="separator-two"></div>
        <!--  Top Navigation -->
        <div class="header">
            <div class="container-fluid">
                <div class="row theme header">
                    <div class="col-xs-12 col-lg-12">
                        <marquee behavior="alternate" direction="down" scrollamount=""> <!-- marquee -->
                            <?= Html::img('@web/images/logo-dilg-new.png', ['class' => 'header-logo']); ?>
                        </marquee>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator-two"></div>
        <div class="separator-one"></div>


        <!-- Main Menu Navigation -->
        <div class="main-menu">
            <?= $this->render('main-menu', [
                'menus' => $menus
            ]) ?>

        </div>

        <?= $this->render('slider-photo') ?>

        <!-- Auxiliary Menu Navigation -->
        <div class="auxiliary-menu">
            <?= $this->render('auxiliary-menu', [
                'menus' => $menus
            ]) ?>
        </div>

        <div class="banner">
            <?= $this->render('dilg-systems-banner') ?>
        </div>

        <div class="info-system">
            <?= $this->render('dilg-info-system') ?>
        </div>

        <?php // $advisory ?>

        <?= $content ?>
    </div>
    <!-- Footer -->
    <?= $this->render('footer') ?>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>