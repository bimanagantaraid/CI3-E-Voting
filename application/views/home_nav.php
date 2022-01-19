<header class="header" id="header">
    <nav class="nav container">
        <a href="#" class="nav__logo">
            <img src="<?= base_url('') ?>assets/dist/img/page/icon.png"> Voting
        </a>

        <div class="nav__menu" id="nav__menu">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="<?= base_url('home')?>" class="nav__link">Home</a>
                </li>
                <li class="nav__item">
                    <a href="<?= base_url('vote')?>" class="nav__link">Vote</a>
                </li>
                <li class="nav__item">
                    <a href="<?= base_url('vote/quickcount')?>" class="nav__link">Quick Count</a>
                </li>
                <?php
                if ($this->session->userdata('pemilih_id')) {
                ?>
                    <li class="nav__item">
                        <a href="<?= base_url('auth/logoutpemilih') ?>" class="nav__link btn-sm btn-danger"><?= $pemilih['nama'] ?> - Logout</a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="nav__item">
                        <a href="<?= base_url('auth/loginpemilih') ?>" class="nav__link btn-sm btn-pemilih">Login Pemilih</a>
                    </li>
                    <li class="nav__item">
                        <a href="<?= base_url('auth/login') ?>" class="nav__link btn-sm btn-panitia">Login Panitia</a>
                    </li>
                <?php
                }
                ?>

            </ul>
            <div class="nav__close" id="nav-close">
                <ion-icon name="close-outline"></ion-icon>
            </div>
        </div>
        <div class="nav__btns">
            <!-- Theme change button -->
            <i class="ri-moon-line change-theme" id="theme-button"></i>

            <div class="nav__toggle" id="nav-toggle">
                <ion-icon name="menu"></ion-icon>
            </div>
        </div>
    </nav>
</header>