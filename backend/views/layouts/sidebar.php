<?php
use yii\helpers\Url;

$username = '';
$user = Yii::$app->user->identity;

if (yii::$app->user->isGuest) {
    $user_name = "";
} else {

    $userInfo = yii::$app->user->identity->userinfo;
    $username = $userInfo->FIRST_M . ' ' . $userInfo->LAST_M;
}

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= Url::base() . "/images/dilg-logo.png" ?>" alt="DILG Logo"
            class="brand-image img-circle elevation-3" style="opacity: .9">
        <span class="brand-text font-weight-light">DILG Website - Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= $assetDir ?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                <!-- <img src="https://gravatar.com/avatar/<?php // $user->profile->gravatar_id ?>?s=24" class="img-circle elevation-2 alt="<?php // $user->username ?>" /> -->
                <!-- class="img-rounded" -->
            </div>
            <div class="info">
                <p class="d-block m-0 p-0" style="color: white">
                    <?= $username ?>
                </p>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Dashboard', 'url' => ['/site/index'], 'icon' => 'tachometer-alt'],
                    [
                        'label' => 'Administration',
                        'icon' => 'th',
                        'items' => [
                            ['label' => 'Menu', 'url' => ['/menu'], 'iconStyle' => 'far'],
                            ['label' => 'Page', 'url' => ['/pages'], 'iconStyle' => 'far'],
                            ['label' => 'User Management', 'url' => ['/user/admin'], 'iconStyle' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'CMS',
                        'icon' => 'fa-solid fa-file',
                        'items' => [
                            ['label' => 'Category', 'url' => ['/category'], 'iconStyle' => 'far'],
                            ['label' => 'Field', 'url' => ['/field'], 'iconStyle' => 'far'],
                            ['label' => 'Form', 'url' => ['/form'], 'iconStyle' => 'far'],
                            ['label' => 'Post', 'url' => ['/post'], 'iconStyle' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'Media',
                        'icon' => 'fa-solid fa-images',
                        'items' => [
                            ['label' => 'DILG Info Systems', 'url' => ['/dilg-info-systems'], 'iconStyle' => 'far'],
                            ['label' => 'Slider Photo', 'url' => ['/slider-photo'], 'iconStyle' => 'far'],
                            ['label' => 'Banner', 'url' => ['/banner'], 'iconStyle' => 'far'],
                            ['label' => 'Attached Agency', 'url' => ['/attached-agency'], 'iconStyle' => 'far'],
                            ['label' => 'Partners', 'url' => ['/partners'], 'iconStyle' => 'far'],
                        ]

                    ],
                    [
                        'label' => 'Feedback',
                        'icon' => 'fa-solid fa-comments',
                        'items' => [
                            ['label' => 'Draft JCs', 'url' => ['/#'], 'iconStyle' => 'far'],
                            ['label' => 'Draft MCs', 'url' => ['/#'], 'iconStyle' => 'far'],
                            ['label' => 'Programs & Projects', 'url' => ['/#'], 'iconStyle' => 'far'],
                            ['label' => 'Public Assistance Center', 'url' => ['/#'], 'iconStyle' => 'far'],
                        ]
                    ],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>