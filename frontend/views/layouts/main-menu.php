<?php 

$mainMenu = [];

    // Filter menus based on position
    foreach ($menus as $menu) {
        
        if ($menu->position_id == '1') {
            $mainMenu[] = $menu;
        }
    }

     // Define a custom comparison function
    function compareMainMenuOrder($a, $b) {
        return $a->menu_order - $b->menu_order;
    }

    // Sort the mainMenu array based on menu_order
    usort($mainMenu, 'compareMainMenuOrder');

    function generateNavItem($menuChildren) {
        $start_ul = "<ul class='child-nav'>";
        $end_ul = "</ul>";

        $return_item = "";
        $target = '';

        foreach($menuChildren as $children){
            if(!empty($children->menuChildren)){
                if($children->url_type == 2){
                    $target = 'target="_blank"';
                }
                $return_item = $return_item . '<li class="child-item"><a href="'. $children->link .'&menu_id='. $children->id .'" class="active"' . $target  . '>' . $children->label . '</a>'; //parent of children
                $temp = generateNavItem($children->menuChildren); //children
                $return_item = $return_item . $temp . '</li>'; 
            } else {
                if($children->url_type == 2){
                    $target = 'target="_blank"';
                }
                $return_item = $return_item . '<li class="child-item"><a href="'. $children->link .'&menu_id='. $children->id .'" class="active" ' . $target . '>' . $children->label . '</a></li>'; //parent w/o children
            }
        }

        return $start_ul . $return_item . $end_ul;
    }

   
?> 
    
    <ul class="main-menu-navs">
        
        <?php foreach ($mainMenu as $menu): ?>
            <?php $target = 'target="_blank"'; ?>
            <?php if(!empty($menu->menuChildren)){ ?>
                <li class="parent-nav">
                    <a href="<?= $menu->link ?>&menu_id=<?= $menu->id ?>" class="active" <?= ($menu->url_type == 2) ? $target : "" ?> > <?= $menu->label ?> </a>
                    <?= generateNavItem($menu->menuChildren) ?>
                </li>
            <?php } else { ?>
                <li><a href="<?= $menu->link ?>&menu_id=<?= $menu->id ?> " class="active" <?= ($menu->url_type == 2) ? $target : "" ?> > <?= $menu->label ?> </a></li>
            <?php } ?>
        <?php endforeach; ?>
    </ul>