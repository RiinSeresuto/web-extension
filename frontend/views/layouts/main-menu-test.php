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
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNavDropdown">
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

        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>