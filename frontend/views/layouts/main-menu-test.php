<?php
$mainMenu = [];

// Filter menus based on position
foreach ($menus as $menu) {

    if ($menu->position_id == '1') {
        $mainMenu[] = $menu;
    }
}
?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <?php foreach ($mainMenu as $menu): ?>
                <?php $target = 'target="_blank"'; ?>
                <?php if (!empty($menu->menuChildren)) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            <?= $menu->label ?>
                        </a>

                        <?= generateNavItem($menu->menuChildren) ?>

                    </li>
                <?php } else { ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="#"><?= $menu->label ?></a>
                    </li>
                <?php } ?>

            <?php endforeach; ?>
        </ul>
    </div>
</nav>