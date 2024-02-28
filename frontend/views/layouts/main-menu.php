<?php 
use backend\models\Menu;

$menus = Menu::find()->all();

$mainMenu = [];

    // Filter menus based on position
    foreach ($menus as $menu) {
        
        if ($menu->position_id == '1') {
            $mainMenu[] = $menu;
        }
        
    }
?> 
    
    <ul class="main-menu-navs">
        <?php foreach ($mainMenu as $menu): ?>
            <li><a href="" class="active"><?= $menu->label ?></a></li>
        <?php endforeach; ?>
    </ul>
