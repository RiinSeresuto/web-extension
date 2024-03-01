<?php 
use backend\models\Menu;

// $menus = Menu::find()->andWhere(['parent_id'=>null])->all();

$auxiliaryMenu = [];

    // Filter menus based on position
    foreach ($menus as $menu) {
        
        if ($menu->position_id == '2') {
            $auxiliaryMenu[] = $menu;
        }
    }

    // Define a custom comparison function
    function compareMenuOrder($a, $b) {
        return $a->menu_order - $b->menu_order;
    }

    // Sort the mainMenu array based on menu_order
    usort($auxiliaryMenu, 'compareMenuOrder');
?> 

    <ul class="auxiliary-menu-navs">
        <?php foreach ($auxiliaryMenu as $menu): ?>
            <li><a href="" class="active"><?= $menu->label ?></a></li>
        <?php endforeach; ?>
    </ul>
