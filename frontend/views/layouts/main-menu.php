<?php 

$mainMenu = [];

    // Filter menus based on position
    foreach ($menus as $menu) {
        
        if ($menu->position_id == '1') {
            $mainMenu[] = $menu;
        }
    }
?> 
    
    <ul class="main-menu-navs">
        <div class="dropdown"> 
            <button class="dropbtn">Dropdown</button> <!--Parent Menu-->
            <div class="dropdown-content">
                <a href="#">Link 1</a> <!--Children-->
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
            </div>
        </div>

        <?php foreach ($mainMenu as $menu): ?>
            <li><a href="" class="active"><?= $menu->label ?></a>
                
            </li>

            <?php if ($menu->menuChildren) {
                // echo '<pre>';
                // print_r ($menu->menuChildren);
                // exit;
                    // return $menu->parentLabel->label;
                }
            ?>

            
        <?php endforeach; ?>
    </ul>
