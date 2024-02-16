<?php
use yii\bootstrap\Nav;

?>
<aside class="main-sidebar" style="background:#222d32; !important">

    <section class="sidebar" >

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?php
        Nav::widget(
            [
                'encodeLabels' => false,
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Dashboard', 'url' => ['/#']],
                    [
                        'label' => 'Administration', 
                        //'options' => ['class' => "treeview-menu"],
                        'items' => [
                            ['label' => 'Menu', 'url' => ['/menu']],
                            ['label' => 'Pages', 'url' => ['/pages']],
                            ['label' => 'User Management', 'url' => ['/#']],
                        ]
                    ],
                    [
                        'label' => 'CMS',
                        'items' => [
                            ['label' => 'Category', 'url' => ['/category']],
                            ['label' => 'Field', 'url' => ['/field']],
                            ['label' => 'Form', 'url' => ['/form']],
                            ['label' => 'Post', 'url' => ['/post']],
                        ]
                    ],
                    [
                        'label' => 'Feedback',
                        'items' => [
                            ['label' => 'Draft JCs', 'url' => ['/#']],
                            ['label' => 'Draft MCs', 'url' => ['/#']],
                            ['label' => 'Programs and Projects', 'url' => ['/#']],
                            ['label' => 'Public Assistance Center', 'url' => ['/#']],
                        ]
                    ],
                    ['label' => 'Connected Agencies', 'url' => ['/agency']],
                    //['label' => '<i class="fa fa-gauge"></i><span> &nbsp;Dashboard</span>', 'url' => ['/#']],
                    //[
                         //'label' => 'Administration',
                         //'url' => ['/#'],
                         //'items' => [
                             //['label' => 'Menus', 'url' => ['/#']]
                         //]
                    //],
                    //['label' => '<i class="fa fa-file-code-o"></i><span>Gii</span>', 'url' => ['/gii']],
                    //['label' => '<i class="fa fa-dashboard"></i><span>Debug</span>', 'url' => ['/debug']],
                    [
                        'label' => '<i class="glyphicon glyphicon-lock"></i><span>Sing in</span>', //for basic
                        'url' => ['/site/login'],
                        'visible' =>Yii::$app->user->isGuest
                    ],
                ],
                
            ]
        );
        ?>

        <ul class="sidebar-menu">
            <li class="treeview">
                <!--Dashboard-->
                <li>
                    <a href="#"><i class="fa fa-circle-o"></i><span>Dashboard</span></i></a>
                </li>
                <!--Administration-->
                <li>
                    <a href="#"><i class="fa fa-circle-o"></i><span>Administration</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                            <li><a href="menu"><i class="fa fa-circle-o"></i> Menus</a></li>
                            <li><a href="pages"><i class="fa fa-circle-o"></i> Pages</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> User Management</a></li>
                        </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-circle-o"></i><span>CMS</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                            <li><a href="category"><i class="fa fa-circle-o"></i> Category</a></li>
                            <li><a href="field"><i class="fa fa-circle-o"></i> Field</a></li>
                            <li><a href="form"><i class="fa fa-circle-o"></i> Form</a></li>
                            <li><a href="post"><i class="fa fa-circle-o"></i> Post</a></li>
                        </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-circle-o"></i><span>Feedback</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Draft JCs</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Draft MCs</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Programs and Projects</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Public Assistance Center</a></li>
                        </ul>
                </li>

                <li>
                    <a href="agency"><i class="fa fa-circle-o"></i><span>Connected Agencies</span></i></a>
                </li>

               
                <li class="treeview">
                <!--<a href="#">
                    <i class="fa fa-share"></i> <span>Same tools</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>-->
                
                
                <ul class="treeview-menu">
                    <!--
                    <li>
                        <a href="<?php // \yii\helpers\Url::to(['/gii']) ?>"><span class="fa fa-file-code-o"></span> Gii</a>
                    </li>
                    <li>
                        <a href="<?php // \yii\helpers\Url::to(['/debug']) ?>"><span class="fa fa-dashboard"></span> Debug</a>
                    </li>
                    -->
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>

    </section>

</aside>