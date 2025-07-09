<style>
.nav-link i {
    padding-left: 1rem;
}
</style>

<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="d-flex me-auto">
                <ul class="navbar-nav me-3">
                    <li>
                        <a href="#" data-bs-toggle="sidebar" class="nav-link nav-link-lg">
                            <i class="fas fa-bars"></i>
                        </a>
                    </li>
                </ul>
            </form>
            <ul class="navbar-nav">
                <li class="dropdown dropdown-list-toggle">
                    <a href="#" data-bs-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep">
                        <i class="far fa-bell text-light"></i>
                    </a>
                    <div class="dropdown-menu dropdown-list dropdown-menu-end">
                        <div class="dropdown-header">Notifications
                            <div class="float-end">
                                <a href="#">Mark All As Read</a>
                            </div>
                        </div>
                        <div class="dropdown-list-content dropdown-list-icons">
                            <style>
                            .dropdown-item:hover {
                                background-color: #f5f5f5!important;
                            }
                            </style>
                            <a href="#" class="dropdown-item dropdown-item-unread">
                                <div class="dropdown-item-icon bg-primary text-white">
                                    <i class="fa fa-bell"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    Template update is available now!
                                    <div class="time text-primary">2 Min Ago</div>
                                </div>
                            </a>
                        </div>
                        <div class="dropdown-footer text-center">
                            <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <?php
                        $nama = implode(' ', array_slice(explode(' ', userSession('nama')), 0, 3));
                        $foto = webFile('users', userSession('foto'), userSession('updated_at'), true, 'user');
                        ?>
                        <img src="<?= $foto ?>" class="rounded-circle me-2" alt="<?= userSession('nama') ?>" title="<?= userSession('nama') ?>">
                        <div class="d-sm-none d-lg-inline-block"><?= $nama ?></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <div class="dropdown-title">Logged in 5 min ago</div>
                        <a href="<?= base_url(userSession('slug_role')) . '/profile' ?>" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url('logout') ?>" class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="main-sidebar sidebar-style-2">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="index.html">DOCUMENT SYSTEM</a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="index.html">DMS</a>
                </div>
                <ul class="sidebar-menu">
                    <?php
                    $menu = menuSidebar();

                    $uri = service('uri');
                    $uri->setSilent();
                    $segment_1 = $uri->getSegment(1);
                    $segment_2 = ($uri->getSegment(2) ? '/' . $uri->getSegment(2) : '');
                    $segment_3 = ($uri->getSegment(3) ? '/' . $uri->getSegment(3) : '');
                    $base_route	= base_url($segment_1 . $segment_2);

                    // Custom Base Route
                    if ($segment_2 == '/maintenance') {
                        $base_route	= base_url($segment_1 . $segment_2 . $segment_3);
                    }
                    // End - Custom Base Route

                    foreach ($menu as $v) :
                        if (! isset($v['title'])) continue;
                        if (in_array(userSession('id_role'), $v['role'])) : // Tampilkan Menu Sesuai Role
                        if ($v['type'] == 'no-collapse') :
                            $is_active = ($base_route == $v['url']) ? 'active' : '';
                    ?>
                    <li class="<?= $is_active ?>">
                        <a class="nav-link" href="<?= $v['url'] ?>">
                            <i class="<?= $v['icon'] ?>"></i>
                            <span><?= $v['title'] ?></span>
                        </a>
                    </li>
                        <?php
                        elseif ($v['type'] == 'collapse') :
                            $is_active = in_array($base_route, array_column($v['collapse'], 'url'));
                            $is_active = $is_active ? 'active' : '';
                        ?>
                    <li class="dropdown <?= $is_active ?>">
                        <a href="#" class="nav-link has-dropdown">
                            <i class="<?= $v['icon'] ?>"></i>
                            <span><?= $v['title'] ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach ($v['collapse'] as $collapse) : ?>
                            <li class="<?= $collapse['url'] == $base_route ? 'active' : '' ?>">
                                <a class="nav-link" href="<?= $collapse['url'] ?>"><?= $collapse['title'] ?></a>
                            </li>
				            <?php endforeach; ?>
                        </ul>
                    </li>
                    <?php elseif (($v['type'] == 'heading')) : ?>
                    <li class="menu-header"><?= $v['title'] ?></li>
                    <?php
                        endif;
                        endif;
                    endforeach;
                    ?>
                </ul>
            </aside>
        </div>

        <!-- <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Dashboard</h1>
                </div>
                <div class="row">
                    <div class="col-12">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque placeat harum similique molestias dolor fugit autem, accusantium dolorem illo porro magni ut sapiente dolores adipisci reprehenderit quo corporis, libero dicta!
                    </div>
                </div>
            </section>
        </div> -->

    <!-- </div>
</div> -->
