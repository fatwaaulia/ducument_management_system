<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>General Dashboard &mdash; Stisla</title>

    <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">  
    <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets_stisla/css/style.css">

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar px-3">
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
                    <li class="dropdown dropdown-list-toggle"><a href="#" data-bs-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-end">
                            <div class="dropdown-header">Messages
                                <div class="float-end">
                                <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-message">
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                <div class="dropdown-item-avatar">
                                    <img alt="image" src="assets_stisla/img/avatar/avatar-1.png" class="rounded-circle">
                                    <div class="is-online"></div>
                                </div>
                                <div class="dropdown-item-desc">
                                    <b>Kusnaedi</b>
                                    <p>Hello, Bro!</p>
                                    <div class="time">10 Hours Ago</div>
                                </div>
                                </a>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown dropdown-list-toggle"><a href="#" data-bs-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-end">
                            <div class="dropdown-header">Notifications
                                <div class="float-end">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-icon bg-primary text-white">
                                        <i class="fas fa-code"></i>
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
                            <img alt="image" src="assets_stisla/img/avatar/avatar-1.png" class="rounded-circle me-2">
                            <div class="d-sm-none d-lg-inline-block">Hi, Ujang Maman</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="dropdown-title">Logged in 5 min ago</div>
                            <a href="features-profile.html" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <a href="features-activities.html" class="dropdown-item has-icon">
                                <i class="fas fa-bolt"></i> Activities
                            </a>
                            <a href="features-settings.html" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item has-icon text-danger">
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
                        <li class="menu-header">Dashboard</li>
                        <li class="dropdown active">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                            <ul class="dropdown-menu">
                                <li class="active">
                                    <a class="nav-link" href="index-0.html">General Dashboard</a>
                                </li>
                                <li>
                                    <a class="nav-link" href="index.html">Ecommerce Dashboard</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Bootstrap</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="bootstrap-alert.html">Alert</a></li>
                                <li><a class="nav-link" href="bootstrap-badge.html">Badge</a></li>
                                <li><a class="nav-link" href="bootstrap-breadcrumb.html">Breadcrumb</a></li>
                                <li><a class="nav-link" href="bootstrap-buttons.html">Buttons</a></li>
                                <li><a class="nav-link" href="bootstrap-card.html">Card</a></li>
                                <li><a class="nav-link" href="bootstrap-carousel.html">Carousel</a></li>
                                <li><a class="nav-link" href="bootstrap-collapse.html">Collapse</a></li>
                                <li><a class="nav-link" href="bootstrap-dropdown.html">Dropdown</a></li>
                                <li><a class="nav-link" href="bootstrap-form.html">Form</a></li>
                                <li><a class="nav-link" href="bootstrap-list-group.html">List Group</a></li>
                                <li><a class="nav-link" href="bootstrap-media-object.html">Media Object</a></li>
                                <li><a class="nav-link" href="bootstrap-modal.html">Modal</a></li>
                                <li><a class="nav-link" href="bootstrap-nav.html">Nav</a></li>
                                <li><a class="nav-link" href="bootstrap-navbar.html">Navbar</a></li>
                                <li><a class="nav-link" href="bootstrap-pagination.html">Pagination</a></li>
                                <li><a class="nav-link" href="bootstrap-popover.html">Popover</a></li>
                                <li><a class="nav-link" href="bootstrap-progress.html">Progress</a></li>
                                <li><a class="nav-link" href="bootstrap-table.html">Table</a></li>
                                <li><a class="nav-link" href="bootstrap-tooltip.html">Tooltip</a></li>
                                <li><a class="nav-link" href="bootstrap-typography.html">Typography</a></li>
                            </ul>
                        </li>
                    </ul>
                </aside>
            </div>

            <div class="main-content">
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
            </div>
            <footer class="main-footer">
                <div class="footer-start">
                    Copyright &copy; <?= date('Y') ?>
                    <a href="https://kasurustd.com" target="_blank">Kasuru Studio</a>
                </div>
            </footer>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/modules/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets_stisla/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="assets_stisla/js/scripts.js"></script>
</body>
</html>