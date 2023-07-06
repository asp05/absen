<!-- Navbar -->
<nav class="main-header navbar navbar-expand border-bottom-0 text-sm navbar-dark navbar-primary">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item text-white">
        </li>
        <li class="nav-item dropdown user user-menu">
            <a href="#" class="nav-link" data-toggle="dropdown">
                <img src="<?= base_url('assets/admin/dist/img/avatar.png') ?>" class="user-image" alt="User Image">
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header">
                    <img src="<?= base_url('assets/admin/dist/img/avatar.png') ?>" alt="User Image">
                    <p>
                        <?= $this->session->userdata('nama') ?>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="pull-right">
                        <a href="<?= base_url('auth/logout') ?>" class="btn btn-primary btn-block keluar">Keluar</a>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.navbar -->