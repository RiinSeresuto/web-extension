<?php 
use yii\helpers\Url;
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?=Url::base(). "/images/dilg-logo.png"?>" alt="DILG Logo" class="brand-image img-circle elevation-3" style="opacity: .9">
        <span class="brand-text font-weight-light">DILG Website - Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
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
                            ['label' => 'Page', 'url' => ['/pages'],'iconStyle' => 'far'],
                            ['label' => 'User Management', 'url' => ['/#'],'iconStyle' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'CMS',
                        'icon' => 'th',
                        'items' => [
                            ['label' => 'Category', 'url' => ['/category'], 'iconStyle' => 'far'],
                            ['label' => 'Field', 'url' => ['/field'], 'iconStyle' => 'far'],
                            ['label' => 'Form', 'url' => ['/form'], 'iconStyle' => 'far'],
                            ['label' => 'Post', 'url' => ['/post'], 'iconStyle' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'Feedback',
                        'icon' => 'th',
                        'items' => [
                            ['label' => 'Draft JCs', 'url' => ['/#'], 'iconStyle' => 'far'],
                            ['label' => 'Draft MCs', 'url' => ['/#'], 'iconStyle' => 'far'],
                            ['label' => 'Programs & Projects', 'url' => ['/#'], 'iconStyle' => 'far'],
                            ['label' => 'Public Assistance Center', 'url' => ['/#'], 'iconStyle' => 'far'],
                        ]
                    ],
                    ['label' => 'Connected Agencies', 'url' => ['/agency'], 'icon' => 'tachometer-alt'],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>