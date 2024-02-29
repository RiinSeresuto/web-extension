<?php 

$mainMenu = [];

    // Filter menus based on position
    foreach ($menus as $menu) {
        
        if ($menu->position_id == '1') {
            $mainMenu[] = $menu;
        }
    }

    function generateNavItem($menuChildren) {
        $start_ul = "<ul class='child-nav'>";
        $end_ul = "</ul>";

        $return_item = "";

        foreach($menuChildren as $children){
            if(!empty($children->menuChildren)){
                $return_item = $return_item . '<li class="child-item"><a href="" class="active">' . $children->label . '</a>'; //parent of children
                $temp = generateNavItem($children->menuChildren); //children
                $return_item = $return_item . $temp . '</li>'; 
            } else {
                $return_item = $return_item . '<li class="child-item"><a href="" class="active">' . $children->label . '</a></li>'; //parent w/o children
            }
        }

        return $start_ul . $return_item . $end_ul;
    }
?> 
    
    <ul class="main-menu-navs">
        <?php foreach ($mainMenu as $menu): ?>
            <?php if(!empty($menu->menuChildren)){ ?>
                <li class="parent-nav">
                    <a href="" class="active"><?= $menu->label ?></a>
                    <?= generateNavItem($menu->menuChildren) ?>
                </li>
            <?php } else { ?>
                <li><a href="" class="active"><?= $menu->label ?></a></li>
            <?php } ?>
        <?php endforeach; ?>
    </ul>