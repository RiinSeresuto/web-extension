<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use yii\web\View;

AppAsset::register($this);

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
    <!--  Top Navigation -->
    <div class="header">
        <div class="container-fluid">
            <div class="row theme header">
                <div class="col-xs-12 col-lg-12">
                    <marquee behavior="alternate" direction="down" scrollamount="">
                        <?= Html::img('@web/images/dilg-bp-logo.png', ['class'=>'header-logo']);?>
                    </marquee>
                </div>
            </div>

        </div>
    </div>
    <div class="separator"></div>

    <!-- Main Menu Navigation -->
    <div class="main-menu">
        
    </div>
    <?php
    // NavBar::begin([
    //     'brandLabel' => Html::img('@web/images/logo-dilg-new.png', ['class'=>'img-fluid img-responsive']),
    //     'brandUrl' => Yii::$app->homeUrl,
    //     'options' => [
    //         //'class' => 'navbar-inverse navbar-fixed-top',
    //         //'class' => 'navbar navbar-default navbar-static-top',
    //     ],
    // ]);
    $menuItems = [];
    // Menu Items that will be fetched from CMS (backend)
    $menuItems = [
        // ['label' => 'gov.ph', 'url' => 'https://www.gov.ph/' ,'linkOptions'=>['style' => 'color: black;'] ],
        // ['label' => 'Home', 'url' => ['/site/index'],'linkOptions'=>['style' => 'color: black;'] ],
        // ['label' => 'About Us', 'url' => ['/site/about'],'linkOptions'=>['style' => 'color: black;'] ],
        // ['label' => 'Publications', 'url' => ['/material'],'linkOptions'=>['style' => 'color: black;'], 'active' => in_array(\Yii::$app->controller->id, ['material','upload-content']) ],
        // ['label' => 'Authors', 'url' => ['/material-author/index'],'linkOptions'=>['style' => 'color: black;'], 'active' => in_array(\Yii::$app->controller->id, ['material-author']) ],
    ];

    // $menuItems = [
    //     ['label' => 'Attendance Record', 'url' => ['/wfh/record/index']],
    //     ['label' => 'Tasks', 'url' => ['/wfh/task/index']],
    //     ['label' => 'Report', 'url' => ['#'],
    //     'items' => [
    //         ['label' => 'Generate Report', 'url' => ['/wfh/report/index']],
    //         ['label' => 'Report Details', 'url' => ['/wfh/report-details/index']],
    //     ],
    // ],
    // ];
    
    // if (Yii::$app->user->isGuest) {
    // } else {
    //     $menuItems[] = '<li>'
    //         . Html::beginForm(['/user/logout'], 'post')
    //         . Html::submitButton(
    //             'Logout (' . Yii::$app->user->identity->username . ')',
    //             ['class' => 'btn btn-link logout']
    //         )
    //         . Html::endForm()
    //         . '</li>';
    // }
    // echo Nav::widget([
    //     'options' => ['class' => 'navbar-nav navbar-right'],
    //     'items' => $menuItems,
    // ]);
    // NavBar::end();
    // ?>
</div>
    <!-- Footer -->
<footer class="footer">
    <div class="container">

    <div class="row">
        <div class="col-md-3 seal-ph">
            <?= Html::img('@web/images/coat-ph.png', ['class'=>'footer-seal']);?>
                <h6><strong>Republic of the Philippines</strong></h6>
                    <div class="seal-caption">All content is in the public domain unless otherwise stated.</div>
        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6 info-system">
                    <div>DILG Information Systems
                        <div>Haha</div>
                    </div>
                    <div>Attached Agencies
                        <div>Hehe</div>
                    </div>
                    <div>Partners
                        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate porro nesciunt maxime recusandae ex consequuntur culpa expedita? Veritatis quibusdam fugiat, ex, autem error deserunt architecto excepturi quidem cumque aut soluta.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <strong>About GOVPH</strong>
                            <div class="footer-gov">Learn more about the Philippine government, its structure, how government works and the people behind it.</div>
                            <ul>
                                <li><a href="" class="footer-links">Official Gazette</a></li>
                                <li><a href="" class="footer-links">Open Data Portal</a></li>
                                <li><a href="" class="footer-links">Send us your feedback</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><strong>Government Links</strong>
                            <ul>
                                <li><a href="" class="footer-links">Office of the President</a></li>
                                <li><a href="" class="footer-links">Office of the Vice President</a></li>
                                <li><a href="" class="footer-links">Senate of the Philippines</a></li>
                                <li><a href="" class="footer-links">House of Representatives</a></li>
                                <li><a href="" class="footer-links">Supreme Court</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <div>&nbsp;</div>
                            <ul>
                                <li><a href="" class="footer-links">Court of Appeals</a></li>
                                <li><a href="" class="footer-links">Sandiganbayan</a></li>
                                <li><a href="" class="footer-links">Government Procurement Policy Board</a></li>
                                <li><a href="" class="footer-links">Philippine Competition Commission</a></li>
                            </ul>    
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div>Connect with us</div>
                            <div>Be updated about DILG</div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" height="12" width="12" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.8 90.7 226.4 209.3 245V327.7h-63V256h63v-54.6c0-62.2 37-96.5 93.7-96.5 27.1 0 55.5 4.8 55.5 4.8v61h-31.3c-30.8 0-40.4 19.1-40.4 38.7V256h68.8l-11 71.7h-57.8V501C413.3 482.4 504 379.8 504 256z"/></svg>
                                Like us on Facebook
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" height="12" width="12" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg>    
                                Follow us on X</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
