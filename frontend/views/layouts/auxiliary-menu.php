<?php
$auxiliaryMenu = [];

// Filter menus based on position
foreach ($menus as $menu) {

    if ($menu->position_id == '2') {
        $auxiliaryMenu[] = $menu;
    }
}

// Define a custom comparison function
function sortAuxiliaryArray($a, $b)
{
    return $a->menu_order - $b->menu_order;
}

// Sort the mainMenu array based on menu_order
usort($auxiliaryMenu, 'sortAuxiliaryArray');

function generateAuxiliaryDropdown($children)
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
            $return_item .= '<li><a class="dropdown-item dropdown-toggle" href="' . $child->link . '" ' . $target . '>' . $child->label . '</a>' . generateAuxiliarySubmenu($child->menuChildren) . '</li>';
        } else {
            $return_item .= '<li><a class="dropdown-item" href="' . $child->link . '" ' . $target . '>' . $child->label . '</a></li>';
        }
    }

    return $start_ul . $return_item . $end_ul;
}

function generateAuxiliarySubmenu($children)
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

<nav class="navbar navbar-expand-md navbar-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <?php $target = 'target="_blank"'; ?>
            <?php foreach ($auxiliaryMenu as $menu): ?>
                <li class="nav-item dropdown active auxiliary-hover">
                    <?php if (!empty($menu->menuChildren)): ?>
                        <a class="nav-link dropdown-toggle auxiliary-dropdown-hover" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <?= $menu->label ?>
                        </a>
                        <?= generateAuxiliaryDropdown($menu->menuChildren) ?>

                        <?php continue; endif; ?>

                    <a class="nav-link" href="<?= $menu->link ?>&menu_id=<?= $menu->id ?>" <?= ($menu->url_type == 2) ? $target : "" ?>><?= $menu->label ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>