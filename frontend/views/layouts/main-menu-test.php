<?php
$mainMenu = [];

// Filter menus based on position
foreach ($menus as $menu) {

    if ($menu->position_id == '1') {
        $mainMenu[] = $menu;
    }
}

// Define a custom comparison function
function sortArray($a, $b)
{
    return $a->menu_order - $b->menu_order;
}

// Sort the mainMenu array based on menu_order
usort($mainMenu, 'sortArray');

function generateDropdown($children)
{
    $start_ul = '<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
    $end_ul = "</ul>";

    $return_item = "";
    $target = '';

    foreach ($children as $child) {
        if ($child->url_type == 2) {
            $target = 'target="_blank"';
        }

        if (!empty($child->menuChildren)) {
            $return_item .= '<li><a class="dropdown-item dropdown-toggle" href="' . $child->link . '" ' . $target . '>' . $child->label . '</a>' . generateSubmenu($child->menuChildren) . '</li>';
        } else {
            $return_item .= '<li><a class="dropdown-item" href="' . $child->link . '" ' . $target . '>' . $child->label . '</a></li>';
        }
    }

    return $start_ul . $return_item . $end_ul;
}

function generateSubmenu($children)
{
    $start_ul = '<ul class="dropdown-menu">';
    $end_ul = "</ul>";

    $return_item = "";
    $target = '';

    foreach ($children as $child) {
        if ($child->url_type == 2) {
            $target = 'target="_blank"';
        }

        if (!empty($child->menuChildren)) {
            $return_item .= '<li><a class="dropdown-item dropdown-toggle" href="' . $child->link . '" ' . $target . '>' . $child->label . '</a>' . generateSubmenu($child->menuChildren) . '</li>';
        } else {
            $return_item .= '<li><a class="dropdown-item" href="' . $child->link . '" ' . $target . '>' . $child->label . '</a></li>';
        }
    }

    return $start_ul . $return_item . $end_ul;
}
?>

<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <?php $target = 'target="_blank"'; ?>
            <?php foreach ($mainMenu as $menu): ?>
                <li class="nav-item dropdown active">
                    <?php if (!empty($menu->menuChildren)): ?>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <?= $menu->label ?>
                        </a>
                        <?= generateDropdown($menu->menuChildren) ?>

                        <?php continue; endif; ?>

                    <a class="nav-link" href="<?= $menu->link ?>&menu_id=<?= $menu->id ?>" <?= ($menu->url_type == 2) ? $target : "" ?>><?= $menu->label ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>